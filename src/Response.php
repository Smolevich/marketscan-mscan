<?php

namespace MarketScan;

class Response {

    protected $body;

    protected $info;

    protected $error;

    protected $code;

    protected $headers;

    public function __construct($response)
    {
        $this->body = $response["body"] ?? null;
        $this->headers = $response["headers"] ?? null;
        $this->info = $response["info"] ?? null;
        $this->code = $response["code"] ?? null;
        $this->error = $response["error"] ?? null;
    }

    public function getHeaders(): ?array
    {
        return $this->headers;
    }

    public function getInfo(): ?array
    {
        return $this->info;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getBody()
    {
        if ($this->error) {
            return $this->error;
        }
        $array = json_decode($this->body, true);
        return is_array($array) ? $array : $this->body;
    }

    public function getCode(): ?int
    {
        return (int)$this->code;
    }
}
