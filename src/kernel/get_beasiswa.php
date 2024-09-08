<?php
include 'conn.php';

$sql = "SELECT * FROM jenis_beasiswa"; 
$result = mysqli_query($conn, $sql);

$beasiswa = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $beasiswa[] = $row;
    }
}
?>