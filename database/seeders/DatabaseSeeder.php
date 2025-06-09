<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Contact;
use App\Models\Message;
use App\Models\Room;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $mainUser = User::factory()->create([
            'name' => 'Mohammad',
            'username' => 'mohammad',
            'phone_number' => '09156640823',
            'password' => Hash::make('mohammad'),
        ]);

        $users = User::factory()->count(5)->create();

        foreach ($users as $user) {
                Contact::create([
                    'user_id' => $mainUser->id,
                    'contact_id' => $user->id,
                    'name' => $user->name,
                ]);
        }

        foreach ($users as $user) {
            $chat = Chat::createIfNotExist($mainUser->id, $user->id);

            for ($i = 0; $i < 10; $i++) {
                $sender = $i % 2 == 0 ? $mainUser : $user;
                Message::create([
                    'messagable_id' => $chat->id,
                    'messagable_type' => Chat::class,
                    'user_id' => $sender->id,
                    'content' => fake('fa_IR')->sentence(rand(1, 20)),
                ]);
            }
        }

        foreach (['group', 'channel'] as $type) {
            for ($i = 1; $i <= 3; $i++) {
                $room = Room::create([
                    'name' => fake()->word(),
                    'link' => fake()->unique()->userName(),
                    'type' => $type,
                    'owner_id' => $mainUser->id,
                ]);

                $room->members()->syncWithoutDetaching(array_merge([$mainUser->id], $users->pluck('id')->toArray()));

                foreach ($room->members as $member) {
                    for ($j = 0; $j < 5; $j++) {
                        Message::create([
                            'messagable_id' => $room->id,
                            'messagable_type' => Room::class,
                            'user_id' => $member->id,
                            'content' => fake('fa_IR')->sentence(rand(1, 20)),
                        ]);
                    }
                }
            }
        }
    }
}
