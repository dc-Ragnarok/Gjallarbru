<?php

namespace cmdstr\discordwebhook\Embeds\Parts;

use Exception;

/**
 * @method self setUrl(string $url)
 * @method self setProxyUrl(string $proxy_url)
 * @method self setWidth(int $width)
 * @method self setHeight(int $height)
 * 
 * @see https://discord.com/developers/docs/resources/channel#embed-object-embed-video-structure
 * 
 * @author Command_String - https://discord.dog/232224992908017664
 */
class Video extends Image {
    protected function check(): void
    {
        if (!isset($this->data["url"])) {
            throw new Exception("An video URL must be set!");
        }
    }
}