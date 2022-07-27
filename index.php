<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key: 0a0294524bcb1fad37833fc8b55616d2"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    // echo $response;
    $list = json_decode($response);
    // echo "<pre>";
    // print_r($list);
    // echo "</pre>";
    // echo $list;
    // document.getElementById("demo").innerHTML = "I have changed!"; 
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src=”https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js” type="text/javascript"></script> -->
    <title>Cek Ongkir</title>
    <link rel="stylesheet" href="bootstrap-5.2.0-dist/css/bootstrap.min.css">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"> 
    <!-- End font -->

    <!-- dataTables -->
    <link rel="stylesheet" href="datatables.min.css">
    <!-- End dataTables -->

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- End AOS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
        }
    </style>
</head>
<body id="body">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-light sticky-top">
      <div class="container">
        <a href="index.php">
            <img class="me-2" src="https://img.icons8.com/external-filled-outline-chattapat-/64/000000/external-delivery-insurance-filled-outline-chattapat-.png"/>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#body">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#table_id">Ongkir</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <!-- Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center mt-4 mb-5" data-aos="fade-up" data-aos-duration="1000">Cek Ongkir</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <div class="mb-2">Kota pengirim barang :</div>
                <select class="form-select mb-4 shadow rounded" id="id_provinsi" name="id_pengirim" onchange="Cari_kota_pengirim(this.value)" aria-label="Default select example" name="provinsi_pengirim" data-aos="flip-left" data-aos-duration="1000">
                    <option selected disabled>-- Pilih provinsi pengirim --</option>
                    <?php
                        foreach($list->rajaongkir->results as $provinsi) {
                            echo '<option value="'.$provinsi->province_id.'">'.$provinsi->province.'</option>';
                        }
                    ?>
                </select>
                <select class="form-select mb-4 shadow rounded" id="kota_pengirim" aria-label="Default select example" name="provinsi_pengirim" data-aos="flip-left" data-aos-duration="1000">
                    <option>-- Pilih kota pengirim --</option>
                </select>
                <p id="error_pengirim"></p>
                
                <div class="mb-2">Kota penerima barang :</div>
                <select class="form-select mb-4 shadow rounded" onchange="kota_penerima(this.value)" aria-label="Default select example" name="provinsi_penerima" data-aos="flip-left" data-aos-duration="1000">
                    <option selected disabled>-- Pilih provinsi penerima --</option>
                    <?php
                        foreach($list->rajaongkir->results as $provinsi) {
                            echo '<option value='.$provinsi->province_id.'>'.$provinsi->province.'</option>';
                        }
                    ?>
                </select>
                <select class="form-select mb-4 shadow rounded" aria-label="Default select example" name="kota_tujuan" id="kota_penerima" data-aos="flip-left" data-aos-duration="1000">
                    <option>-- Pilih kota penerima --</option>
                </select>
                <p id="error_penerima"></p>

                <div class="mb-2">Berat Paket :</div>
                <div class="input-group mb-4 shadow rounded" data-aos="flip-left" data-aos-duration="1000">
                    <input class="form-control form-control" id="berat_paket" type="text" placeholder="berat barang" aria-label=".form-control-lg example">
                    <span class="input-group-text">gram</span>
                </div>
                <p id="error_berat_paket"></p>

            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="mb-2">Kurir :</div>
                <select class="form-select mb-4 shadow rounded" aria-label="Default select example" name="kurir" id="kurir" data-aos="flip-left" data-aos-duration="1000">
                    <option selected disabled>-- Pilih kurir --</option>
                    <option value="jne"> jne </option>
                    <option value="pos"> pos indonesia </option>
                    <option value="tiki"> tiki </option>
                </select>
                <p id="error_kurir"></p>
                <button class="btn btn-outline-primary shadow rounded" onclick="cost_kirim()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square me-1">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    Cek Ongkir
                </button>
            </div>
        </div>
        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>Paket</th>
                    <th>Deskripsi</th>
                    <th>Ongkir</th>
                    <th>Estimasi (hari)</th>
                </tr>
            </thead>
            <tbody id="biaya_ongkir">
                
            </tbody>
        </table>
    </div>
    <!-- End Content -->

    <!-- Footer -->
    <div class="d-flex align-items-end mt-4">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12" style="min-height: 12em;">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Footer -->

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="bootstrap-5.2.0-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#table_id').DataTable();
        });
    </script>
    <!-- <script type="text/javascript">
        fetch('https://api.rajaongkir.com/starter/province?id=12', {
            headers : { key : '0a0294524bcb1fad37833fc8b55616d2' }
        })
        // .then(response => response.json())
        .then(response => console.log(response))
        .catch(error => console.log('Error', error));
    </script> -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        AOS.init();

        // You can also pass an optional settings object
        // below listed default settings
        AOS.init({
        // Global settings:
        disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
        startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
        initClassName: 'aos-init', // class applied after initialization
        animatedClassName: 'aos-animate', // class applied on animation
        useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
        disableMutationObserver: false, // disables automatic mutations' detections (advanced)
        debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
        throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)
        

        // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
        offset: 120, // offset (in px) from the original trigger point
        delay: 0, // values from 0 to 3000, with step 50ms
        duration: 400, // values from 0 to 3000, with step 50ms
        easing: 'ease', // default easing for AOS animations
        once: false, // whether animation should happen only once - while scrolling down
        mirror: false, // whether elements should animate out while scrolling past them
        anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

        });
    </script>
    <script>
        function Cari_kota_pengirim(id_kota_pengirim){
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("kota_pengirim").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "pilih_kota.php?id_provinsi="+id_kota_pengirim, true);
            xmlhttp.send();
        }
    </script>
    <script>
        function kota_penerima(id_penerima) {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("kota_penerima").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "pilih_kota.php?id_provinsi="+id_penerima, true);
            xmlhttp.send();
        }
    </script>
    <script>
        function cost_kirim() {
            let kota_pengirim = document.getElementById("kota_pengirim").value;
            let kota_penerima = document.getElementById("kota_penerima").value;
            let berat_paket = document.getElementById("berat_paket").value;
            let kurir = document.getElementById("kurir").value;
            let error_pengirim = document.getElementById("error_pengirim");
            let error_penerima = document.getElementById("error_penerima");
            let error_berat_paket = document.getElementById("error_berat_paket");
            let error_kurir = document.getElementById("error_kurir");

            // Validasi data input
            if (kota_pengirim == "-- Pilih kota pengirim --") {
                document.getElementById("error_pengirim").innerHTML = "<div class='text-danger'>Kota Pengirim Belum Di Masukkan !</div>";
            }else{
                error_pengirim.style.display = "none";
            }
            if (kota_penerima == "-- Pilih kota penerima --") {
                document.getElementById("error_penerima").innerHTML = "<div class='text-danger'>Kota Penerima Belum Di Masukkan !</div>";
            }else{
                error_penerima.style.display = "none";
            }
            if (berat_paket == "") {
                document.getElementById("error_berat_paket").innerHTML = "<div class='text-danger'>Berat Paket Belum Di Masukkan !</div>";
            }else{
                error_berat_paket.style.display = "none";
            }
            if (kurir == "-- Pilih kurir --") {
                document.getElementById("error_kurir").innerHTML = "<div class='text-danger'>Kurir Belum Di Masukkan !</div>";
            }else{
                error_kurir.style.display = "none";
            }
            
            // Request data ongkir
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("biaya_ongkir").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "ongkos_kirim.php?id_kota_pengirim="+kota_pengirim+"&id_kota_penerima="+kota_penerima+"&berat_paket="+berat_paket+"&kurir="+kurir, true);
            xmlhttp.send();
        }
    </script>
</body>
</html>