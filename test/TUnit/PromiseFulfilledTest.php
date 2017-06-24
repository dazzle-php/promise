<?php

namespace Dazzle\Promise\Test\TUnit;

use Dazzle\Promise\Test\TUnit\_Bridge\DeferredBridge;
use Dazzle\Promise\Test\TUnit\_Partial\PromiseFulfilledPartial;
use Dazzle\Promise\DeferredInterface;
use Dazzle\Promise\PromiseFulfilled;
use Dazzle\Promise\PromiseInterface;
use Dazzle\Promise\Test\TUnit;
use Dazzle\Throwable\Exception\Logic\InvalidArgumentException;
use Exception;

class PromiseFulfilledTest extends TUnit
{
    use PromiseFulfilledPartial;

    /**
     * @return DeferredInterface
     */
    public function createDeferred()
    {
        $promise = null;

        return new DeferredBridge([
            'getPromise' => function() use(&$promise) {
                if (!$promise)
                {
                    throw new Exception(sprintf("[%s] must be resolved before obtaining the promise.", PromiseFulfilled::class));
                }
                return $promise;
            },
            'resolve' => function($value = null) use(&$promise) {
                if (!$promise)
                {
                    $promise = new PromiseFulfilled($value);
                }
            },
            'reject' => function() {
                throw new Exception(sprintf("You cannot call reject() for [%s].", PromiseFulfilled::class));
            },
            'cancel' => function() {
                throw new Exception(sprintf("You cannot call cancel() for [%s].", PromiseFulfilled::class));
            }
        ]);
    }

    /**
     * @param string[] $methods
     * @return PromiseInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    public function createPromiseMock($methods = [])
    {
        return $this->getMock(PromiseFulfilled::class, $methods);
    }

    /**
     *
     */
    public function testApiConstructor_ThrowsException_IfConstructedWithPromise()
    {
        $this->setExpectedException(InvalidArgumentException::class);
        $promise = new PromiseFulfilled(new PromiseFulfilled());
    }
}
