<?php

namespace App\Console\Commands;

use App\Services\HomeService;
use Illuminate\Console\Command;

class CapreskuCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'capresku';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menampilkan profil capres cawapres';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $datas = (new HomeService)->getData();

        foreach ($datas as $index => $value) {
            if ($index % 2 === 0) {
                echo 'Nomor Urut '.$value->nomorUrut.PHP_EOL;
            }
            echo 'Nama Lengkap: '.$value->namaLengkap.PHP_EOL;
            echo 'Tempat Tanggal Lahir: '.$value->tempatLahir.', '.$value->tanggalLahir->format('d F Y').PHP_EOL;
            echo 'Usia: '.$value->usia.' tahun'.PHP_EOL.PHP_EOL;
        }
    }
}
