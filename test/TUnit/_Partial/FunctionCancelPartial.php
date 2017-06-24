<?php

namespace Dazzle\Promise\Test\TUnit\_Partial;

use Dazzle\Promise\Promise;
use Dazzle\Promise\PromiseInterface;
use Dazzle\Promise\Test\TUnit;

trait FunctionCancelPartial
{
    /**
     * @see TUnit::getTest
     * @return TUnit
     */
    abstract public function getTest();

    /**
     *
     */
    public function testApiDoCancel_ReturnsPromise()
    {
        $test = $this->getTest();
        $test->assertInstanceOf(PromiseInterface::class, Promise::doCancel(1));
    }
}
