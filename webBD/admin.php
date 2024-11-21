<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce"; // Ganti dengan nama database Anda

$conn = new mysqli(hostname: $servername, username: $username, password: $password, database: $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data pesanan
$sql = "SELECT * FROM pesanan ORDER BY dibuat DESC";
$result = $conn->query($sql);

// Menutup koneksi setelah query
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pesanan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Dashboard Admin - Daftar Pesanan</h2>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username Pelanggan</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan data pesanan
                $no = 1;
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['produk']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['jumlah']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['dibuat']) . "</td>";
                    echo "<td>
                            <a href='hapus_pesanan.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus pesanan?\")'>Hapus</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">Tidak ada pesanan saat ini.</p>
    <?php endif; ?>
</div>

<!-- JS dan Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
