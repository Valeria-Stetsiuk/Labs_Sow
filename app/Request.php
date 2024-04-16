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

    public function get(): array|null
    {
       return $_GET ?? null;
    }


}