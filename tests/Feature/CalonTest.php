<?php

use App\Dto\CalonDto;
use App\Dto\KarirDto;
use App\Enum\Posisi;
use Carbon\Carbon;

it('can create CalonDto', function () {
    $karir = [
        'jabatan' => 'jabatan',
        'tahun_mulai' => '2008',
        'tahun_selesai' => '2010',
    ];

    $data = [
        'nomor_urut' => '1',
        'nama_lengkap' => 'John Doe',
        'tempat_lahir' => 'Kuningan',
        'tanggal_lahir' => Carbon::parse('7 May 1969'),
        'usia' => '59',
        'karir' => [new KarirDto($karir)],
        'posisi' => Posisi::PRESIDEN,
    ];

    $calonDto = new CalonDto($data);

    expect($calonDto)->toBeInstanceOf(CalonDto::class);
    expect($calonDto->nomorUrut)->toBe('1');
    expect($calonDto->namaLengkap)->toBe('John Doe');
    expect($calonDto->tempatLahir)->toBe('Kuningan');
    expect($calonDto->tanggalLahir)->toBeInstanceOf(Carbon::class);

    foreach ($calonDto->karir as $karirDto) {
        expect($karirDto)->toBeInstanceOf(KarirDto::class);
    }

    expect($calonDto->posisi)->toBe(Posisi::PRESIDEN);
});
