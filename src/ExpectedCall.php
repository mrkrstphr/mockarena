<?php

namespace Mockarena;

/**
 * Class ExpectedCall
 * @package Mockarena
 */
class ExpectedCall
{
    /**
     * @var MockFunction
     */
    private $function;

    /**
     * @var array
     */
    private $arguments = [];

    /**
     * @var mixed
     */
    private $returnValue;

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param array $arguments
     * @return $this
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;
        return $this;
    }

    /**
     * @param mixed $returnValue
     * @return $this
     */
    public function willReturn($returnValue)
    {
        $this->returnValue = $returnValue;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReturnValue()
    {
        return $this->returnValue;
    }

    /**
     * @param array $arguments
     * @return bool
     */
    public function callMatches(array $arguments)
    {
        return $arguments === $this->arguments;
    }
}
