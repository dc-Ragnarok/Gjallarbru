<?php

namespace cmdstr\discordwebhook\Embeds\Parts;

use cmdstr\discordwebhook\ArraySerializer;

use Exception;
/**
 * @method self setText(string $text)
 * @method self setIconUrl(string $icon_url)
 * @method self setProxyIconUrl(string $proxy_icon_url)
 * 
 * @see https://discord.com/developers/docs/resources/channel#embed-object-embed-footer-structure
 * 
 * @author Command_String - https://discord.dog/232224992908017664
 */
class Footer extends ArraySerializer {
    public function setText(string $text): self
    {
        return $this->setData("text", $text);
    }

    public function setIconUrl(string $icon_url): self
    {
        return $this->setData("icon_url", $icon_url);
    }

    public function setProxyIconUrl(string $proxy_icon_url): self
    {
        return $this->setData("proxy_icon_url", $proxy_icon_url);
    }

    protected function check(): void
    {
        if (!isset($this->data["text"]) || empty($this->data["text"])) {
            throw new Exception("Footer text must be defined and cannot be empty!");
        }
    }
}