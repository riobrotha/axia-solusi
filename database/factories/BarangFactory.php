<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_barang'   => fake()->words(mt_rand(1,4), true),
            'harga'         => fake()->randomNumber(mt_rand(5,7), true),
            'stok'          => mt_rand(1,20),
            'supplier_id'   => mt_rand(1,3),
            'created_by'    => 1,
            'updated_by'    => 1,
        ];
    }
}
