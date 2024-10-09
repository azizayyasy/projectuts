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

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM mahasiswa WHERE id=$delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='admin.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$sql = "SELECT * FROM mahasiswa";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Data Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            color: white;
            text-decoration: none;
        }
        .edit-btn, .delete-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }
        .delete-btn {
            background-color: #f44336;
        }
        .action-btns {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
    <h2>Data Calon Mahasiswa Baru</h2>
    <table>
        <tr>
            <th>Nomor Pendaftaran</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Email</th>
            <th>Nomor Telepon</th>
            <th>TTL</th>
            <th>Alamat</th>
            <th>Asal SMA</th>
            <th>Tahun Tamat</th>
            <th>Jurusan</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row['nomor_pendaftaran'] . "</td>
                    <td>" . $row['jenis_kelamin'] . "</td>
                    <td>" . $row['nama'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['nomor_telepon'] . "</td>
                    <td>" . $row['ttl'] . "</td>
                    <td>" . $row['alamat'] . "</td>
                    <td>" . $row['sma'] . "</td>
                    <td>" . $row['tahun_tamat'] . "</td>
                    <td>" . $row['jurusan'] . "</td>
                    <td><img src='" . $row['foto'] . "' width='100px'></td>
                    <td class='action-btns'>
                        <a href='edit.php?id=".$row['id']."' class='edit-btn'>Edit</a>
                        <a href='admin.php?delete_id=".$row['id']."' class='delete-btn' onclick='return confirm(\"Yakin ingin menghapus data ini?\");'>Hapus</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='11'>Belum ada data mahasiswa.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
