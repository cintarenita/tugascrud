<?php
// konfigurasi database
$host     = "localhost";
$username = "root";
$password = "";
$database = "kuliah";

// membuat koneksi ke database
$conn = mysqli_connect($host, $username, $password, $database);

// cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mendapatkan data dari tabel
$query = "SELECT mahasiswa.nama as nama_mahasiswa, matakuliah.nama as nama_matakuliah, matakuliah.jumlah_sks as jumlah_sks FROM krs LEFT JOIN mahasiswa ON krs.mahasiswa_npm = mahasiswa.npm LEFT JOIN matakuliah ON krs.matakuliah_kodemk = matakuliah.kodemk";
$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style2.css">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css.map">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="tabel-data">
        <div class="tabel-row" padding:"5">
            <?php
            // Mengecek apakah query berhasil dieksekusi
            if ($result) {
                // Mengecek apakah ada data yang ditemukan
                if (mysqli_num_rows($result) > 0) { ?>
                    <table border="1" cellpadding="10" cellspacing="0">
                        <tr>
                            <th>id</th>
                            <th>Mahasiswa</th>
                            <th>Mata Kuliah</th>
                            <th>Keterangan</th>


                        </tr>

                        <?php
                        $nomor = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?= $nomor ?></td>
                                <td><?= $row['nama_mahasiswa'] ?></td>
                                <td><?= $row['nama_matakuliah'] ?></td>
                                <td><?= $row['nama_mahasiswa'] ?> Mengambil Mata Kuliah <?= $row['nama_matakuliah'] ?> (<?= $row['jumlah_sks'] ?> SKS)
                            </tr>
                        <?php
                            $nomor++;
                        } ?>
                    </table>
            <?php        } else {
                    echo "Data Kosong";
                }
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            ?>
        </div>
    </div>
    </div>

    <script>
        var nilaiUTS = document.querySelectorAll('table td:nth-child(6)');
        var nilaiUAS = document.querySelectorAll('table td:nth-child(7)');

        // Menghitung total nilai dengan rumus 45% nilai UTS + 55% nilai UAS
        var total = [];
        for (var i = 0; i < nilaiUTS.length; i++) {
            var nilaiUts = parseInt(nilaiUTS[i].textContent);
            var nilaiUas = parseInt(nilaiUAS[i].textContent);
            var totalNilai = (nilaiUts * 0.45) + (nilaiUas * 0.55);
            total.push(totalNilai);
        }

        // Menghitung jumlah siswa dengan total nilai di atas 80
        var count = 0;
        for (var j = 0; j < total.length; j++) {
            if (total[j] < 80) {
                count++;
            }
        }

        // Menghitung persentase siswa dengan total nilai di atas 80
        var percentage = (count / total.length) * 100;

        // Menampilkan persentase di dalam div dengan id "percentage"
        var percentageDiv = document.getElementById('percentage1');
        percentageDiv.textContent = percentage.toFixed(2) + '%';
    </script>

    <script>
        // Mendapatkan semua nilai UTS dan UAS dari tabel
        var nilaiUTS = document.querySelectorAll('table td:nth-child(6)');
        var nilaiUAS = document.querySelectorAll('table td:nth-child(7)');

        // Menghitung total nilai dengan rumus 45% nilai UTS + 55% nilai UAS
        var total = [];
        for (var i = 0; i < nilaiUTS.length; i++) {
            var nilaiUts = parseInt(nilaiUTS[i].textContent);
            var nilaiUas = parseInt(nilaiUAS[i].textContent);
            var totalNilai = (nilaiUts * 0.45) + (nilaiUas * 0.55);
            total.push(totalNilai);
        }

        // Menghitung jumlah siswa dengan total nilai di atas 80
        var count = 0;
        for (var j = 0; j < total.length; j++) {
            if (total[j] > 80) {
                count++;
            }
        }

        // Menghitung persentase siswa dengan total nilai di atas 80
        var percentage = (count / total.length) * 100;

        // Menampilkan persentase di dalam div dengan id "percentage"
        var percentageDiv = document.getElementById('percentage');
        percentageDiv.textContent = percentage.toFixed(2) + '%';
    </script>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>