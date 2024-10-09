<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_mahasiswa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil ID mahasiswa dari URL
$id = $_GET['id'];

// Ambil data mahasiswa berdasarkan ID
$sql = "SELECT * FROM mahasiswa WHERE id = $id";
$result = $conn->query($sql);
$mahasiswa = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update data mahasiswa
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $ttl = $_POST['ttl'];
    $alamat = $_POST['alamat'];
    $sma = $_POST['sma'];
    $tahun_tamat = $_POST['tahun_tamat'];
    $ortu = $_POST['ortu'];
    $jurusan = $_POST['jurusan'];
    $email = $_POST['email'];
    $nomor_telepon = $_POST['nomor_telepon'];

    $sql_update = "UPDATE mahasiswa SET 
        nama='$nama',
        jenis_kelamin='$jenis_kelamin', 
        ttl='$ttl', 
        alamat='$alamat', 
        sma='$sma', 
        tahun_tamat='$tahun_tamat', 
        ortu='$ortu', 
        jurusan='$jurusan', 
        email='$email', 
        nomor_telepon='$nomor_telepon' 
        WHERE id=$id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Data berhasil diupdate.";
    } else {
        echo "Error: " . $sql_update . "<br>" . $conn->error;
    }

    $conn->close();
    header('Location: admin.php'); // Kembali ke halaman admin
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }
        form {
            width: 500px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin: 15px 0 5px;
        }
        input, select {
            width: 100%;
            padding: 8px;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Edit Data Mahasiswa</h2>
    <form action="" method="post">
        <label>Nama Calon Mahasiswa:</label>
        <input type="text" name="nama" value="<?php echo $mahasiswa['nama']; ?>" required>

        <label>Jenis Kelamin:</label>
        <select name="jenis_kelamin" required>
            <option value="Laki-laki" <?php if ($row['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
            <option value="Perempuan" <?php if ($row['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
        </select>

        <label>Tempat Tanggal Lahir:</label>
        <input type="text" name="ttl" value="<?php echo $mahasiswa['ttl']; ?>" required>

        <label>Alamat:</label>
        <input type="text" name="alamat" value="<?php echo $mahasiswa['alamat']; ?>" required>

        <label>Asal SMA:</label>
        <input type="text" name="sma" value="<?php echo $mahasiswa['sma']; ?>" required>

        <label>Tahun Tamat:</label>
        <input type="number" name="tahun_tamat" value="<?php echo $mahasiswa['tahun_tamat']; ?>" required>

        <label>Nama Orang Tua:</label>
        <input type="text" name="ortu" value="<?php echo $mahasiswa['ortu']; ?>" required>

        <label>Jurusan:</label>
        <select name="jurusan" required>
            <option value="Teknik Komputer dan Informatika" <?php if ($mahasiswa['jurusan'] == 'Teknik Komputer dan Informatika') echo 'selected'; ?>>Teknik Komputer dan Informatika</option>
            <option value="Teknik Sipil" <?php if ($mahasiswa['jurusan'] == 'Teknik Sipil') echo 'selected'; ?>>Teknik Sipil</option>
            <option value="Teknik Mesin" <?php if ($mahasiswa['jurusan'] == 'Teknik Mesin') echo 'selected'; ?>>Teknik Mesin</option>
            <option value="Akuntansi" <?php if ($mahasiswa['jurusan'] == 'Akuntansi') echo 'selected'; ?>>Akuntansi</option>
        </select>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $mahasiswa['email']; ?>" required>

        <label>Nomor Telepon:</label>
        <input type="text" name="nomor_telepon" value="<?php echo $mahasiswa['nomor_telepon']; ?>" required>

        <input type="submit" value="Update Data" class="button">
    </form>
</body>
</html>
