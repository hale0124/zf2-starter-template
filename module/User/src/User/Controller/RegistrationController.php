<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Base\Traits\EntityManagerAwareTrait;
use Base\Traits\OptionsAwareTrait;
use User\Registration\Options;
use User\Registration\Service\Registration;

class RegistrationController extends AbstractActionController
{
    use EntityManagerAwareTrait;
    use OptionsAwareTrait;

    /**
     * @var Registration
     */
    protected $registrationService;

    /**
     * Constructor
     *
     * @param EntityManager $entityManager
     * @param Options       $options
     * @param Registration  $registrationService
     */
    public function __construct(
        EntityManager $entityManager,
        Options $options,
        Registration $registrationService
    ) {
        $this->setEntityManager($entityManager);
        $this->setOptions($options);
        $this->setRegistrationService($registrationService);
    }

    /**
     * Verify email action
     *
     * @return ViewModel
     */
    public function verifyEmailAction()
    {
        $userId = $this->params()->fromRoute('userId', null);
        $token = $this->params()->fromRoute('token', null);

        if ($userId === null || $token === null) {
            return $this->notFoundAction();
        }

        $user = $this->getEntityManager()->find('User\Entity\User', $userId);

        if (!$user) {
            return $this->notFoundAction();
        }

        if ($this->getRegistrationService()->verifyEmail($user, $token)) {
            return $this->redirectToPostVerificationRoute();
        }

        $viewModel = new ViewModel();
        $viewModel->setTemplate('user/registration/verify-email-error');

        return $viewModel;
    }

    /**
     * Set password action
     *
     * @return ViewModel
     */
    public function setPasswordAction()
    {
        $userId = $this->params()->fromRoute('userId', null);
        $token = $this->params()->fromRoute('token', null);

        if ($userId === null || $token === null) {
            return $this->notFoundAction();
        }

        $user = $this->getEntityManager()->find('User\Entity\User', $userId);

        if (!$user) {
            return $this->notFoundAction();
        }

        $record = $this->getEntityManager()->getRepository('User\Entity\Registration')
            ->findOneByUser($user);

        if (!$record || !$this->getRegistrationService()->isTokenValid($user, $token, $record)) {
            return $this->notFoundAction();
        }

        if ($record->getResponded()) {
            return $this->redirectToPostVerificationRoute();
        }

        $form = $this->getServiceLocator()->get('User\Form\SetPasswordForm');

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $this->getRegistrationService()->setPassword($form->getData(), $record);

                return $this->redirectToPostVerificationRoute();
            }
        }

        return new ViewModel([
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * Redirect to post verification route action
     *
     * @return void
     */
    protected function redirectToPostVerificationRoute()
    {
        return $this->redirect()->toRoute($this->getOptions()->getPostVerificationRoute());
    }

    /**
     * Get registration service
     *
     * @return Registration
     */
    public function getRegistrationService()
    {
        return $this->registrationService;
    }

    /**
     * Set registration service
     *
     * @param  Registration           $registrationService
     * @return RegistrationController
     */
    public function setRegistrationService(Registration $registrationService)
    {
        $this->registrationService = $registrationService;

        return $this;
    }
}
