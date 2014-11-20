<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use ZfcUser\Options\ModuleOptions;
use Base\Traits\EntityManagerTrait;
use Base\Traits\OptionsTrait;
use User\Form\ForgotForm;
use User\Form\ResetForm;
use User\Password\Options;
use User\Password\Service\Password;

class PasswordController extends AbstractActionController
{
    use EntityManagerTrait;
    use OptionsTrait;

    /**
     * @var Password
     */
    protected $passwordService;

    /**
     * @var ForgotForm
     */
    protected $forgotForm;

    /**
     * @var ResetForm
     */
    protected $resetForm;

    /**
     * @var ModuleOptions
     */
    protected $zfcUserOptions;

    /**
     * @var string
     */
    protected $failedMessage = 'The e-mail address is not valid.';

    /**
     * Constructor
     *
     * @param EntityManager $entityManager
     * @param Password      $passwordService
     * @param ForgotForm    $forgotForm
     * @param ResetForm     $resetForm
     * @param Options       $options
     * @param ModuleOptions $zfcUserOptions
     */
    public function __construct(
        EntityManager $entityManager,
        Password $passwordService,
        ForgotForm $forgotForm,
        ResetForm $resetForm,
        Options $options,
        ModuleOptions $zfcUserOptions
    ) {
        $this->setEntityManager($entityManager);
        $this->setPasswordService($passwordService);
        $this->setForgotForm($forgotForm);
        $this->setResetForm($resetForm);
        $this->setOptions($options);
        $this->setZfcUserOptions($zfcUserOptions);
    }

    /**
     * User index page
     */
    public function indexAction()
    {
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute('zfcuser');
        } else {
            return $this->redirect()->toRoute('zfcuser/forgotpassword');
        }
    }

    /**
     * Forget password action
     *
     * @return ViewModel
     */
    public function forgotAction()
    {
        $form = $this->getForgotForm();

        $this->getEntityManager()
            ->getRepository($this->getOptions()->getPasswordEntityClass())
            ->cleanExpiredForgotRequests();

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $email = $form->get('email')->getValue();

                $user = $this->getEntityManager()
                        ->getRepository($this->getZfcUserOptions()->getUserEntityClass())
                        ->findOneByEmail($email);

                if ($user != null) {
                    $this->getPasswordService()->sendProcessForgotRequest($user);
                }

                $viewModel = new ViewModel(['email' => $email]);
                $viewModel->setTemplate('user/password/sent');

                return $viewModel;
            } else {
                $this->flashMessenger()->setNamespace('user-forgot-form')->addMessage($this->failedMessage);

                return new ViewModel(['forgotForm' => $form]);
            }
        }

        return new ViewModel(['forgotForm' => $form]);
    }

    /**
     * Reset password action
     *
     * @return ViewModel
     */
    public function resetAction()
    {
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute('zfcuser');
        }

        $form = $this->getResetForm();

        $this->getEntityManager()
                ->getRepository($this->getOptions()->getPasswordEntityClass())
                ->cleanExpiredForgotRequests();

        $userId = $this->params()->fromRoute('userId', null);
        $token = $this->params()->fromRoute('token', null);

        $user = $this->getEntityManager()
                ->getRepository($this->getZfcUserOptions()->getUserEntityClass())
                ->findOneById($userId);

        $passwordRequest = $this->getEntityManager()
                ->getRepository($this->getOptions()->getPasswordEntityClass())
                ->findOneBy([
                    'user' => $user,
                    'requestKey' => $token,
                ]);

        if ($passwordRequest === null || $passwordRequest == false) {
            return $this->redirect()->toRoute('zfcuser/forgotpassword');
        }

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid() && $user !== null) {
                $this->getPasswordService()->resetPassword($passwordRequest, $user, $form->getData());
                $viewModel = new ViewModel(['email' => $user->getEmail()]);
                $viewModel->setTemplate('user/password/passwordchanged');

                return $viewModel;
            }
        }

        return [
            'resetForm' => $form,
            'userId' => $userId,
            'token' => $token,
            'email' => $user->getEmail(),
        ];
    }

    /**
     * Get password service
     *
     * @return Password
     */
    public function getPasswordService()
    {
        return $this->passwordService;
    }

    /**
     * Set password service
     *
     * @param  Password           $passwordService
     * @return PasswordController
     */
    public function setPasswordService(Password $passwordService)
    {
        $this->passwordService = $passwordService;

        return $this;
    }

    /**
     * Get forgot form
     *
     * @return ForgotForm
     */
    public function getForgotForm()
    {
        return $this->forgotForm;
    }

    /**
     * Set forgot form
     *
     * @param  ForgotForm         $forgotForm
     * @return PasswordController
     */
    public function setForgotForm(ForgotForm $forgotForm)
    {
        $this->forgotForm = $forgotForm;

        return $this;
    }

    /**
     * Get reset form
     *
     * @return ResetForm
     */
    public function getResetForm()
    {
        return $this->resetForm;
    }

    /**
     * Set reset form
     *
     * @param  ResetForm          $resetForm
     * @return PasswordController
     */
    public function setResetForm(ResetForm $resetForm)
    {
        $this->resetForm = $resetForm;

        return $this;
    }

    /**
     * Get zfcuser options
     *
     * @return ModuleOptions
     */
    public function getZfcUserOptions()
    {
        return $this->zfcUserOptions;
    }

    /**
     * Set zfcuser options
     *
     * @param  ModuleOptions      $zfcUserOptions
     * @return PasswordController
     */
    public function setZfcUserOptions(ModuleOptions $zfcUserOptions)
    {
        $this->zfcUserOptions = $zfcUserOptions;

        return $this;
    }
}
