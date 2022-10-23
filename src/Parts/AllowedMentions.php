<?php

namespace cmdstr\discordwebhook\Parts;

use cmdstr\discordwebhook\ArraySerializer;
use Exception;

/**
 * @method self allowMentionType(AllowedMentionTypes $type)
 * @method self addSnowflakes(AllowedMentionTypes $type, string ...$snowflakes)
 * 
 * @see https://discord.com/developers/docs/resources/channel#allowed-mentions-object-allowed-mentions-structure
 */
class AllowedMentions extends ArraySerializer {
    public function allowMentionType(AllowedMentionTypes $type): self
    {
        if ($type !== AllowedMentionTypes::EVERYONE && isset($this->data[$type->value])) {
            throw new Exception("You cannot use allowMentionType if you need to define specific snowflakes");
        }

        if (!isset($this->data["parse"])) {
            $this->data["parse"] = [];
        }

        if (!in_array($type->value, $this->data["parse"])) {
            $this->data["parse"][] = $type->value;
        }

        return $this;
    }

    public function addSnowflakes(AllowedMentionTypes $type, string ...$snowflakes): self
    {
        if (isset($this->data["parse"]) && in_array($type->value, $this->data["parse"])) {
            throw new Exception("You cannot use allowMentionType if you need to define specific snowflakes");
        }

        if (!isset($this->data[$type->value]) && $type !== AllowedMentionTypes::EVERYONE) {
            $this->data[$type->value] = [];
        }

        if ($type === AllowedMentionTypes::EVERYONE) {
            throw new Exception("You cannot add snowflakes for the everyone type!");
        }

        foreach ($snowflakes as $snowflake) {
            $this->data[$type->value][] = $snowflake;
        }

        return $this;
    }

    protected function check(): void
    {

    }
}