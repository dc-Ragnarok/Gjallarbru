<?php

namespace Discord\Webhook\Embeds\Parts;

use Exception;

/**
 * @see https://discord.com/developers/docs/resources/channel#embed-object-embed-video-structure
 */
class Video extends Image {
    /**
     * @throws Exception
     * 
     * @return void
     */
    protected function check(): void
    {
        if (!isset($this->data["url"])) {
            throw new Exception("An video URL must be set!");
        }
    }
}