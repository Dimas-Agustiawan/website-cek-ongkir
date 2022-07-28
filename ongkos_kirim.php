<?php

$id_kota_pengirim = $_GET['id_kota_pengirim'];
$id_kota_penerima = $_GET['id_kota_penerima'];
$berat_paket = $_GET['berat_paket'];
$kurir = $_GET['kurir'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "origin=".$id_kota_pengirim."&destination=".$id_kota_penerima."&weight=".$berat_paket."&courier=".$kurir,
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded",
    "key: 0a0294524bcb1fad37833fc8b55616d2"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
    $list = json_decode($response);
    // $target->murni="asli";
    // $target->age=20;
    // $trg = json_encode($target);
    // echo $trg;
    // echo "<pre>";
    // print_r($list->rajaongkir->results[0]->costs);
    // echo "</pre>";
    
    if ($_GET['id_kota_pengirim'] != "-- Pilih kota pengirim --" && $_GET['id_kota_penerima'] != "-- Pilih kota penerima --" && $_GET['berat_paket'] != "" && $_GET['kurir'] != "-- Pilih kurir --") {
      foreach ($list->rajaongkir->results[0]->costs as $ongkir) {
          echo '<tr>';
          echo '<td>'.$ongkir->service.'</td>';
          echo '<td>'.$ongkir->description.'</td>';
          echo '<td>'.$ongkir->cost[0]->value.'</td>';
          echo '<td>'.$ongkir->cost[0]->etd.'</td>';
          echo '</tr>';
      }
    }
}

?>