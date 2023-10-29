<?php

namespace Cmslz\TencentMap;

use Cmslz\TencentMap\Exception\ServerException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response as GuzzleResponse;

/**
 * 请求类
 */
class Request
{
    protected string $key;

    protected Client $client;

    protected Response $response;

    protected array $config = [];

    protected array $headers = [];

    public function __construct(string $key, Client $client, array $config = [])
    {
        $this->key = $key;
        $this->client = $client;
        $this->config = $config;
    }

    private function formatPath(string $path, array $data = []): string
    {
        $data = array_merge($data, ['key' => $this->key]);
        $query = parse_url_query($path);
        $query['query'] = array_merge($query['query'], $data);
        return $query['path'] . '?' . http_build_query($query['query']);
    }

    /**
     * 发送get请求
     * @param string $path
     * @param array $data
     * @return Response
     * @throws GuzzleException
     * @throws ServerException
     */
    public function get(string $path, array $data = []): Response
    {
        return $this->beforeResponse(
            $this->client->request('get', $this->formatPath($path, $data), [
                'headers' => $this->headers
            ])
        );
    }

    /**
     * 发送post请求
     * @param string $path
     * @param array $data
     * @return Response
     * @throws GuzzleException
     * @throws ServerException
     */
    public function post(string $path, array $data = []): Response
    {
        return $this->beforeResponse(
            $this->client->request('post', $this->formatPath($path), [
                'form_params' => array_merge($data, ['key' => $this->key]),
                'headers' => $this->headers
            ])
        );
    }

    /**
     * 请求后前置处理response
     * @param GuzzleResponse $response
     * @return Response
     * @throws ServerException
     */
    protected function beforeResponse(GuzzleResponse $response): Response
    {
        $this->response = new Response($response);
        if ($this->response['status'] !== 0) {
            throw new ServerException($this->response['message']);
        }
        return $this->response();
    }

    /**
     * 获取相应
     * @return Response
     */
    private function response(): Response
    {
        return $this->response;
    }
}