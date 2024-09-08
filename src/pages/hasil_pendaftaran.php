<body>
<header>
      <?php include('./src/components/navigator.php'); ?>
</header>

<?php
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $hp = $_POST['hp'];
    $semester = $_POST['semester'];
    $beasiswa = isset($_POST['beasiswa']) ? $_POST['beasiswa'] : 'Tidak tersedia';
    $ipk = $_POST['ipk'];
    $status_ajuan = 0; //$_POST['status_ajuan'];
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
    
?>
<style>
.title {
    display: flex;
    justify-content: center;
}

</style>
    <div class="title">
        <h2>Hasil Pendaftaran</h2>
    </div>

    <main class="card">
    <form>
    <div class="card-title">
          <p>Registrasi Beasiswa</p>
        </div>
        <div class="card-content">
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" disabled value="<?=$name?>"/>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" disabled value="<?=$email?>" />
          </div>
          <div class="form-group">
            <label for="hp">Nomor HP</label>
            <input type="number" name="hp" id="hp" disabled value="<?=$hp?>" />
          </div>
          <div class="form-group">
            <label for="semester">Semester saat ini</label>
            <select name="semester" id="semester" disabled>
              <option value="1" <?php if ($semester == 1) echo 'selected'; ?> >1 (Satu)</option>
              <option value="2" <?php if ($semester == 2) echo 'selected'; ?> >2 (Dua)</option>
              <option value="3" <?php if ($semester == 3) echo 'selected'; ?> >3 (Tiga)</option>
              <option value="4" <?php if ($semester == 4) echo 'selected'; ?> >4 (Empat)</option>
              <option value="5" <?php if ($semester == 5) echo 'selected'; ?> >5 (Lima)</option>
              <option value="6" <?php if ($semester == 6) echo 'selected'; ?> >6 (Enam)</option>
              <option value="7" <?php if ($semester == 7) echo 'selected'; ?> >7 (Tujuh)</option>
              <option value="8" <?php if ($semester == 8) echo 'selected'; ?> >8 (Delapan)</option>
            </select>
          </div>
          <div class="form-group">
            <label for="ipk">IPK terakhir</label>
            <input type="text"  value="<?= $ipk ?>" disabled />
          </div>
          <div class="form-group">
            <label for="beasiswa">Pilihan Beasiswa</label>
            <select name="beasiswa" id="beasiswa" disabled>
              <option value="1" <?php if ($beasiswa == 1) echo 'selected'; ?> >Beasiswa 1</option>
              <option value="2" <?php if ($beasiswa == 2) echo 'selected'; ?> >Beasiswa 2</option>
              <option value="3" <?php if ($beasiswa == 3) echo 'selected'; ?> >Beasiswa 3</option>
            </select>
          </div>
          <div class="form-group berkas">
            <label for="berkas">Upload Berkas Syarat</label>
            <input
              name="berkas"
              id="berkas"
              type="text"
              value="<?php 
                if (empty($error)) {
                    echo "basename($filename)";
                } else {
                    echo "Kesalahan: $error";
                }
              ?>" disabled />
          </div>
          <div class="form-group">
            <label for="ipk">Status Ajuan</label>
            <input type="text"  value="<?php 
                if($status_ajuan){
                    echo "Sudah terverifikasi";
                } else {
                    echo "Belum diverifikasi";
                }
            ?>" disabled />
          </div>
        </div>
      </form>
    </main>


<?php
} else {
    echo "Form belum diisi.";
}
?>
</body>