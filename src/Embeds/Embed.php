<?php

namespace cmdstr\discordwebhook\Embeds;

use cmdstr\discordwebhook\ArraySerializer;
use cmdstr\discordwebhook\Embeds\Parts\Field;
use cmdstr\discordwebhook\Embeds\Parts\Footer;
use cmdstr\discordwebhook\Embeds\Parts\Image;
use cmdstr\discordwebhook\Embeds\Parts\Thumbnail;

/**
 * @method self setTitle(string $title)
 * @method self setType(EmbedTypes $type)
 * @method self setDescription(string $description)
 * @method self setUrl(string $url)
 * @method self setTimestamp(string $timestamp)
 * @method self setColor(string $color)
 * @method self setFooter(Footer $footer)
 * @method self setImage(Image $image)
 * @method self setThumbnail(Thumbnail $thumbnail)
 * @method self addFields(Field ...$fields)
 * 
 * @see https://discord.com/developers/docs/resources/channel#embed-object-embed-structure
 * 
 * @author Command_String - https://discord.dog/232224992908017664
 */
class Embed extends ArraySerializer {
    protected function check(): void
    {
        
    }

    public function setTitle(string $title): self
    {
        return $this->setData("title", $title);
    }

    public function setType(EmbedTypes $type): self
    {
        return $this->setData("type", $type->value);
    }

    public function setDescription(string $description): self
    {
        return $this->setData("description", $description);
    }

    public function setUrl(string $url): self
    {
        return $this->setData("url", $url);
    }

    public function setTimestamp(string $timestamp): self
    {
        return $this->setData("timestamp", $timestamp);
    }

    public function setColor(string $color): self
    {
        return $this->setData("color", hexdec($color));
    }

    public function setFooter(Footer $footer): self
    {
        return $this->setData("footer", $footer->toArray());
    }

    public function setImage(Image $image): self
    {
        return $this->setData("image", $image->toArray());
    }

    public function setThumbnail(Thumbnail $thumbnail): self
    {
        return $this->setData("thumbnail", $thumbnail->toArray());
    }

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