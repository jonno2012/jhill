<?php

namespace App\Services;

use App\Clients\ClientInterface;
use App\User;

class UserService
{
    /** @var ClientInterface */
    protected $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function updateUsers(): void
    {
        User::query()->truncate();

        $users = $this->getUsers();

        // in Laravel 8 onwards, you would use Factory > make > saveMany for this??
        foreach ($users as $user) {
            User::create($user);
        }
    }

    public function getUsers(): array
    {
        return $this->client->getUsers();
    }
}
