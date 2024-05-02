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
            'jenis_agenda_tp' => $this->faker->text,
            'kode_lama' => $this->faker->text,
            'kode_baru' => $this->faker->text,
            'nomor_surat' => $this->faker->text,
            'opd_id' => $this->faker->randomNumber(),
            'tgl_surat' => $this->faker->date,
            'tgl_terima' => $this->faker->date,
            'acara' => $this->faker->text,
            'tanggalBerangkat' => $this->faker->date,
            'tanggalPulang' => $this->faker->date,
            'jamMulai' => $this->faker->time,
            'tempat' => $this->faker->text,
            'perihal' => $this->faker->text,
            'dok_surat' => $this->faker->text,
        ];
    }
}
