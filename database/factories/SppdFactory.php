<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sppd;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sppd>
 */
class SppdFactory extends Factory
{
    protected $model = Sppd::class;

    public function definition()
    {
        return [
            'maksud' => $this->faker->sentence,
            'untuk' => $this->faker->name,
            'tingkat_id' => $this->faker->randomNumber(),
            'alat_angkut_st' => $this->faker->word,
            'tempat_berangkat' => $this->faker->city,
            'tempat_tujuan' => $this->faker->city,
            'tgl_berangkat' => $this->faker->date(),
            'tgl_kembali' => $this->faker->date(),
            'hari' => $this->faker->word,
            'ditetapkan_tgl' => $this->faker->date(),
            'pengikut' => $this->faker->name,
            'keterangan' => $this->faker->sentence,
        ];
    }
}
