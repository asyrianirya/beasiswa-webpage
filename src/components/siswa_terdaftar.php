<link rel="stylesheet" href="src/vendor/datatables/colResize/jquery.dataTables.colResize.css" />
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
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $s['nama'] . "</td>";
                        echo "<td>" . $s['email'] . "</td>";
                        echo "<td>" . $s['hp'] . "</td>";
                        echo "<td>" . $s['semester'] . "</td>";
                        echo "<td>" . $s['ipk'] . "</td>";
                        echo "<td>" . $s['beasiswa'] . "</td>";
                        echo "<td>" . $s['berkas'] . "</td>";
                        echo "<td>" . $s['status_ajuan'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
            </tbody>
        </table>    
    </div>
    <script src="./src/vendor/datatables/colResize/jquery.dataTables.colResize.js"></script>
    <script>
        let table = new DataTable('#myTable');
       table.DataTable({
        colResize: {
            isEnabled: true,
        }
        });
    </script>