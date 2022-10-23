<?php

namespace cmdstr\discordwebhook\Embeds;

/**
 * @see https://discord.com/developers/docs/resources/channel#embed-object-embed-types
 * 
 * @author Command_String - https://discord.dog/232224992908017664
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