<?php

namespace Database\Factories;

use App\Models\SuratMasuk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuratMasuk>
 */
class SuratMasukFactory extends Factory
{
    protected $model = SuratMasuk::class;

    public function definition()
    {
        return [
            'jenis_agenda_tp' => $this->faker->randomNumber(),
            'kode_lama' => $this->faker->randomNumber(),
            'kode_baru' => $this->faker->randomNumber(),
            'nomor_surat' => $this->faker->sentence,
            'opd_id' => $this->faker->randomNumber(),
            'tgl_surat' => $this->faker->date,
            'tgl_terima' => $this->faker->date,
            'acara' => $this->faker->sentence,
            'tanggalBerangkat' => $this->faker->date,
            'tanggalPulang' => $this->faker->date,
            'jamMulai' => $this->faker->time,
            'tempat' => $this->faker->sentence,
            'perihal' => $this->faker->sentence,
            'dok_surat' => $this->faker->sentence,
        ];
    }
}
