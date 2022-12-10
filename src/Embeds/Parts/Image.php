<?php

namespace Discord\Webhook\Embeds\Parts;

use Discord\Webhook\ArraySerializer;
use Exception;

/**
 * @see https://discord.com/developers/docs/resources/channel#embed-object-embed-image-structure
 */
class Image extends ArraySerializer {
    /**
     * @return Image
     */
    public static function new(): self
    {
        return new self;
    }
    /**
     * @param string $url
     * 
     * @return self
     */
    public function setUrl(string $url): self
    {
        return $this->setData("url", $url);
    }

    /**
     * @param string $proxy_url
     * 
     * @return self
     */
    public function setProxyUrl(string $proxy_url): self
    {
        return $this->setData("proxy_url", $proxy_url);
    }

    /**
     * @param int $height
     * 
     * @return self
     */
    public function setWidth(int $width): self
    {
        return $this->setData("width", $width);
    }

    /**
     * @param int $height
     * 
     * @return self
     */
    public function setHeight(int $height): self
    {
        return $this->setData("height", $height);
    }

    /**
     * @return void
     */
    protected function check(): void
    {
        if (!isset($this->data["url"])) {
            throw new Exception("An image URL must be set!");
        }
    }
}