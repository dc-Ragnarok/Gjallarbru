<?php

namespace Discord\Webhook;

use Discord\Webhook\Embeds\Embed;
use Discord\Webhook\Parts\AllowedMentions;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Utils;
use InvalidArgumentException;
use LengthException;
use Psr\Http\Message\ResponseInterface;

/**
 * @see https://discord.com/developers/docs/resources/webhook#execute-webhook-jsonform-params
 *
 * @author Command_String - https://discord.dog/232224992908017664
 */
class Webhook extends ArraySerializer
{
    public string $payload;

    private array $files = [];
    private int $file_count = -1;
    private array $query_params = [];

    /**
     * @param string $url
     * @param string $thread_id
     */
    public function __construct(private string $url, string $thread_id = "")
    {
        if (!empty($thread_id)) {
            $this->addQueryParam(QueryParamTypes::THREAD_ID, $thread_id);
        }
    }

    /**
     * @return void
     */
    protected function check(): void
    {
        if (
            !isset($this->data["content"]) &&
            !isset($this->data["embeds"])  &&
            empty($this->files)
        ) {
            throw new Exception("You must send at least one of the following: content, file, embeds");
        }
    }

    /**
     * @param QueryParamTypes $type
     * @param mixed $value
     *
     * @return self
     */
    public function addQueryParam(QueryParamTypes $type, mixed $value): self
    {
        if ($type === QueryParamTypes::WAIT && !is_bool($value)) {
            throw new Exception("WAIT query parameter must be an int or bool!");
        } elseif ($type === QueryParamTypes::THREAD_ID && !is_string($value)) {
            throw new Exception("THREAD_ID query parameter must be a string!");
        }

        $this->query_params[$type->value] = $value;

        return $this;
    }

    /**
     * @param string $content
     *
     * @return self
     */
    public function setContent(string $content): self
    {
        if (mb_strlen($content) > 2000) {
            throw new LengthException("The content of a webhook cannot exceed 2000 characters!");
        }

        return $this->setData("content", $content);
    }

    /**
     * @param string $username
     *
     * @return self
     */
    public function setUsername(string $username): self
    {
        return $this->setData("username", $username);
    }

    /**
     * @param string $avatar_url
     *
     * @return self
     */
    public function setAvatarUrl(string $avatar_url): self
    {
        return $this->setData("avatar_url", $avatar_url);
    }

    /**
     * @param bool $tts
     *
     * @return self
     */
    public function setTts(bool $tts): self
    {
        return $this->setData("tts", $tts);
    }

    /**
     * @param Embed $embeds
     *
     * @return self
     */
    public function addEmbeds(Embed ...$embeds): self
    {
        if (!isset($this->data["embeds"])) {
            $this->data["embeds"] = [];
        }

        foreach ($embeds as $embed) {
            $this->data["embeds"][] = $embed->toArray();
        }

        return $this;
    }

    /**
     * @param AllowedMentions $allowedMentions
     *
     * @return self
     */
    public function setAllowedMentions(AllowedMentions $allowedMentions): self
    {
        return $this->setData("allowed_mentions", $allowedMentions->toArray());
    }

    /**
     * @param string $path
     * @param string $name
     * @param string $description
     *
     * @return self
     */
    public function addFile(string $path, string $name = "", string $description = ""): self
    {
        if (!file_exists($path)) {
            throw new InvalidArgumentException("The file path specified doesn't lead to an existing file!");
        }

        if (empty($name)) {
            $name = pathinfo($path)['basename'];
        }

        $this->files[] = [
            'name' => 'files[' . ++$this->file_count . ']',
            'contents' => Utils::tryFopen($path, 'r'),
            'filename' => $name,
            'headers'  => [
                'Content-Type' => '<Content-type header>'
            ]
        ];

        $this->addAttachment($this->file_count, $name, $description);

        return $this;
    }

    /**
     * @param int $file_id
     * @param string $file_name
     * @param string $description
     *
     * @return self
     */
    private function addAttachment(int $file_id, string $file_name, string $description = ""): self
    {
        if (!isset($this->data["attachments"])) {
            $this->data["attachments"] = [];
        }

        $this->data["attachments"][] = [
            "id" => $file_id,
            "filename" => $file_name,
            "description" => $description
        ];

        return $this;
    }

    /**
     * @return ResponseInterface
     */
    public function send(): ResponseInterface
    {
        $client = new Client(["verify" => false]);
        $options = [
            'multipart' => [
                ...$this->files,
                [
                    "name" => "payload_json",
                    "contents" => $this->toJson()
                ]
            ]
        ];

        if (!empty($this->query_params)) {
            $this->url .= "?" . http_build_query($this->query_params);
        }

        return $client->send((new Request('POST', $this->url)), $options);
    }
}
