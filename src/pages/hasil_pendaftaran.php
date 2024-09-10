<body>
<header>
      <?php include('./src/components/navigator.php'); ?>
</header>

<?php
function guidv4($data = null) {
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

$error = '';
$uploadDirectory = 'uploads/';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $pdo = new PDO('mysql:host=localhost;dbname=beasiswa_webpage', 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT id, nama_beasiswa FROM jenis_beasiswa";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $beasiswaOptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $hp = $_POST['hp'];
    $semester = $_POST['semester'];
    $beasiswa = isset($_POST['beasiswa']) ? $_POST['beasiswa'] : 'Tidak tersedia';
    $ipk = $_POST['ipk'];
    $status_ajuan = 0;
    $filename = '';
    

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorEmail = "Format email tidak valid!";
    }
    
    if (isset($_FILES['berkas'])) {
        if ($_FILES['berkas']['error'] == UPLOAD_ERR_OK) {
            $allowedTypes = ['application/pdf', 'image/jpeg', 'application/zip'];
            $fileType = $_FILES['berkas']['type'];
            
            if (in_array($fileType, $allowedTypes)) {

                $originalFilename = basename($_FILES['berkas']['name']);

                $filename = guidv4();
                $newFilename = $filename;
                
                $filePath = $uploadDirectory . $originalFilename;
                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION); 
                $fileBaseName = pathinfo($filePath, PATHINFO_FILENAME); 

                if (!is_dir($uploadDirectory)) {
                    mkdir($uploadDirectory, 0777, true);
                }

                do {
                    $newFilename = $filename . '.' . $fileExtension;
                    $filePath = $uploadDirectory . $newFilename;
                } while (file_exists($filePath)); 

                if (session_status() == PHP_SESSION_NONE) {
                    session_start(); 
                }    
                $_SESSION['uploaded_file'] = [
                    'filename' => $newFilename,
                    'path' => $filePath
                ];
                if (move_uploaded_file($_FILES['berkas']['tmp_name'],$filePath)) {
                    
                    echo "File berhasil diunggah: " . $newFilename;
                } else {
                    $errorBerkas = "Gagal memindahkan file.";
                }
            } else {
                $errorBerkas = "Tipe file tidak diizinkan. Hanya PDF, JPG, dan ZIP yang diperbolehkan.";
            }
        } else {
            $errorBerkas = "Terjadi kesalahan saat mengunggah file. Error code: " . $_FILES['berkas']['error'];
        }
    } else {
        $errorBerkas = "Tidak ada file yang diupload.";
    }
    
?>
<style>

</style>
    <div class="title">
        <h2>Hasil Pendaftaran</h2>
    </div>

    <main class="card">
    <form action="./src/kernel/set_siswa.php" method="POST" enctype="multipart/form-data">
    <div class="card-title">
          <p>Registrasi Beasiswa</p>
        </div>
        <div class="card-content">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" disabled value="<?=$name?>"/>
            <input type="hidden" name="name" id="name" value="<?=$name?>"/>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" disabled value="<?php 
                if (empty($errorEmail)) {
                    echo "$email";
                } else {
                    echo "Kesalahan: $errorEmail";
                }
            ?>" />
            <input type="email" name="email" id="email" hidden value="<?php 
                if (empty($errorEmail)) {
                    echo "$email";
                } else {
                    echo "";
                }
            ?>" />
          </div>
          <div class="form-group">
            <label >Nomor HP</label>
            <input type="text" disabled value="<?=$hp?>" />
            <input type="text" name="hp" id="hp" hidden value="<?=$hp?>" />
          </div>
          <div class="form-group">
            <label for="semester">Semester saat ini</label>
            <select disabled>
              <option value="1" <?php if ($semester == 1) echo 'selected'; ?> >1 (Satu)</option>
              <option value="2" <?php if ($semester == 2) echo 'selected'; ?> >2 (Dua)</option>
              <option value="3" <?php if ($semester == 3) echo 'selected'; ?> >3 (Tiga)</option>
              <option value="4" <?php if ($semester == 4) echo 'selected'; ?> >4 (Empat)</option>
              <option value="5" <?php if ($semester == 5) echo 'selected'; ?> >5 (Lima)</option>
              <option value="6" <?php if ($semester == 6) echo 'selected'; ?> >6 (Enam)</option>
              <option value="7" <?php if ($semester == 7) echo 'selected'; ?> >7 (Tujuh)</option>
              <option value="8" <?php if ($semester == 8) echo 'selected'; ?> >8 (Delapan)</option>
            </select>
            <select name="semester" id="semester" hidden>
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
            <label>IPK terakhir</label>
            <input type="text"  value="<?= $ipk ?>" disabled />
            <input type="text" id="ipk" name="ipk" value="<?= $ipk ?>" hidden />
          </div>
          <div class="form-group">
              <label for="beasiswa">Pilihan Beasiswa</label>
              <select disabled>
                  <?php foreach ($beasiswaOptions as $option): ?>
                      <option value="<?php echo htmlspecialchars($option['id']); ?>"
                          <?php if (isset($selectedBeasiswa) && $selectedBeasiswa == $option['id']) echo 'selected'; ?>>
                          <?php echo htmlspecialchars($option['nama_beasiswa']); ?>
                      </option>
                  <?php endforeach; ?>
              </select>
              <select name="beasiswa" id="beasiswa" hidden>
                  <?php foreach ($beasiswaOptions as $option): ?>
                      <option value="<?php echo htmlspecialchars($option['id']); ?>"
                          <?php if (isset($selectedBeasiswa) && $selectedBeasiswa == $option['id']) echo 'selected'; ?>>
                          <?php echo htmlspecialchars($option['nama_beasiswa']); ?>
                      </option>
                  <?php endforeach; ?>
              </select>
          </div>

          <div class="form-group berkas">
            <label>Upload Berkas Syarat</label>
            <input
              type="text"
              value="<?php 
                if (empty($errorBerkas)) {
                    echo "$originalFilename";
                } else {
                    echo "Kesalahan: $errorBerkas";
                }
              ?>" disabled />

                <?php               

                if (isset($_SESSION['uploaded_file'])) {
                    $fileInfo = $_SESSION['uploaded_file'];
                    $filename = $fileInfo['filename'];
                    $filePath = $fileInfo['path'];

                    echo '<a style="margin-left: 10px;" href="' . $filePath  . '" target="_blank">cek</a>';
                }
                ?>
              <input
              name="filePath"
              id="filePath"
              type="hidden"
              value="<?php 
                if (empty($errorBerkas)) {
                    echo "$filePath";
                } else {
                    echo "$errorBerkas";
                }
              ?>" hidden />
          </div>
          <div class="form-group">
            <label>Status Ajuan</label>
            <input type="text"  value="<?php 
                if($status_ajuan){
                    echo "Sudah terverifikasi";
                } else {
                    echo "Belum diverifikasi";
                }
            ?>" disabled />
            <input type="text" id="status_ajuan" name="status_ajuan" value="<?php 
                if($status_ajuan == 1){
                    echo "Sudah terverifikasi";
                } else if ($status_ajuan == 2) {
                    echo "Ditolak";
                } else {
                    echo "Belum diverifikasi";
                }
            ?>" hidden />
          </div>
          <div class="form-group" style="display: flex; flex-direction: column;">
                <input type="button" value="Kembali" class="button-danger" onclick="window.history.back()">
          </div>
          <div class="form-group" style="display: flex; flex-direction: column;">
                <input type="submit" value="KONFIRMASI">
          </div>
        </div>
      </form>
    </main>


<?php
} else {
    include('./src/components/siswa_terdaftar.php');
}
?>
</body>