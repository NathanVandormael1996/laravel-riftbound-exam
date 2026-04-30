<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Enums\UserRole;
use App\Enums\ProductBadge;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@riftbound.com',
            'password' => bcrypt('password'),
            'role' => UserRole::ADMIN->value,
        ]);

        // Regular user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => UserRole::USER->value,
        ]);

        // Factions (Categories)
        $factions = [
            'Demacia' => 'A proud, military-driven kingdom.',
            'Noxus' => 'A powerful, expansionist empire.',
            'Ionia' => 'A land of magic and balance.',
            'Piltover' => 'The city of progress and invention.',
            'Zaun' => 'The polluted undercity beneath Piltover.',
            'Freljord' => 'A harsh, frozen land of tribes.',
            'Shadow Isles' => 'A cursed land of the undead.',
            'Bilgewater' => 'A haven for smugglers, marauders, and the unscrupulous.',
            'Bandle City' => 'The whimsical home of the yordles.',
            'Void' => 'A nightmarish dimension of nothingness.',
            'Targon' => 'A towering peak of celestial magic.',
            'Shurima' => 'A fallen desert empire seeking rebirth.',
            'Ixtal' => 'A hidden jungle land of elemental mastery.',
            'Neutral' => 'Cards that can be played in any deck.',
        ];

        foreach ($factions as $name => $desc) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $desc,
                'is_active' => true,
            ]);
        }

        $this->call(RealCardSeeder::class);
    }
}
