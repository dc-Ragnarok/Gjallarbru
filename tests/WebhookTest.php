<?php

namespace Tests\Discord\Webhook;

use Discord\Webhook\Webhook;
use LengthException;
use PHPUnit\Framework\TestCase;

class WebhookTest extends TestCase
{
    public function testSetContentTooLong()
    {
        $webhook = new Webhook(
            '::url::'
        );

        $webhook->setContent(str_repeat('a', 2000));

        $this->expectException(LengthException::class);
        $webhook->setContent(str_repeat('a', 2001));
    }
}
