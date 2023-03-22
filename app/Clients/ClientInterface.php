<?php

namespace App\Clients;

interface ClientInterface
{
    public function getUsers(): array;

    public function baseUrl(): string;

    public static function transformData(string $data): array;
}
