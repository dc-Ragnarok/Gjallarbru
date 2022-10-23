<?php

namespace cmdstr\discordwebhook;

/**
 * @property array $data
 * 
 * @method self setData(string $key, mixed $value) Set data in the data array
 * @method string toJson() Converts data array to json string
 * @method array toArray() Returns a clone of the data array
 * @method void check() Used to perform checks on the data array before returning json/array
 * 
 * @author Command_String - https://discord.dog/232224992908017664
 */
abstract class ArraySerializer {
    protected array $data = [];

    final protected function setData(string $key, mixed $value): self
    {
        $this->data[$key] = $value;

        return $this;
    }

    final protected function toJson(): string
    {
        $this->check();

        return json_encode($this->data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    final protected function toArray(): array
    {
        $this->check();
        
        $that = clone $this;
        return $that->data;
    }

    abstract protected function check(): void;
}