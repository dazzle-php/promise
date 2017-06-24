<?php

namespace Dazzle\Promise\Test\TUnit;

use Dazzle\Promise\Test\TUnit\_Bridge\DeferredBridge;
use Dazzle\Promise\Test\TUnit\_Partial\FullTestPartial;
use Dazzle\Promise\Deferred;
use Dazzle\Promise\DeferredInterface;
use Dazzle\Promise\Promise;
use Dazzle\Promise\PromiseInterface;
use Dazzle\Promise\Test\TUnit;

class DeferredTest extends TUnit
{
    use FullTestPartial;

    /**
     * @return DeferredInterface
     */
    public function createDeferred()
    {
        $d = new Deferred();

        return new DeferredBridge([
            'getPromise' => [ $d, 'getPromise' ],
            'resolve'    => [ $d, 'resolve' ],
            'reject'     => [ $d, 'reject' ],
            'cancel'     => [ $d, 'cancel' ],
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
}
