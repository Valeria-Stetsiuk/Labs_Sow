<?php


namespace services;


class SiteService extends CoreServices
{

    /**
     * @inheritDoc
     */
    protected function errors(): array
    {
        return [
            0 => ['code' => 200, 'message' => 'Undefined error'],
        ];
    }
}