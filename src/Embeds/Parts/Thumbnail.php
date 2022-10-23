<?php

namespace Discord\Webhook\Embeds\Parts;

use Exception;

/**
 * @see https://discord.com/developers/docs/resources/channel#embed-object-embed-thumbnail-structure
 */
class Thumbnail extends Image {
    /**
     * @throws Exception
     * 
     * @return void
     */
    protected function check(): void
    {
        if (!isset($this->data["url"])) {
            throw new Exception("An thumbnail URL must be set!");
        }
    }
}