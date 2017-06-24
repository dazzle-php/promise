<?php

namespace Dazzle\Promise\Test\TUnit\_Partial;

use Dazzle\Promise\Promise;
use Dazzle\Promise\PromiseFulfilled;
use Dazzle\Promise\PromiseInterface;
use Dazzle\Promise\PromiseRejected;
use Dazzle\Promise\Test\TUnit;

trait FunctionRejectPartial
{
    /**
     * @see TUnit::getTest
     * @return TUnit
     */
    abstract public function getTest();
    
    /**
     *
     */
    public function testApiDoReject_RejectsPromise_WithImmediateValue()
    {
        $test = $this->getTest();

        $expected = 123;
        $mock = $test->createCallableMock();
        $mock
            ->expects($test->once())
            ->method('__invoke')
            ->with($test->identicalTo($expected));

        Promise::doReject($expected)
            ->then(
                $test->expectCallableNever(),
                $mock
            );
    }

    /**
     *
     */
    public function testApiDoReject_RejectsPromise_WithPromisedValue()
    {
        $test = $this->getTest();

        $expected = 123;
        $resolved = new PromiseFulfilled($expected);

        $mock = $test->createCallableMock();
        $mock
            ->expects($test->once())
            ->method('__invoke')
            ->with($test->identicalTo($expected));

        Promise::doReject($resolved)
            ->then(
                $test->expectCallableNever(),
                $mock
            );
    }

    /**
     *
     */
    public function testApiDoReject_RejectsPromise_WithRejectedPromise()
    {
        $test = $this->getTest();

        $expected = 123;
        $resolved = new PromiseRejected($expected);

        $mock = $test->createCallableMock();
        $mock
            ->expects($test->once())
            ->method('__invoke')
            ->with($test->identicalTo($expected));

        Promise::doReject($resolved)
            ->then(
                $test->expectCallableNever(),
                $mock
            );
    }

    /**
     *
     */
    public function testApiDoReject_ReturnsPromise()
    {
        $test = $this->getTest();
        $test->assertInstanceOf(PromiseInterface::class, Promise::doReject(1));
    }
}
