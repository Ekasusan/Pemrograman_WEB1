<?php
include 'config.php';

// Tambah Data
if (isset($_POST['tambah'])) {
    $kode = $_POST['kode_matakuliah'];
    $nama = $_POST['nama_matakuliah'];
    $sks = $_POST['sks'];

    $query = "INSERT INTO matakuliah (kode_matakuliah, nama_matakuliah, sks) 
              VALUES ('$kode', '$nama', '$sks')";
    mysqli_query($conn, $query);

    // Redirect untuk menghindari form resubmission
    header("Location: matakuliah.php");
    exit();
}

// Hapus Data
if (isset($_GET['hapus'])) {
    $kode = $_GET['hapus'];
    $query = "DELETE FROM matakuliah WHERE kode_matakuliah='$kode'";
    mysqli_query($conn, $query);

    // Redirect untuk menghindari URL resubmission
    header("Location: matakuliah.php");
    exit();
}

// Edit Data
if (isset($_POST['update'])) {
    $kode = $_POST['kode_matakuliah'];
    $nama = $_POST['nama_matakuliah'];
    $sks = $_POST['sks'];

    $query = "UPDATE matakuliah 
              SET nama_matakuliah='$nama', sks='$sks' 
              WHERE kode_matakuliah='$kode'";
    mysqli_query($conn, $query);

    // Redirect untuk menghindari form resubmission
    header("Location: matakuliah.php");
    exit();
}

// Tampilkan Data
$result = mysqli_query($conn, "SELECT * FROM matakuliah");

// Jika user memilih data untuk diedit
$editData = null;
if (isset($_GET['edit'])) {
    $kode = $_GET['edit'];
    $editResult = mysqli_query($conn, "SELECT * FROM matakuliah WHERE kode_matakuliah='$kode'");
    $editData = mysqli_fetch_assoc($editResult);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data MataKuliah</title>
</head>
<body>
    <h1>Data MataKuliah</h1>

    <!-- Form Tambah Data -->
    <form method="POST">
        <h2>Tambah Data</h2>
        <input type="text" name="kode_matakuliah" placeholder="Kode Mata_Kuliah" required>
        <input type="text" name="nama_matakuliah" placeholder="Nama Mata_Kuliah" required>
        <input type="number" name="sks" placeholder="SKS" required>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <!-- Form Edit Data -->
    <?php if ($editData): ?>
    <form method="POST">
        <h2>Edit Data</h2>
        <input type="hidden" name="kode_matakuliah" value="<?= $editData['kode_matakuliah'] ?>" required>
        <input type="text" name="nama_matakuliah" placeholder="Nama Mata Kuliah" value="<?= $editData['nama_matakuliah'] ?>" required>
        <input type="number" name="sks" placeholder="SKS" value="<?= $editData['sks'] ?>" required>
        <button type="submit" name="update">Update</button>
    </form>
    <?php endif; ?>

    <!-- Tabel Data Mata_Kuliah -->
    <table border="1">
        <tr>
            <th>Kode</th>
            <th>Nama MataKuliah</th>
            <th>SKS</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['kode_matakuliah'] ?></td>
                <td><?= $row['nama_matakuliah'] ?></td>
                <td><?= $row['sks'] ?></td>
                <td>
                    <a href="matakuliah.php?edit=<?= $row['kode_matakuliah'] ?>">Edit</a> | 
                    <a href="matakuliah.php?hapus=<?= $row['kode_matakuliah'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
