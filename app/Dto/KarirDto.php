<?php

namespace App\Dto;

class KarirDto
{
    public string $jabatan;

    public int $tahunMulai;

    public ?int $tahunSelesai;

    public function __construct($data)
    {
        $this->jabatan = $data['jabatan'];
        $this->tahunMulai = $data['tahun_mulai'];
        $this->tahunSelesai = $data['tahun_selesai'];
    }
}
