<?php

namespace Discord\Webhook\Embeds\Parts;

use Discord\Webhook\ArraySerializer;
use Exception;

/**
 * @see https://discord.com/developers/docs/resources/channel#embed-object-embed-author-structure
 */
class Author extends ArraySerializer
{
    /**
     * @return Author
     */
    public static function new(): self
    {
        return new self();
    }

    /**
     * @throws Exception
     *
     * @return void
     */
    protected function check(): void
    {
        if (!isset($this->data["name"])) {
            throw new Exception("Author name must be defined!");
        }
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

    /**
     * @param string $icon_url
     *
     * @return self
     */
    public function setIconUrl(string $icon_url): self
    {
        return $this->setData("icon_url", $icon_url);
    }
}
