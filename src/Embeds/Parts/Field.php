<?php

namespace Discord\Webhook\Embeds\Parts;

use Discord\Webhook\ArraySerializer;
use Exception;

/**
 * @see https://discord.com/developers/docs/resources/channel#embed-object-embed-field-structure
 */
class Field extends ArraySerializer {
    /**
     * @throws Exception
     * 
     * @return void
     */
    protected function check(): void
    {
        if (!isset($this->data["name"])) {
            throw new Exception("Field name must be defined!");
        }
        
        if (!isset($this->data["value"])) {
            throw new Exception("Field value must be defined!");
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
     * @param string $value
     * 
     * @return self
     */
    public function setValue(string $value): self
    {
        return $this->setData("value", $value);
    }

    /**
     * @param bool $inline
     * 
     * @return self
     */
    public function setInline(bool $inline): self
    {
        return $this->setData("inline", $inline);
    }
}