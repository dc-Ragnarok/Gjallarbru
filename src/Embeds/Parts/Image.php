<?php

namespace cmdstr\discordwebhook\Embeds\Parts;

use cmdstr\discordwebhook\ArraySerializer;

use Exception;

/**
 * @method self setUrl(string $url)
 * @method self setProxyUrl(string $proxy_url)
 * @method self setWidth(int $width)
 * @method self setHeight(int $height)
 * 
 * @see https://discord.com/developers/docs/resources/channel#embed-object-embed-image-structure
 * 
 * @author Command_String - https://discord.dog/232224992908017664
 */
class Image extends ArraySerializer {
    public function setUrl(string $url): self
    {
        return $this->setData("url", $url);
    }

    public function setProxyUrl(string $proxy_url): self
    {
        return $this->setData("proxy_url", $proxy_url);
    }

    public function setWidth(int $width): self
    {
        return $this->setData("width", $width);
    }

    public function setHeight(int $height): self
    {
        return $this->setData("height", $height);
    }

    protected function check(): void
    {
        if (!isset($this->data["url"])) {
            throw new Exception("An image URL must be set!");
        }
    }
}