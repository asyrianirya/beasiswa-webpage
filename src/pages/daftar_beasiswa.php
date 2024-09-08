<body>
<header>
      <?php include('./src/components/navigator.php'); ?>
</header>

<div class="title">
        <h2>Daftar Beasiswa</h2>
    </div>
    <div class="table-container">
        <table border="1" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Beasiswa</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    include('./src/kernel/get_beasiswa.php');
                    $no = 1; 
                    foreach ($beasiswa as $b) { 
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $b['nama_beasiswa'] . "</td>";
                        echo "<td>" . $b['deskripsi_beasiswa'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
            </tbody>
        </table>    
    </div>
    <script>
        let table = new DataTable('#myTable');
       table.DataTable({
            "columns": [
                { "data": "No" },
                { "data": "Jenis Beasiswa" },
                { "data": "Deskripsi" }
            ]
        });
    </script>
</body>