# commandstring-discordwebhook #
A composer package for creating discord webhooks

# Requirements #
PHP 8.1=<
Composer 2
Basic PHP OOP Knowledge
Basic Knowledge on discord webhooks

# Basic Example #

```php
$webhook = new Webhook("https://discord.com/api/webhooks/xxxxxx/xxxxxx");

$webhook->setContent("Hello world!")->send();
```

# Basic Embedded Example #

```php
$webhook
    ->addEmbeds(Embed::new()
        ->setTitle("Basic Embed")
        ->setDescription("A basic embedded message")
        ->setColor("#8800FF")
        ->addFields(
            Field::new()
                ->setName("Field 1")
                ->setValue("Field 2"),
            Field::new()
                ->setName("Field 2")
                ->setValue("Field 2"),
            Field::new()
                ->setName("Field 3")
                ->setValue("Field 3")
        )
    )
    ->send()
;
```

# Uploading Files #

```php
$webhook
    ->addFile("/path/to/file")
    ->send()
;
```

# Sending Webhook to Thread #

```php
$webhook
    ->addQueryParam(QueryParamTypes::THREAD_ID, "<thread_id>")
    // ...
;
```

or 

```php
$webhook = new Webhook("https://discord.com/api/webhooks/xxxxxx/xxxxxx", "<thread_id>");
```