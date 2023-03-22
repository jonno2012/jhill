<?php

namespace Tests\Feature;

use App\Clients\ClientInterface;
use App\Services\UserService;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group api
 */
class UserServiceTest extends TestCase
{
    use RefreshDatabase;
    public const NUMBER_OF_USER_ARRAY_VALUES = 5;

    public function testApiRespondsWithCorrectValues()
    {
        $users = (new UserService(app(ClientInterface::class)))->getUsers();

        $this->assertNotEmpty($users);

        $intersectingValues = count(
            array_intersect_key(
                $users[0],
                [
                    'user_id' => 1,
                    'email' => '',
                    'first_name' => '',
                    'last_name' => '',
                    'avatar' => '',
                ]
            )
        );

        $this->assertEquals(self::NUMBER_OF_USER_ARRAY_VALUES, $intersectingValues);
    }

    public function testUsersUpdateProperly()
    {
        $dummyData = [
            ['user_id' => '4', 'email' => 'test1@test.com', 'first_name' => 'first_name_1', 'last_name' => 'last_name_1', 'avatar' => 'avatar_1'],
            ['user_id' => '7', 'email' => 'test2@test.com', 'first_name' => 'first_name_2', 'last_name' => 'last_name_2', 'avatar' => 'avatar_2'],
        ];

        $clientMock = \Mockery::mock(ClientInterface::class);
        $clientMock->shouldReceive('getUsers')->andReturn($dummyData);

        (new UserService($clientMock))->updateUsers();

        $users = User::all();
        $users = $users->map(function ($user) {
            return [
                'user_id' => $user->user_id,
                'email' => $user->email,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'avatar' => $user->avatar,
            ];
        })->toArray();

        $this->assertSame($dummyData, $users);
    }
}
