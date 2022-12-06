<?php

/**
 * TODO: Переписать в соответствии с PSR-7
 */
interface HTTPRequestService
{
    public function request(string $url, string $method, mixed $options = null): mixed;
}

class XMLHttpService extends XMLHTTPRequestService implements HTTPRequestService
{
}

class Http
{
    private HTTPRequestService $service;

    public function __construct(HTTPRequestService $xmlHttpService)
    {
    }

    public function get(string $url, array $options)
    {
        $this->service->request($url, 'GET', $options);
    }

    public function post(string $url)
    {
        $this->service->request($url, 'POST');
    }
}
