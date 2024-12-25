<?php

namespace Database\Factories;

use App\Models\UmkmOwner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UmkmOwner>
 */
class UmkmOwnerFactory extends Factory
{
    protected $model = UmkmOwner::class;
    public function definition(): array
    {
        $user = User::first() ?? User::factory()->create(); // Ambil user pertama atau buat baru jika belum ada
        return [
            'user_id' => $user->id,
            'npwp' => $this->faker->unique()->numerify('###############'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
