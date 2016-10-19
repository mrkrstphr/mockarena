<?php

namespace Mockarena;

use RuntimeException;

/**
 * Class Mockarena
 * @package Mockarena
 */
class Mockarena
{
    /**
     * @var array
     */
    public static $mocks = [];

    /**
     * Creates the specified function. If it is already mocked, reset the mock. If it exists and is
     * not a mock, an exception will be thrown.
     *
     * @param string $functionName
     * @return MockFunction
     * @throws RuntimeException
     */
    public function mock($functionName)
    {
        if (!function_exists($functionName)) {
            eval("function $functionName() {" .
                "return \\Mockarena\\Mockarena::forwardCall('$functionName', ...func_get_args());" .
            "}");
            return $this->registerMock($functionName);
        } elseif ($mock = $this->getMock($functionName)) {
            return $this->resetMock($functionName);
        }

        throw new RuntimeException('Function is already defined and cannot be mocked');
    }

    /**
     * Returns a mocked function, if it exists.
     *
     * @param string $functionName
     * @return MockFunction|null
     */
    public function getMock($functionName)
    {
        if (array_key_exists($functionName, self::$mocks)) {
            return self::$mocks[$functionName];
        }

        return null;
    }

    /**
     * Will forward a call to a given function to that mocked function.
     *
     * @param string $functionName
     * @param array ...$args
     * @return mixed
     */
    public static function forwardCall($functionName, ...$args)
    {
        if (array_key_exists($functionName, self::$mocks)) {
            return self::$mocks[$functionName]->call(...$args);
        }

        throw new \RuntimeException("Function {$functionName} was not mocked");
    }

    /**
     * @param string $functionName
     * @return MockFunction
     */
    protected function resetMock($functionName)
    {
        if ($mock = $this->getMock($functionName)) {
            $mock->calls = [];
            $mock->expectedCalls = [];
            return $mock;
        }
    }

    /**
     * @param string $functionName
     * @return MockFunction
     */
    protected function registerMock($functionName)
    {
        if (!$this->getMock($functionName)) {
            self::$mocks[$functionName] = new MockFunction($functionName);
        }

        return $this->getMock($functionName);
    }
}
