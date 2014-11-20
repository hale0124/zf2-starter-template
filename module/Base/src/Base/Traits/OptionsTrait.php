<?php

namespace Base\Traits;

use Zend\Stdlib\AbstractOptions;

/**
 * Mail service trait
 */
trait OptionsTrait
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
     * @param  AbstractOptions $options
     * @return OptionsTrait
     */
    public function setOptions(AbstractOptions $options)
    {
        $this->options = $options;

        return $this;
    }
}
