<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penerimaan Mahasiswa Baru</title>
    <script src="webcam.min.js"></script>
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
        #my_camera {
            width: 320px;
            height: 240px;
            margin: 15px 0;
        }
        #results {
            width: 320px;
            height: 240px;
            border: 1px solid;
        }
    </style>
</head>
<body>
    <h2>Penerimaan Mahasiswa Baru</h2>
    <form action="process.php" method="post" enctype="multipart/form-data">
        <label>Nama Calon Mahasiswa Baru:</label>
        <input type="text" name="nama" required>

        <label>Jenis Kelamin:</label>
        <select name="jenis_kelamin" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Nomor Telepon:</label>
        <input type="text" name="nomor_telepon" required>

        <label>Tempat Tanggal Lahir:</label>
        <input type="text" name="ttl" required>

        <label>Alamat:</label>
        <input type="text" name="alamat" required>

        <label>Asal SMA:</label>
        <input type="text" name="sma" required>

        <label>Tahun Tamat:</label>
        <input type="number" name="tahun_tamat" required>

        <label>Nama Orang Tua:</label>
        <input type="text" name="ortu" required>

        <label>Jurusan:</label>
        <select name="jurusan" required>
            <option value="Teknik Komputer dan Informatika">Teknik Komputer dan Informatika</option>
            <option value="Teknik Sipil">Teknik Sipil</option>
            <option value="Teknik Mesin">Teknik Mesin</option>
            <option value="Akuntansi">Akuntansi</option>
        </select>

        <label>Foto Calon Mahasiswa:</label>
        <div id="my_camera"></div>
        <input type="hidden" name="image" class="image-tag">
        <div id="results"></div>
        <br/>
        <input type="button" class="button" value="Ambil Foto" onClick="takeSnapshot()">
        <br/><br/>

        <input type="submit" value="Submit" class="button">
    </form>

    <script>
        // Set up the camera
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#my_camera');

        // Take snapshot and display the result
        function takeSnapshot() {
            Webcam.snap(function(data_uri) {
                document.querySelector('.image-tag').value = data_uri;
                document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
            });
        }
    </script>
</body>
</html>
