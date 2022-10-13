<?php

namespace GuichetUnique\Endpoints;

use GuichetUnique\Traits\HasAttachments;
use GuichetUnique\Traits\REST;

final class RegularizationRequests extends Endpoint
{
    use REST;

    public function resource(): string
    {
        return 'regularization_requests';
    }
}