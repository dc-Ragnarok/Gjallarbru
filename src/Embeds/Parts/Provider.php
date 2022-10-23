<?php

namespace Discord\Webhook\Embeds\Parts;

use Discord\Webhook\ArraySerializer;

/**
 * @see https://discord.com/developers/docs/resources/channel#embed-object-embed-provider-structure
 */
class Provider extends ArraySerializer {
    /**
     * @return void
     */
    protected function check(): void
    {

    }

    /**
     * @param string $name
     * 
     * @return self
     */
    public function setName(string $name): self
    {
        return $this->setData("name", $name);
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
}