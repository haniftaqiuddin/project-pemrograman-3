<html>
   <head>
      <title>Tugas Besar Web Service </title>
   </head>
   <body>
      <h2>Search hp</h2>
      <form method="post" action="client.php?op=search">
          Pencarian <input type="text" name="key"> <input type="submit" name="submit" value="Search">
      </form>
      

	
	
      <?php
        // proses pencarian data
        if (isset($_GET['op']))
        {
            if ($_GET['op'] == 'search')
            {
                require_once('nusoap/lib/nusoap.php');
                // baca keyword pencarian dari form
                $key = $_POST['key'];

                // instansiasi obyek untuk class nusoap client, arahkan URL ke script server.php di server A
                $client = new nusoap_client('http://localhost/hp/server.php');

                // proses call method 'search' dengan parameter key di script server.php yang ada di server A
                $result = $client->call('search', array('key' => $key));

                // jika data hasil pencarian ($result) ada, maka tampilkan
                if (is_array($result))
                {
                    echo "<table border='1'>";
                    echo "<tr><th>kode</th><th>MERK</th><th>TIPE</th></tr>";
                    foreach($result as $data)
                    {
                        echo "<tr><td>".$data['kode']."</td><td>".$data['merk']."</td><td>".$data['tipe']."</td></tr>";
                    }
                    echo "</table>";
                    // menampilkan jumlah data hasil pencarian
                    echo "<p>Ditemukan ".count($result)." data terkait kata kunci '".$key."'</p>";
                }
                else echo "<p>Data tidak ditemukan</p>";
            }
        }
        ?>

    </body>
</html>