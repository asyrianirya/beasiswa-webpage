<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('conn.php');
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $hp = mysqli_real_escape_string($conn, $_POST['hp']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $ipk = mysqli_real_escape_string($conn, $_POST['ipk']);
    $beasiswa = isset($_POST['beasiswa']) ? mysqli_real_escape_string($conn, $_POST['beasiswa']) : 'Tidak tersedia';
    $status_ajuan = mysqli_real_escape_string($conn, $_POST['status_ajuan']);

    if (session_status() == PHP_SESSION_NONE) {
        session_start(); 
    }    

    if (isset($_SESSION['uploaded_file'])) {
        $fileInfo = $_SESSION['uploaded_file'];
        $filename = $fileInfo['filename'];
        $fileTempPath = $fileInfo['temp_path'];
        $filePath = $fileInfo['path'];
    }

    if (move_uploaded_file($fileTempPath, $filePath)) {
        echo "File berhasil diunggah: " . $newFilename;
    } else {
        $errorBerkas = "Gagal memindahkan file.";
    }

    if (rename($fileTempPath, $filePath)) {
        echo "File berhasil dipindahkan ke lokasi permanen.";
    } else {
        echo "Gagal memindahkan file.";
    }
    

    $sql = "INSERT INTO siswa_beasiswa (nama, email, hp, semester, ipk, beasiswa, berkas, status_ajuan) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, 'ssiisiss', $name, $email, $hp, $semester, $ipk, $beasiswa, $filePath, $status_ajuan);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../../index.php?page=hasil_pendaftaran&success");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    } else {
    echo "Error preparing the statement: " . mysqli_error($conn);
    }

    mysqli_close($conn);

}
?>