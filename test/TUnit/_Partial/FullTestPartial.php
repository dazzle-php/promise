<?php

namespace Dazzle\Promise\Test\TUnit\_Partial;

trait FullTestPartial
{
    use ApiResolvePartial;
    use ApiRejectPartial;
    use ApiCancelPartial;
    use PromisePendingPartial;
    use PromiseFulfilledPartial;
    use PromiseRejectedPartial;
    use PromiseCancelledPartial;
}
