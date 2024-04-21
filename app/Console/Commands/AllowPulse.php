<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AllowPulse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:allow-pulse {userId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gives a user permission to access Pulse.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::find($this->argument("userId"));

        if (empty($user)) {
            return $this->error("User not found!");
        }

        $user->can_access_pulse = true;
        $user->save();

        $this->info("User " . $user->name . " can now access Pulse!");
    }
}
