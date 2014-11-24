<?php

namespace Base\Traits;

use Zend\Stdlib\AbstractOptions;

/**
 * Mail service trait
 */
trait OptionsAwareTrait
{
    /**
     * @var AbstractOptions
     */
    protected $options;

    /**
     * Get options
     *
     * @return Options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set options
     *
     * @param  AbstractOptions   $options
     * @return OptionsAwareTrait
     */
    public function setOptions(AbstractOptions $options)
    {
        $this->options = $options;

        return $this;
    }
}
