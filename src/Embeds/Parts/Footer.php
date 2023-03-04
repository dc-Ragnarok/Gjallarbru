<?php

namespace Discord\Webhook\Embeds\Parts;

use Discord\Webhook\ArraySerializer;
use Exception;

/**
 * @see https://discord.com/developers/docs/resources/channel#embed-object-embed-footer-structure
 */
class Footer extends ArraySerializer
{
    /**
     * @return Footer
     */
    public static function new(): self
    {
        return new self();
    }
    /**
     * @param string $text
     *
     * @return self
     */
    public function setText(string $text): self
    {
        return $this->setData("text", $text);
    }

    /**
     * @param string $iconURL
     *
     * @return self
     */
    public function setIconUrl(string $icon_url): self
    {
        return $this->setData("icon_url", $icon_url);
    }

    /**
     * @param string $proxy_icon_url
     *
     * @return self
     */
    public function setProxyIconUrl(string $proxy_icon_url): self
    {
        return $this->setData("proxy_icon_url", $proxy_icon_url);
    }

    /**
     * @return void
     */
    protected function check(): void
    {
        if (!isset($this->data["text"]) || empty($this->data["text"])) {
            throw new Exception("Footer text must be defined and cannot be empty!");
        }
    }
}
