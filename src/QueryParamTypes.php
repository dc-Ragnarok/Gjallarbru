<?php

namespace Discord\Webhook;

/**
 * @see https://discord.com/developers/docs/resources/webhook#execute-webhook-query-string-params
 */
enum QueryParamTypes: string
{
    case WAIT = "wait";
    case THREAD_ID = "thread_id";
}
