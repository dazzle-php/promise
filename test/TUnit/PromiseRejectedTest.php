<?php

namespace Dazzle\Promise\Test\TUnit;

use Dazzle\Promise\Test\TUnit\_Bridge\DeferredBridge;
use Dazzle\Promise\Test\TUnit\_Partial\PromiseRejectedPartial;
use Dazzle\Promise\DeferredInterface;
use Dazzle\Promise\PromiseInterface;
use Dazzle\Promise\PromiseRejected;
use Dazzle\Promise\Test\TUnit;
use Dazzle\Throwable\Exception\Logic\InvalidArgumentException;
use Exception;

class PromiseRejectedTest extends TUnit
{
    use PromiseRejectedPartial;

    /**
     * @return DeferredInterface
     */
    public function createDeferred()
    {
        $promise = null;

        return new DeferredBridge([
            'getPromise' => function() use (&$promise) {
                if (!$promise)
                {
                    throw new Exception(sprintf("[%s] must be rejected before obtaining the promise.", PromiseRejected::class));
                }
                return $promise;
            },
            'resolve' => function() {
                throw new Exception(sprintf("You cannot call resolve() for [%s].", PromiseRejected::class));
            },
            'reject' => function($reason = null) use(&$promise) {
                if (!$promise)
                {
                    $promise = new PromiseRejected($reason);
                }
            },
            'cancel' => function() {
                throw new Exception(sprintf("You cannot call cancel() for [%s].", PromiseRejected::class));
            }
        ]);
    }

    /**
     * @param string[] $methods
     * @return PromiseInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    public function createPromiseMock($methods = [])
    {
        return $this->getMock(PromiseRejected::class, $methods);
    }

    /**
     *
     */
    public function testApiConstructor_ThrowsException_IfConstructedWithPromise()
    {
        $this->setExpectedException(InvalidArgumentException::class);
        $promise = new PromiseRejected(new PromiseRejected());
    }
}
