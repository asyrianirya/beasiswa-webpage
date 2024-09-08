<?php
$status_ajuan = "Belum diverifikasi";
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $hp = $_POST['hp'];
    $semester = $_POST['semester'];
    $beasiswa = isset($_POST['beasiswa']) ? $_POST['beasiswa'] : 'Tidak tersedia';
    $ipk = $_POST['ipk'];
    $filename = '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid!";
    }
    
    if (isset($_FILES['berkas'])) {
        if ($_FILES['berkas']['error'] == UPLOAD_ERR_OK) {
            $allowedTypes = ['application/pdf', 'image/jpeg', 'application/zip'];
            $fileType = $_FILES['berkas']['type'];
            
            if (in_array($fileType, $allowedTypes)) {
                $filename = $_FILES['berkas']['name'];
            } else {
                $error = "Tipe file tidak diizinkan. Hanya PDF, JPG, dan ZIP yang diperbolehkan.";
            }
        } else {
            $error = "Terjadi kesalahan saat mengunggah file. Error code: " . $_FILES['berkas']['error'];
        }
    } else {
        $error = "Tidak ada file yang diupload.";
    }
    

    echo "<h2>Hasil Pendaftaran</h2>";
    echo "Nama: $name <br>";
    echo "Email: $email <br>";
    echo "Nomor HP: $hp <br>";
    echo "Semester: $semester <br>";
    echo "IPK: $ipk <br>";
    echo "Beasiswa: $beasiswa <br>";
    echo "Status Ajuan: $status_ajuan <br>";

    if (empty($error)) {
        echo "File yang diunggah: " . basename($filename) . "<br>";
    } else {
        echo "Kesalahan: $error<br>";
    }
} else {
    echo "Form belum diisi.";
}
?>
