<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>{{ $title }}</h1>
    <h3>{{ $subtitle }}</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <!-- <th>Divisi</th> -->
                <th>Kategori</th>
                <th>Tipe</th>
                <!-- <th>Standarisasi</th> -->
                <th>Tanggal Arsip</th>
                <th>Jumlah Dokumen</th> <!-- Kolom untuk jumlah dokumen -->
            </tr>
        </thead>
        <tbody>
            @foreach ($archives as $archive)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @switch($archive->jenis_ba)
                    @case('bak')
                    Berita Acara Kesepakatan
                    @break

                    @case('ppt')
                    Persetujuan Pemilik Tanah
                    @break

                    @case('validasi')
                    Validasi Setelah Musyawarah
                    @break

                    @case('pgr')
                    Pembayaran Ganti Rugi
                    @break

                    @case('ba_ugr')
                    Berita Acara Uang Ganti Rugi
                    @break

                    @default
                    -
                    @endswitch
                    <!-- {{ $archive->title ?? '' }} -->
                </td>
                <!-- <td>{{ $archive->division->name ?? '' }}</td> -->
                <td>{{ $archive->type->category->name }}</td>
                <td>{{ $archive->type->name }}</td>
                <!-- <td>{{ $archive->standardization->name ?? ''}}</td> -->
                <td>{{ $archive->date }}</td>
                <td>{{ $archive->documents_count }} dokumen</td> <!-- Menampilkan jumlah dokumen -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>