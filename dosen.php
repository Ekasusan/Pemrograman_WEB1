<?php
include 'config.php';

// Tambah Data
if (isset($_POST['tambah'])) {
    $nidn = $_POST['nidn'];
    $nama_dosen = $_POST['nama_dosen'];

    $query = "INSERT INTO dosen (nidn, nama_dosen) VALUES ('$nidn', '$nama_dosen')";
    mysqli_query($conn, $query);

    // Redirect untuk menghindari form resubmission
    header("Location: dosen.php");
    exit();
}

// Hapus Data
if (isset($_GET['hapus'])) {
    $nidn = $_GET['hapus'];
    $query = "DELETE FROM dosen WHERE nidn='$nidn'";
    mysqli_query($conn, $query);

    // Redirect untuk menghindari URL resubmission
    header("Location: dosen.php");
    exit();
}

// Edit Data
if (isset($_POST['update'])) {
    $nidn = $_POST['nidn'];
    $nama_dosen = $_POST['nama_dosen'];

    $query = "UPDATE dosen SET nama_dosen='$nama_dosen' WHERE nidn='$nidn'";
    mysqli_query($conn, $query);

    // Redirect untuk menghindari form resubmission
    header("Location: dosen.php");
    exit();
}

// Tampilkan Data
$result = mysqli_query($conn, "SELECT * FROM dosen");

// Jika user memilih data untuk diedit
$editData = null;
if (isset($_GET['edit'])) {
    $nidn = $_GET['edit'];
    $editResult = mysqli_query($conn, "SELECT * FROM dosen WHERE nidn='$nidn'");
    $editData = mysqli_fetch_assoc($editResult);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Dosen</title>
</head>
<body>
    <h1>Data Dosen</h1>

    <!-- Form Tambah Data -->
    <form method="POST">
        <h2>Tambah Data</h2>
        <input type="text" name="nidn" placeholder="NIDN" required>
        <input type="text" name="nama_dosen" placeholder="Nama Dosen" required>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <!-- Form Edit Data -->
    <?php if ($editData): ?>
    <form method="POST">
        <h2>Edit Data</h2>
        <input type="hidden" name="nidn" value="<?= $editData['nidn'] ?>" required>
        <input type="text" name="nama_dosen" placeholder="Nama Dosen" value="<?= $editData['nama_dosen'] ?>" required>
        <button type="submit" name="update">Update</button>
    </form>
    <?php endif; ?>

    <!-- Tabel Data Dosen -->
    <table border="1">
        <tr>
            <th>NIDN</th>
            <th>Nama Dosen</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['nidn'] ?></td>
                <td><?= $row['nama_dosen'] ?></td>
                <td>
                    <a href="dosen.php?edit=<?= $row['nidn'] ?>">Edit</a> | 
                    <a href="dosen.php?hapus=<?= $row['nidn'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
