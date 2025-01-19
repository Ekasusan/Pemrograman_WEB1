<?php
include 'config.php';

// Tambah Data
if (isset($_POST['tambah'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    $query = "INSERT INTO mahasiswa (nim, nama_mhs, tgl_lahir, alamat, jenis_kelamin) 
              VALUES ('$nim', '$nama', '$tgl_lahir', '$alamat', '$jenis_kelamin')";
    mysqli_query($conn, $query);

    // Redirect untuk menghindari form resubmission
    header("Location: mahasiswa.php");
    exit();
}

// Hapus Data
if (isset($_GET['hapus'])) {
    $nim = $_GET['hapus'];
    $query = "DELETE FROM mahasiswa WHERE nim='$nim'";
    mysqli_query($conn, $query);

    // Redirect untuk menghindari URL resubmission
    header("Location: mahasiswa.php");
    exit();
}

// Edit Data
if (isset($_POST['update'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    $query = "UPDATE mahasiswa 
              SET nama_mhs='$nama', tgl_lahir='$tgl_lahir', alamat='$alamat', jenis_kelamin='$jenis_kelamin' 
              WHERE nim='$nim'";
    mysqli_query($conn, $query);

    // Redirect untuk menghindari form resubmission
    header("Location: mahasiswa.php");
    exit();
}

// Tampilkan Data
$result = mysqli_query($conn, "SELECT * FROM mahasiswa");

// Jika user memilih data untuk diedit
$editData = null;
if (isset($_GET['edit'])) {
    $nim = $_GET['edit'];
    $editResult = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$nim'");
    $editData = mysqli_fetch_assoc($editResult);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Data Mahasiswa</h1>

    <!-- Form Tambah Data -->
    <form method="POST">
        <h2>Tambah Data</h2>
        <input type="text" name="nim" placeholder="NIM" required>
        <input type="text" name="nama" placeholder="Nama" required>
        <input type="date" name="tgl_lahir" required>
        <textarea name="alamat" placeholder="Alamat" required></textarea>
        <select name="jenis_kelamin">
            <option value="L">Laki-Laki</option>
            <option value="P">Perempuan</option>
        </select>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <!-- Form Edit Data -->
    <?php if ($editData): ?>
    <form method="POST">
        <h2>Edit Data</h2>
        <input type="hidden" name="nim" value="<?= $editData['nim'] ?>" required>
        <input type="text" name="nama" placeholder="Nama" value="<?= $editData['nama_mhs'] ?>" required>
        <input type="date" name="tgl_lahir" value="<?= $editData['tgl_lahir'] ?>" required>
        <textarea name="alamat" placeholder="Alamat" required><?= $editData['alamat'] ?></textarea>
        <select name="jenis_kelamin">
            <option value="L" <?= $editData['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-Laki</option>
            <option value="P" <?= $editData['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
        </select>
        <button type="submit" name="update">Update</button>
    </form>
    <?php endif; ?>

    <!-- Tabel Data Mahasiswa -->
    <table border="1">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Tgl Lahir</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['nim'] ?></td>
                <td><?= $row['nama_mhs'] ?></td>
                <td><?= $row['tgl_lahir'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td><?= $row['jenis_kelamin'] ?></td>
                <td>
                    <a href="mahasiswa.php?edit=<?= $row['nim'] ?>">Edit</a> | 
                    <a href="mahasiswa.php?hapus=<?= $row['nim'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
