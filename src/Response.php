<?php

namespace Cmslz\TencentMap;

/**
 * 响应类
 */
class Response implements \ArrayAccess
{
    protected \GuzzleHttp\Psr7\Response $response;
    protected array $result;

    public function __construct(\GuzzleHttp\Psr7\Response $response)
    {
        $this->response = $response;
        $this->result = json_decode($this->rawData(), JSON_UNESCAPED_UNICODE);
    }

    protected function rawData(): string
    {
        return (string)$this->response->getBody();
    }

    public function toArray(): array
    {
        return $this->result['result'];
    }

    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->result);
    }

    public function offsetGet(mixed $offset)
    {
        return $this->result[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->result[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->result[$offset]);
    }
}