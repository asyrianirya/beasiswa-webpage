<?php
function generateRandomIPK()
{
  //return number_format(2.20,2);
  // return number_format(3.00,2);
    return number_format(rand(200, 400) / 100, 2);  
}

$ipk = generateRandomIPK();
$status_ajuan = 0;

$pdo = new PDO('mysql:host=localhost;dbname=beasiswa_webpage', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT id, nama_beasiswa FROM jenis_beasiswa";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$beasiswaOptions = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
</head>
<body onload="cekIPK('<?php echo $ipk; ?>')">
    <header>
      <?php include('./src/components/navigator.php'); ?>
    </header>

    <div class="title">
      <h1>DAFTAR SISWA BEASISWA</h1>
    </div>

    <main class="card">
    <form action="?page=hasil_pendaftaran" method="POST" enctype="multipart/form-data">
    <div class="card-title">
          <p>Registrasi Beasiswa</p>
        </div>
        <div class="card-content">
          <div class="form-group">
            <label for="name">Masukkan Nama</label>
            <input type="text" name="name" id="name" required />
          </div>
          <div class="form-group">
            <label for="email">Masukkan Email</label>
            <input type="email" name="email" id="email" required />
          </div>
          <div class="form-group">
            <label for="hp">Nomor HP</label>
            <input type="text" name="hp" id="hp" pattern="\+?[0-9]*" title="Hanya karakter + dan angka" required />
          </div>
          <div class="form-group">
            <label for="semester">Semester saat ini</label>
            <select name="semester" id="semester">
              <option value="1">1 (Satu)</option>
              <option value="2">2 (Dua)</option>
              <option value="3">3 (Tiga)</option>
              <option value="4">4 (Empat)</option>
              <option value="5">5 (Lima)</option>
              <option value="6">6 (Enam)</option>
              <option value="7">7 (Tujuh)</option>
              <option value="8">8 (Delapan)</option>
            </select>
          </div>
          <div class="form-group">
            <label>IPK terakhir</label>
            <input type="text"  value="<?= $ipk ?>" disabled />
            <input type="hidden" name="ipk" id="ipk" value="<?= $ipk ?>" />
            <p id="ipk-warning" style="display:none; color:red;">IPK kurang dari 3.0, pilihan beasiswa dan upload berkas tidak tersedia.</p>
          </div>
          <div class="form-group">
            <label for="beasiswa">Pilihan Beasiswa</label>
            <select name="beasiswa" id="beasiswa">
              <?php foreach ($beasiswaOptions as $option): ?>
                <option value="<?php echo htmlspecialchars($option['id']); ?>">
                  <?php echo htmlspecialchars($option['nama_beasiswa']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group berkas">
            <label for="berkas">Upload Berkas Syarat</label>
            <input
              name="berkas"
              id="berkas"
              type="file"
              value="Choose File" />
          </div>
          <input type="hidden" id="status_ajuan" name="status_ajuan" value="<?= $status_ajuan ?>"/>
          <input type="submit" id="submitBtn" value="Daftar" onsubmit="validateForm()"/>
          <input type="button" id="cancel" value="Batal" class="button-danger" />
        </div>
      </form>
    </main>
    <script>
      const nameElement = document.getElementById('name');
      const emailElement = document.getElementById('email');
      const hpElement = document.getElementById('hp');
      const ipkElement = document.getElementById('ipk');
      const batal = document.getElementById('cancel');
      batal.addEventListener('click', (event)=>{
        event.preventDefault();
        clearValue([nameElement,emailElement,hpElement,ipkElement])
      })
      function clearValue(array){
        array.forEach(element => {
          element.value = '';
        });
      }
    </script>
    <script>
        function validateForm() {
            var fileInput = document.getElementById('berkas');
            
            if (fileInput.files.length === 0) {
                alert('Silakan unggah berkas sebelum mengirim formulir.');
                return false; 
            }
            
            return true;
        }
    </script>
    <script>
        function cekIPK(ipk) {
            let ipkValue = parseFloat(ipk);
            
            if (ipkValue < 3.0) {
              disableElements(true);
            } else {
              disableElements(false);
            }

            function disableElements(bool){
              document.getElementById("beasiswa").disabled = bool;
                document.getElementById("berkas").disabled = bool;
                document.getElementById("submitBtn").disabled = bool;
                if(bool){
                  document.getElementById("ipk-warning").style.display = "block";
                } else {
                  document.getElementById("ipk-warning").style.display = "none";
                  document.getElementById("beasiswa").focus();
                }
            }
        }
    </script>
</body>