<?php

namespace App\Console\Commands;

use App\Clients\ClientInterface;
use App\Services\UserService;
use Illuminate\Console\Command;

class UpdateUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the users table.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        (new UserService(app(ClientInterface::class)))->updateUsers();

        $this->info('Users updated!');
    }
}
