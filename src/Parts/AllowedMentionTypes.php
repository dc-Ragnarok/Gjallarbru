<?php

namespace Discord\Webhook\Parts;

/**
 * @see https://discord.com/developers/docs/resources/channel#allowed-mentions-object-allowed-mention-types
 */
enum AllowedMentionTypes: string
{
    case USERS = "users";
    case ROLES = "roles";
    case EVERYONE = "everyone";
}
