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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $email = $_POST['email'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $ttl = $_POST['ttl'];
    $alamat = $_POST['alamat'];
    $sma = $_POST['sma'];
    $tahun_tamat = $_POST['tahun_tamat'];
    $ortu = $_POST['ortu'];
    $jurusan = $_POST['jurusan'];
    $image = $_POST['image']; // base64 image data

    // Decode base64 image and save to file
    $folderPath = "uploads/";
    $image_parts = explode(";base64,", $image);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.png';
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);

    // Generate nomor pendaftaran
    $tahun = date("Y");
    $sql = "SELECT COUNT(*) as total FROM mahasiswa";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $next_id = $row['total'] + 1;
    $nomor_pendaftaran = $tahun . str_pad($next_id, 4, '0', STR_PAD_LEFT);

    // Insert data into database
    $sql = "INSERT INTO mahasiswa (nomor_pendaftaran, nama, jenis_kelamin, email, nomor_telepon, ttl, alamat, sma, tahun_tamat, ortu, jurusan, foto)
            VALUES ('$nomor_pendaftaran', '$nama', '$email', '$nomor_telepon', '$ttl', '$alamat', '$sma', '$tahun_tamat', '$ortu', '$jurusan', '$file')";

    if ($conn->query($sql) === TRUE) {
        $message = "Data berhasil disimpan. Nomor Pendaftaran Anda: $nomor_pendaftaran";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .message {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            text-align: center;
        }
        .message.error {
            background-color: #f44336;
        }
        h2 {
            margin-bottom: 10px;
        }
        p {
            font-size: 18px;
        }
        .button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="message <?php echo isset($message) && strpos($message, 'Error') !== false ? 'error' : ''; ?>">
        <h2><?php echo isset($message) && strpos($message, 'Error') !== false ? 'Proses Gagal' : 'Proses Pendaftaran Berhasil'; ?></h2>
        <p><?php echo $message; ?></p>
        <a href="index.php" class="button">Kembali ke Form Pendaftaran</a>
    </div>
</body>
</html>
