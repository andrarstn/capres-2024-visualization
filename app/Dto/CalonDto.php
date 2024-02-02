<?php

namespace App\Dto;

use App\Enum\Posisi;
use Carbon\Carbon;

class CalonDto
{
    public string $nomorUrut;

    public string $namaLengkap;

    public string $tempatLahir;

    public Carbon $tanggalLahir;

    public int $usia;

    public array $karir;

    public Posisi $posisi;

    public function __construct($data)
    {
        $this->nomorUrut = $data['nomor_urut'];
        $this->namaLengkap = $data['nama_lengkap'];
        $this->tempatLahir = $data['tempat_lahir'];
        $this->tanggalLahir = $data['tanggal_lahir'];
        $this->usia = $data['usia'];
        $this->karir = $data['karir'] ?? [];
        $this->posisi = $data['posisi'];
    }
}
