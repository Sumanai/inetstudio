<?php

// Какой-то глобальный конфиг
const SECRET_KEY_TYPE = 'file';

class Concept
{
    private $client;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    public function getUserData()
    {
        $params = [
            'auth' => ['user', 'pass'],
            'token' => $this->getSecretKey()
        ];

        $request = new \Request('GET', 'https://api.method', $params);
        $promise = $this->client->sendAsync($request)->then(function ($response) {
            $result = $response->getBody();
        });

        $promise->wait();
    }

    private function getSecretKey(): string
    {
        return AbstractKeysFactory::getFactory()->getSecretKey();
    }
}

abstract class AbstractKeysFactory
{
    public static function getFactory()
    {
        return match (SECRET_KEY_TYPE) {
            'file' => new FileKeyFactory(),
            'db' => new DBKeyFactory(),
            'memcache' => new MemcacheKeyFactory(),
                // etc
            default => throw new Exception('Unknown key storage type'),
        };
    }

    abstract public function getSecretKey(): string;
}

class FileKeyFactory extends AbstractKeysFactory
{
    public function getSecretKey(): string
    {
        return 'key from some file';
    }
}

class DBKeyFactory extends AbstractKeysFactory
{
    public function getSecretKey(): string
    {
        return 'key from some database';
    }
}

class MemcacheKeyFactory extends AbstractKeysFactory
{
    public function getSecretKey(): string
    {
        return 'key from memory';
    }
}
