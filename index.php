<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrasi Beasiswa</title>
    <link rel="stylesheet" href="style.css" />
    
    <?php if(!isset($_GET['page'])){
      include('./src/pages/home.php');
    } else {
      if($_GET['page'] == 'hasil_pendaftaran')
      include('./src/pages/hasil_pendaftaran.php');
    }
    
    ?>
</html>
