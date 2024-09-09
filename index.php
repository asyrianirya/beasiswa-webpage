<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrasi Beasiswa</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="./src/vendor/datatables/datatables.min.css" />
    
    <script src="./src/vendor/jquery/jquery-3.7.1.min.js"></script>
    <script src="./src/vendor/datatables/dataTables.min.js"></script>
    <script src="./src/index.js" type="module"></script>
    <?php 
    if(!isset($_GET['page'])){
      include('./src/pages/home.php');
    } else {
      if($_GET['page'] == 'hasil_pendaftaran'){
        include('./src/pages/hasil_pendaftaran.php');
      } else if($_GET['page'] == 'daftar_beasiswa'){
        include('./src/pages/daftar_beasiswa.php');
      } 
    }
    ?>

      <?php
      if(isset($_GET['success'])){
        echo "<script>";
        echo "alert('Data berhasil ditambahkan!')";
        echo "</script>";
      }
      ?>
</html>
