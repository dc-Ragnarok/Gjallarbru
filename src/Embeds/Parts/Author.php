<?php

namespace cmdstr\discordwebhook\Embeds\Parts;

use cmdstr\discordwebhook\ArraySerializer;
use Exception;

/**
 * @method self setName(string $name)
 * @method self setUrl(string $url)
 * @method self setIconUrl(string $icon_url)
 * 
 * @see https://discord.com/developers/docs/resources/channel#embed-object-embed-author-structure
 * 
 * @author Command_String - https://discord.dog/232224992908017664
 */
class Author extends ArraySerializer {
    protected function check(): void
    {
        if (!isset($this->data["name"])) {
            throw new Exception("Author name must be defined!");
        }
    }

    public function setName(string $name): self
    {
        return $this->setData("name", $name);
    }

    public function setUrl(string $url): self
    {
        return $this->setData("url", $url);
    }

    public function setIconUrl(string $icon_url): self
    {
        return $this->setData("icon_url", $icon_url);
    }
}