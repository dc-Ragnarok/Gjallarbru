<?php

namespace cmdstr\discordwebhook\Embeds\Parts;

use cmdstr\discordwebhook\ArraySerializer;
use Exception;

/**
 * @method self setName(string $name)
 * @method self setValue(string $value)
 * @method self setInline(string $inline)
 * 
 * @see https://discord.com/developers/docs/resources/channel#embed-object-embed-field-structure
 * 
 * @author Command_String - https://discord.dog/232224992908017664
 */
class Field extends ArraySerializer {
    protected function check(): void
    {
        if (!isset($this->data["name"])) {
            throw new Exception("Field name must be defined!");
        }
        
        if (!isset($this->data["value"])) {
            throw new Exception("Field value must be defined!");
        }
    }

    public function setName(string $name): self
    {
        return $this->setData("name", $name);
    }

    public function setValue(string $value): self
    {
        return $this->setData("value", $value);
    }

    public function setInline(bool $inline): self
    {
        return $this->setData("inline", $inline);
    }
}