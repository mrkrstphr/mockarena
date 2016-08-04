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
     * @var array
     */
    public $expectedCalls = [];

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
     *
     * @return mixed
     */
    public function call()
    {
        $this->calls[] = func_get_args();

        foreach ($this->expectedCalls as $expectedCall) {
            if ($expectedCall->callMatches(func_get_args())) {
                return $expectedCall->getReturnValue();
            }
        }

        return null;
    }

    /**
     * Logs an expected call to this function.
     *
     * @param array ...$args
     * @return ExpectedCall
     */
    public function calledWith(...$args)
    {
        $call = new ExpectedCall($this);
        $call->setArguments($args);

        $this->expectedCalls[] = $call;

        return $call;
    }
}
