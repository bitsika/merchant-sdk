<?php

namespace Bitsika\Resources\Contracts;


interface HttpClientInterface
{

    public function get($url, array $params = []);

    public function post($url, array $params = []);

    public function put($url, array $params = []);

    public function patch($url, array $params = []);

    public function delete($url);

    public function withHeader(array $headers);

    public function withToken(string $token);

}