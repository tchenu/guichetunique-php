<?php

namespace GuichetUnique\Endpoints;

use GuichetUnique\Traits\REST;

final class Attachments extends Endpoint
{
    use REST;

    public function resource(): string
    {
        return 'attachments';
    }
}