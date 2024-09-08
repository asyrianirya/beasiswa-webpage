<?php
include 'conn.php';

$sql = "SELECT * FROM siswa_beasiswa"; 
$result = mysqli_query($conn, $sql);

$siswa = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $siswa[] = $row;
    }
}
?>