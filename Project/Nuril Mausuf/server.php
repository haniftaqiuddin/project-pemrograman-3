<?php

require_once('nusoap/lib/nusoap.php');
$server = new soap_server;


// registrasi method 'search'
$server->register('search');


// detail method 'search' dengan parameter $key
function search($key)
{
     // koneksi ke database
     mysql_connect('localhost', 'root', '');
     mysql_select_db('motor');

     // query pencarian data mahasiswa
     $query = "SELECT * FROM motor WHERE noMotor = '$key' OR  merkMotor LIKE '%$key%' OR tipeMotor  LIKE '%$key%'";
     $hasil = mysql_query($query);
     while ($data = mysql_fetch_array($hasil))
     {
          // menyimpan data hasil pencarian dalam array
          $result[] = array('noMotor' => $data['noMotor'], 'merkMotor' => $data['merkMotor'], 'tipeMotor' => $data['tipeMotor']);
     }
     // mereturn array hasil pencarian
     return $result;
}



$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>