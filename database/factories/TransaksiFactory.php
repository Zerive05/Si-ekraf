<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "id_penjual" => "1",
            "id_pembeli" => "2",
            "id_produk" => "1",
            "jmlprod" => rand(1, 100), // Corrected the rand function call
            "created_at" => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now')->format('Y-m-d H:i:s'),
            "updated_at" => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
