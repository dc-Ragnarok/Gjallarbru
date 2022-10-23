<?php

namespace cmdstr\discordwebhook\Embeds\Parts;

use cmdstr\discordwebhook\ArraySerializer;

/**
 * @method self setName(string $name)
 * @method self setUrl(string $url)
 * 
 * @see https://discord.com/developers/docs/resources/channel#embed-object-embed-provider-structure
 * 
 * @author Command_String - https://discord.dog/232224992908017664
 */
class Provider extends ArraySerializer {
    protected function check(): void
    {

    }

    public function setName(string $name): self
    {
        return $this->setData("name", $name);
    }

    public function setUrl(string $url): self
    {
        return $this->setData("url", $url);
    }
}