<?php

namespace App\Services;

use App\Dto\CalonDto;
use App\Dto\KarirDto;
use App\Enum\Posisi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class HomeService
{
    public function getData()
    {
        $request = Http::get('https://mocki.io/v1/92a1f2ef-bef2-4f84-8f06-1965f0fca1a7');

        $calonDtos = [];
        if ($request->successful()) {
            foreach (['calon_presiden', 'calon_wakil_presiden'] as $posisi) {
                foreach ($request->json($posisi) as $profil) {
                    $data = [
                        'nomor_urut' => $profil['nomor_urut'],
                        'nama_lengkap' => $profil['nama_lengkap'],
                        'tempat_lahir' => Str::of($profil['tempat_tanggal_lahir'])->beforeLast(','),
                        'tanggal_lahir' => Carbon::parse(
                            $this->parseTanggalLahir($profil['tempat_tanggal_lahir'])
                        ),
                        'usia' => $this->hitungUmur($profil['tempat_tanggal_lahir']),
                        'karir' => array_map(
                            fn ($profilKarir) => $this->parseKarir($profilKarir),
                            $profil['karir'] ?? []
                        ),
                        'posisi' => $posisi === 'calon_presiden' ? Posisi::PRESIDEN : Posisi::WAKIL_PRESIDEN,
                    ];

                    $calonDtos[] = new CalonDto($data);
                }
            }
        }

        return array_values(collect($calonDtos)->sortBy('nomorUrut')->toArray());
    }

    public function parseTanggalLahir(string $tanggalLahir): string
    {
        $monthMapping = [
            'Januari' => 'January',
            'Februari' => 'February',
            'Maret' => 'March',
            'April' => 'April',
            'Mei' => 'May',
            'Juni' => 'June',
            'Juli' => 'July',
            'Agustus' => 'August',
            'September' => 'September',
            'Oktober' => 'October',
            'November' => 'November',
            'Desember' => 'December',
        ];

        $getDate = trim(Str::of($tanggalLahir)->afterLast(','));

        $explodeDate = explode(' ', $getDate);

        $englishMonth = $monthMapping[$explodeDate[1]];

        return sprintf('%s %s %s', $explodeDate[0], $englishMonth, $explodeDate[2]);
    }

    public function hitungUmur(string $tanggalLahir): int
    {
        $currentDate = Carbon::now();
        $getDate = $this->parseTanggalLahir($tanggalLahir);

        return $currentDate->diffInYears(Carbon::parse($getDate));
    }

    public function parseKarir(string $karir): KarirDto
    {
        $data['jabatan'] = Str::of($karir)->beforeLast('(');
        $data['tahun_mulai'] = Str::of($karir)->afterLast('(')->beforeLast('-')->toInteger();
        $until = Str::of($karir)->afterLast('-')->beforeLast(')');
        $data['tahun_selesai'] = ctype_alpha($until->value()) ? -1 : $until->toInteger();

        return new KarirDto($data);
    }
}
