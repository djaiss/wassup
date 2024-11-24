<?php

namespace App\Console\Commands;

use App\Actions\CreateCycle;
use App\Actions\CreateOrganization;
use App\Enums\Permission;
use App\Models\Member;
use App\Models\Organization;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SetupDummyAccount extends Command
{
    use ConfirmableTrait;

    protected ?\Faker\Generator $faker = null;

    protected User $user;

    protected Organization $organization;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wassup:dummy
                            {--migrate : Use migrate command instead of migrate:fresh.}
                            {--force : Force the operation to run.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepare an account with fake data so users can play with it';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // remove queue
        config(['queue.default' => 'sync']);

        $this->start();
        $this->wipeAndMigrateDB();
        $this->clearCache();
        $this->createFirstUser();
        $this->createOtherUsers();
        $this->createOrganization();
        $this->createCycles();

        $this->stop();
    }

    private function start(): void
    {
        if (! $this->confirmToProceed('Are you sure you want to proceed? This will delete ALL data in your environment.', true)) {
            exit;
        }

        $this->line('This process can take a few minutes to complete. Be patient and read a book in the meantime.');
        $this->faker = Faker::create();
    }

    private function wipeAndMigrateDB(): void
    {
        if ($this->option('migrate')) {
            $this->artisan('☐ Migration of the database', 'migrate', ['--force' => true]);
        } else {
            $this->artisan('☐ Migration of the database', 'migrate:fresh', ['--force' => true]);
        }
    }

    private function clearCache(): void
    {
        $this->artisan('☐ Clear cache', 'cache:clear');
    }

    private function stop(): void
    {
        $this->line('');
        $this->line('-----------------------------');
        $this->line('|');
        $this->line('| Welcome to Wassup');
        $this->line('|');
        $this->line('-----------------------------');
        $this->info('| You can now sign in with one of these two accounts:');
        $this->line('| An account with a lot of data:');
        $this->line('| username: admin@admin.com');
        $this->line('| password: admin123');
        $this->line('|------------------------–––-');
        $this->line('|A blank account:');
        $this->line('| username: blank@blank.com');
        $this->line('| password: blank123');
        $this->line('|------------------------–––-');
        $this->line('| URL:      ' . config('app.url'));
        $this->line('-----------------------------');

        $this->info('Setup is done. Have fun.');
    }

    private function createFirstUser(): void
    {
        $this->info('☐ Create first user of the account');

        DB::table('users')->insert([
            'name' => 'Michael Scott',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
        ]);

        $this->user = User::latest()->first();
        $this->user->email_verified_at = Carbon::now();
        $this->user->save();

        Auth::login($this->user);
    }

    private function createOtherUsers(): void
    {
        $this->info('☐ Create users');

        for ($i = 0; $i < random_int(3, 15); $i++) {
            User::create([
                'name' => $this->faker->name(),
                'email' => $this->faker->email,
                'password' => Hash::make('password'),
            ]);
        }
    }

    private function createOrganization(): void
    {
        $this->info('☐ Create organization');

        foreach (range(1, 5) as $number) {
            $this->organization = (new CreateOrganization(
                name: $this->faker->company,
            ))->execute();

            User::inRandomOrder()->whereNot('id', $this->user->id)->get()
                ->map(fn (User $user) => Member::create([
                    'user_id' => $user->id,
                    'organization_id' => $this->organization->id,
                    'permission' => Permission::Member,
                ]));
        }
    }

    private function createCycles(): void
    {
        $this->info('☐ Create cycles');

        foreach (range(1, 5) as $number) {
            (new CreateCycle(
                organization: $this->organization,
                number: $number,
                description: $this->faker->sentence,
                startedAt: Carbon::now()->subDays(random_int(1, 30)),
                endedAt: Carbon::now()->addDays(random_int(1, 30)),
                isActive: random_int(1, 2) == false,
                isPublic: random_int(1, 2) == false,
            ))->execute();
        }
    }

    private function artisan(string $message, string $command, array $arguments = []): void
    {
        $this->info($message);
        $this->callSilent($command, $arguments);
    }
}
