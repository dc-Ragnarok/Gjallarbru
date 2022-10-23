<?php

namespace cmdstr\discordwebhook;

use cmdstr\discordwebhook\Embeds\Embed;
use cmdstr\discordwebhook\Parts\AllowedMentions;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Utils;
use InvalidArgumentException;
use LengthException;
use Psr\Http\Message\ResponseInterface;

/**
 * @property string $payload
 * @property array  $files
 * @property int    $file_count
 * 
 * @method void __construct(string $url, string $thread_id = "", bool $wait = false)
 * @method self setContent(string $content)
 * @method self setUsername(string $username)
 * @method self setAvatarUrl(string $avatar_url)
 * @method self setTts(bool $tts)
 * @method self addEmbeds(Embed ...$embeds)
 * @method self setAllowedMentions(AllowedMentions $allowedMentions)
 * @method self addFile(string $path, string $name = "", string $description = "")
 * @method self addAttachment(int $file_id, string $file_name, string $description = "")
 * @method ResponseInterface send()
 * 
 * @see https://discord.com/developers/docs/resources/webhook#execute-webhook-jsonform-params
 * 
 * @author Command_String - https://discord.dog/232224992908017664
 */
class Webhook extends ArraySerializer {
    public string $payload;

    private array $files = [];
    private int $file_count = -1;

    public function __construct(private string $url, private string $thread_id = "", private bool $wait = false)
    {
        $this->url = $url;

        if (!empty($thread_id)) {
            $this->url .= "?thread_id=$thread_id";
        }

        if ($wait) {
            if (empty($thread_id)) {
                $this->url .= "?";
            } else {
                $this->url .= "&";
            }

            $this->url .= "wait=1";
        }
    }

    protected function check(): void
    {
        if (
            !isset($this->data["content"]) &&
            empty($this->files)            &&
            !isset($this->data["embeds"])  &&
            empty($this->data["embeds"])
        ) {
            throw new Exception("You must send at least one of the following: content, file, embeds");
        }
    }

    public function setContent(string $content): self
    {
        if (strlen($content) > 2000) {
            throw new LengthException("The content of a webhook cannot exceed 2000 characters!");
        }

        return $this->setData("content", $content);
    }

    public function setUsername(string $username): self
    {
        return $this->setData("username", $username);
    }

    public function setAvatarUrl(string $avatar_url): self
    {
        return $this->setData("avatar_url", $avatar_url);
    }

    public function setTts(bool $tts): self
    {
        return $this->setData("tts", $tts);
    }

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
    
    public function setAllowedMentions(AllowedMentions $allowedMentions) {
        $this->setData("allowed_mentions", $allowedMentions->toArray());
    }

    public function addFile(string $path, string $name = "", string $description = ""): self
    {
        if (!file_exists($path)) {
            throw new InvalidArgumentException("The file path specified doesn't lead to an existing file!");
        }

        if (empty($name)) {
            $name = pathinfo($path)['basename'];
        }

        $this->files[] = [
            'name' => 'files['.++$this->file_count.']',
            'contents' => Utils::tryFopen($path, 'r'),
            'filename' => $name,
            'headers'  => [
                'Content-Type' => '<Content-type header>'
            ]
        ];

        $this->addAttachment($this->file_count, $name, $description);

        return $this;
    }

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

        return $client->send((new Request('POST', $this->url)), $options);
    }
}