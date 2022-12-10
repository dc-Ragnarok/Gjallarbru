<?php

namespace Discord\Webhook\Embeds;

use Discord\Webhook\ArraySerializer;
use Discord\Webhook\Embeds\Parts\Author;
use Discord\Webhook\Embeds\Parts\Field;
use Discord\Webhook\Embeds\Parts\Footer;
use Discord\Webhook\Embeds\Parts\Image;
use Discord\Webhook\Embeds\Parts\Thumbnail;
use Discord\Webhook\Embeds\Parts\Video;

/** 
 * @see https://discord.com/developers/docs/resources/channel#embed-object-embed-structure
 */
class Embed extends ArraySerializer {
    /**
     * @return Embed
     */
    public static function new(): self
    {
        return new self;
    }

    /**
     * @return void
     */
    protected function check(): void
    {
        
    }

    /**
     * @param string $title
     * 
     * @return self
     */
    public function setTitle(string $title): self
    {
        return $this->setData("title", $title);
    }

    /**
     * @param EmbedTypes $type
     * 
     * @return self
     */
    public function setType(EmbedTypes $type): self
    {
        return $this->setData("type", $type->value);
    }

    /**
     * @param string $description
     * 
     * @return self
     */
    public function setDescription(string $description): self
    {
        return $this->setData("description", $description);
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
     * @param string $timestamp
     * 
     * @return self
     */
    public function setTimestamp(string $timestamp): self
    {
        return $this->setData("timestamp", $timestamp);
    }

    /**
     * @param string $color
     * 
     * @return self
     */
    public function setColor(string $color): self
    {
        return $this->setData("color", hexdec($color));
    }

    /**
     * @param Footer $footer
     * 
     * @return self
     */
    public function setFooter(Footer $footer): self
    {
        return $this->setData("footer", $footer->toArray());
    }

    /**
     * @param Image $image
     * 
     * @return self
     */
    public function setImage(Image $image): self
    {
        return $this->setData("image", $image->toArray());
    }

    /**
     * @param Thumbnail $thumbnail
     * 
     * @return self
     */
    public function setThumbnail(Thumbnail $thumbnail): self
    {
        return $this->setData("thumbnail", $thumbnail->toArray());
    }

    public function setAuthor(Author $author): self
    {
        return $this->setData("author", $author->toArray());
    }

    public function setVideo(Video $video): self
    {
        return $this->setData("video", $video->toArray());
    }

    /**
     * @param Field ...$fields
     * 
     * @return self
     */
    public function addFields(Field ...$fields): self
    {
        if (!isset($this->data["fields"])) {
            $this->data["fields"] = [];
        }

        foreach ($fields as $field) {
            $this->data["fields"][] = $field->toArray();
        }

        return $this;
    }
}