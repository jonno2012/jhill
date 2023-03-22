<?php

namespace App\Clients;

use App\Services\HttpInterface;

class Reqres implements ClientInterface
{
    /** @var HttpInterface */
    protected $http;

    public function __construct(HttpInterface $http)
    {
        $this->http = $http;
    }

    public const USERS_URI = 'users?page=';

    public function getUsers(int $page = 1): array
    {
        $url = $this->baseUrl().self::USERS_URI.$page;

        return self::transformData($this->http->get($url));
    }

    public function baseUrl(): string
    {
        return config('services.reqres.baseUrl');
    }

    public static function transformData(string $data): array
    {
        $data = json_decode($data);

        return collect($data->data)->map(function ($user) {
            return [
                'user_id' => $user->id,
                'email' => $user->email,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'avatar' => $user->avatar,
            ];
        })->toArray();
    }
}
