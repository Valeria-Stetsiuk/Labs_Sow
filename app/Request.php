<?php


namespace app;


class Request
{

    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public function isGet(): bool
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    public function post(): array|null
    {
        return $_POST ?? null;
    }


    public function get(string $key = ''): array|string|null
    {
        if(!empty($key)) {
            return $_GET[$key] ?? null;
        }
       return $_GET ?? null;
    }


}