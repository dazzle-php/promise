<?php

namespace Dazzle\Promise\Test\TUnit;

use Dazzle\Promise\Test\TUnit\_Bridge\DeferredBridge;
use Dazzle\Promise\Test\TUnit\_Partial\FullTestPartial;
use Dazzle\Promise\Test\TUnit\_Partial\FunctionTestPartial;
use Dazzle\Promise\DeferredInterface;
use Dazzle\Promise\Promise;
use Dazzle\Promise\PromiseInterface;
use Dazzle\Promise\Test\TUnit;
use Exception;

class PromiseTest extends TUnit
{
    use FullTestPartial;
    use FunctionTestPartial;

    /**
     * @return DeferredInterface
     */
    public function createDeferred()
    {
        $resolveCallback = $rejectCallback = $cancelCallback = null;

        $promise = new Promise(function($resolve, $reject, $cancel) use(&$resolveCallback, &$rejectCallback, &$cancelCallback) {
            $resolveCallback = $resolve;
            $rejectCallback  = $reject;
            $cancelCallback  = $cancel;
        });

        return new DeferredBridge([
            'getPromise' => function() use($promise) {
                return $promise;
            },
            'resolve'    => $resolveCallback,
            'reject'     => $rejectCallback,
            'cancel'     => $cancelCallback
        ]);
    }

    /**
     * @param string[] $methods
     * @return PromiseInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    public function createPromiseMock($methods = [])
    {
        return $this->getMock(Promise::class, $methods);
    }

    /**
     *
     */
    public function testCasePromise_RejectsPromise_IfResolverThrowsException()
    {
        $exception = new Exception('foo');
        $promise = new Promise(function() use($exception) {
            throw $exception;
        });

        $mock = $this->createCallableMock();
        $mock
            ->expects($this->once())
            ->method('__invoke')
            ->with($this->identicalTo($exception));

        $promise
            ->then(
                $this->expectCallableNever(),
                $mock
            );
    }
}
