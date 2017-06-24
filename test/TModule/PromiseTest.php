<?php

namespace Dazzle\Promise\Test\TModule;

use Dazzle\Promise\Deferred;
use Dazzle\Promise\Test\TModule;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class PromiseTest extends TModule
{
    /**
     *
     */
    public function testPromise_SupportsVeryDeepNesting()
    {
        ini_set('xdebug.max_nesting_level', 8192);

        $deferreds = [];

        for ($i = 0; $i < 10; $i++)
        {
            $deferreds[] = $d = new Deferred();
            $p = $d->getPromise();
            $last = $p;
            for ($j = 0; $j < 500; $j++)
            {
                $last = $last->then(function($result) {
                    return $result;
                });
            }
        }

        $p = null;

        foreach ($deferreds as $d)
        {
            if ($p) {
                $d->resolve($p);
            }
            $p = $d->getPromise();
        }

        $deferreds[0]->resolve(true);

        $mock = $this->createCallableMock();
        $mock
            ->expects($this->once())
            ->method('__invoke')
            ->with($this->identicalTo(true));

        $deferreds[0]->getPromise()->then($mock);
    }
}
