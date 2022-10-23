<?php

namespace Discord\Webhook\Parts;

use Discord\Webhook\ArraySerializer;
use Exception;

/** 
 * @see https://discord.com/developers/docs/resources/channel#allowed-mentions-object-allowed-mentions-structure
 */
class AllowedMentions extends ArraySerializer {
    /**
     * @param AllowedMentionTypes $type
     */
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

    /**
     * @param AllowedMentionTypes $type
     * @param string ...$snowflakes
     * 
     * @return self
     */
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

    /**
     * @return void
     */
    protected function check(): void
    {

    }
}