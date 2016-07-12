<?php

namespace Mockarena;

/**
 * Class MockFunction
 * @package Mockarena
 */
class MockFunction
{
    /**
     * @var string
     */
    public $functionName;

    /**
     * @var array
     */
    public $calls = [];

    /**
     * MockFunction constructor.
     * @param $functionName
     */
    public function __construct($functionName)
    {
        $this->functionName = $functionName;
    }

    /**
     * Log the call to this function.
     */
    public function call()
    {
        $this->calls[] = func_get_args();
    }
}
