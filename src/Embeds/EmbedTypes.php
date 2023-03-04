<?php

namespace Discord\Webhook\Embeds;

/**
 * @see https://discord.com/developers/docs/resources/channel#embed-object-embed-types
 */
enum EmbedTypes: string
{
    case RICH = "rich";
    case IMAGE = "image";
    case VIDEO = "video";
    case GIFV = "gifv";
    case ARTICLE = "article";
    case LINK = "link";
}
