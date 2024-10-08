
<div class="title">
        <h2>Daftar Siswa Terdaftar</h2>
    </div>
    <div class="table-container">
        <table border="1" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Email</th>
                    <th>Hp</th>
                    <th>Semester</th>
                    <th>IPK</th>
                    <th>Beasiswa</th>
                    <th>Berkas</th>
                    <th>Status Ajuan</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include('./src/kernel/get_siswa.php');
            $no = 1; 
            foreach ($siswa as $s) {
                $filePath = $s['berkas'];
                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION); 

                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
            /*
                include 'conn.php';
                $nama_beasiswa = "SELECT nama_beasiswa FROM jenis_beasiswa WHERE id=$no"; 
                $result = mysqli_query($conn, $sql);

                $beasiswa = [];
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $beasiswa[] = $row;
                    }
                }
                ?>
            */
                echo "<td>" . htmlspecialchars($s['nama']) . "</td>";
                echo "<td>" . htmlspecialchars($s['email']) . "</td>";
                echo "<td>" . htmlspecialchars($s['hp']) . "</td>";
                echo "<td>" . htmlspecialchars($s['semester']) . "</td>";
                echo "<td>" . htmlspecialchars($s['ipk']) . "</td>";
                echo "<td>" . htmlspecialchars($s['beasiswa']) . "</td>";
                
                echo "<td>";
                if (!empty($filePath)) {
                    if ($fileExtension == 'pdf') {
                        echo "<a href='" . htmlspecialchars($filePath) . "' target='_blank'>Lihat PDF</a>";
                    } else if ($fileExtension == 'doc' || $fileExtension == 'docx') {
                        echo "<a href='" . htmlspecialchars($filePath) . "' download>Unduh DOC/DOCX</a>";
                    } else if ($fileExtension == 'zip') {
                        echo "<a href='" . htmlspecialchars($filePath) . "' download>Unduh ZIP</a>";
                    } else {
                        echo "Format tidak didukung";
                    }
                } else {
                    echo "Tidak ada berkas";
                }
                echo "</td>";
                
                echo "<td>" . htmlspecialchars($s['status_ajuan']) . "</td>";
                echo "</tr>";
            }
            ?>

            </tbody>
        </table>    
    </div>
    <script>


    let table = new DataTable('#myTable', {
        responsive: true
    });
       
    </script>