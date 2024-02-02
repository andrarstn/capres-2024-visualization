<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="antialiased">
    <div class="w-full p-20">
        <div class="flex flex-wrap justify-center">
            @foreach ($data as $index => $item)
                @if ($index % 2 === 0)
                    <h1 class="w-full text-center font-weight-bold text-xl">
                        {{ $item->nomorUrut }}
                    </h1>
                @endif
                <div
                    class="w-1/2 mb-20 border-y-2 border-l-2 {{ $index % 2 !== 0 ? 'border-r-2' : '' }}
                        border-slate-600 p-5">
                    <div>
                        <p class="text-center">
                            {{ $item->namaLengkap }}
                        </p>
                        <p class="text-center">
                            {{ $item->tempatLahir }}, {{ $item->tanggalLahir->format('d F Y') }}
                        </p>
                        <p class="text-center">
                            {{ $item->usia }} tahun
                        </p>

                        <p>Karir</p>
                        <div class="border-2 border-slate-600 p-5">
                            @foreach ($item->karir as $karir)
                                <p>{{ $karir->jabatan }}
                                    ({{ $karir->tahunMulai }}
                                    @php
                                        $tahunSelesai = $karir->tahunSelesai == 0 ? '' : '- ' . $karir->tahunSelesai;
                                    @endphp
                                    {{ $karir->tahunSelesai === -1 ? '- Sekarang' : $tahunSelesai }})
                                </p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
