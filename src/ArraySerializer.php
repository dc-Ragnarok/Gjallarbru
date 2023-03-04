<?php

namespace Discord\Webhook;

/**
 * @property array $data
 */
abstract class ArraySerializer
{
    protected array $data = [];

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return self
     */
    final protected function setData(string $key, mixed $value): self
    {
        $this->data[$key] = $value;

        return $this;
    }

    /**
     * @return string
     */
    final protected function toJson(): string
    {
        $this->check();

        return json_encode($this->data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return array
     */
    final protected function toArray(): array
    {
        $this->check();

        $that = clone $this;
        return $that->data;
    }

    /**
     * @return void
     */
    abstract protected function check(): void;
}
