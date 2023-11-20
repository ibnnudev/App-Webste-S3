
<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hanzjoki";

$koneksi = new mysqli($servername, $username, $password, $dbname);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query untuk mengambil data dari database
$sql = "SELECT paket_joki_rank.*, discount.potongan, (paket_joki_rank.harga - discount.potongan) AS hasil
FROM paket_joki_rank
LEFT JOIN discount ON paket_joki_rank.nama_discount = discount.nama_discount
WHERE paket_joki_rank.judul_paket = 'promo';";

// Eksekusi query
$result = $koneksi->query($sql);

// Periksa apakah query berhasil dieksekusi
if ($result === false) {
    die("Error saat mengeksekusi query: " . $koneksi->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One?query=mochiy+ ">
</head>
<body>
    <header>
        <div class="container"> 
            <h2 class="logo">
                <img src="../image/LOGO HANZJOKI.png" alt="LOGO" style="width:150px; height:auto; ">
            </h2>
              
             <nav class="navigation3">
        
                <a href="dashboardcust.php"  style="text-decoration: none; color: #06D85F;">
                    <span class="link-text">Beranda</span>
                </a>

                <a href="lacakorderan.php">
                    <span class="link-text">Lacak Orderan</span>
                </a>
                <a href="hubungikami.php">
                    <span class="link-text">Hubungi Kami</span>
                </a>
                <a href="calculator.php">
                    <span class="link-text">Calculator Ml</span>
                </a>
            </nav>
        </div>
        <!-- <nav class="navigation2">
            <a href="../register.php">Daftar Sekarang</a>
            <a href="../login.php">Masuk</a>
        </nav> -->
    </header> 

    <div class="content-jokirank">
        <h1 class="nama-joki">Joki Rank</h1>
        <img src="../image/rankpler.png" >
        <h1 class="time">orderan joki di chek<br>pukul 09:00-21:00</h1>
        <h1 class="ket-1">Jika Orderan melewati<br>batas pengecekan <br>orderan, maka orderan<br>dicek di hari berikutnya</h1>

            <div class="ket-2" >
                <h1 class="caraorder">Cara Order :</h1>
                <p class="isi-ket-2">
                    1.Lengkapi data joki dengan teliti <br>
                    2.Pilih jenis Joki yang diinginkan <br>
                    3.masukan jumlah order <br>
                    4.Pilih metode pembayaran <br>
                    5.Masukan No WhatsApp yang benar <br>
                    6.Klik beli & lakukan pembayaran <br>
                    7.order joki akan segera diproses <br> setelah orderan berhasil
                </p>
                <h2 class="ket-3">Estimasi Proses jasa Joki <br> kita usahakan secepatnya</h2>
                <h2 class="ket-4">Minimal 12 jam <br> Maxsimal 2x24 jam </h2>
            </div>
    </div>


    <div class="content-listjoki">
        <h1 class="list-jokian" >Paket Joki Lainnya</h1>
        <section id="joki" class="list-jokian-order">
               
                <div class="img-jokian">
                    <a href="orderjokimcl.html">
                            <img src="../image/MCL.png" alt="">
                            <div class="pil-jokirank">Joki MCL <br>(Jasa joki MCL)</div>
                    </a>
                </div>
                <div class="img-jokian">
                    <a href="orderjokimcl.html">
                            <img src="../image/MONTAGE.png" alt="">
                            <div class="pil-jokirank">Joki Vidio Montage <br>(Jasa joki Vidio)</div>
                    </a>
                </div>
                <div class="img-jokian">
                    <a href="orderjokimcl.html">
                            <img src="../image/JASA MABAR.png" alt="">
                            <div class="pil-jokirank">Jasa Mabar <br>(Jasa Mabar Penjoki)</div>
                    </a>
                </div>
                <div class="img-jokian">
                    <a href="orderjokimcl.html">
                            <img src="../image/JOKICLASIK.png" alt="">
                            <div class="pil-jokirank">Joki clasic <br>(Jasa joki Up WinRate)</div>
                    </a>
                </div>
        </section>
    </div>

    <div class="box-id-input">
        <h1 class="id-id">Lengkapi Data</h1>
        <div class="left-input">
            <div class="input-container">
    
                <input type="text" id="input1" name="input1" placeholder="masukan Email/No Hp">
            </div>
            <div class="input-container">
                <input type="text" id="input2" name="input2" placeholder="Minimal Request 3 Hero">
            </div>
            <div class="input-container">
                <input type="text" id="input3" name="input3" placeholder="User ID & Nickname">
            </div>
        </div>

        
        <div class="right-input">
            <div class="input-container">
                <input type="text" id="input4" name="input4" placeholder="Masukan Password">
            </div>
            <div class="input-container">    
                <input type="text" id="input5" name="input5" placeholder="Catatan untuk Pejoki">
            </div>
            <div class="input-container">
                <select id="input6" name="input6" >
                    <option value="loginvia">Login Via</option>
                    <option value="montoon">Moonton (Rekomendasi)</option>
                    <option value="facebook">Facebook</option>
                    <option value="vk">Vk</option>
                    <option value="tt">Tiktok</option>
                </select>
            </div>
        </div>
    </div>
    <div class="container-promo">
    <div class="card-header">
                          Pilih PROMO
                          </div>
    <div class="container-1">
    
        <?php
        // Loop untuk menampilkan data dari database
        $counter = 0; // Menggunakan counter untuk melacak indeks data
        while ($row = $result->fetch_assoc()) {
            $background_class = ($counter % 2 == 0) ? 'even-background' : 'odd-background';
        ?>
            <div class="col-md-4 <?= $background_class; ?>" onclick="selectRadio('option<?= $row['id_paket']; ?>')">
                <input type="radio" class="btn-check" name="nominal" id="option<?= $row['id_paket']; ?>" autocomplete="off">
                <label class="btn btn-outline-light col-12">
                    <div class="row">
                        <div class="col-7 column-font"><?= $row['nama_paket']; ?></div>
                        <!-- Menampilkan harga_setelah_discount -->
                        <div class="col-12"><span class="text-warning">Rp. <?= number_format($row['hasil'], 0, ',', '.'); ?></span></div>
                        <div class="col-12">
                            <span class="text-warning" style="text-decoration: line-through; text-decoration-thickness: 4px;">
                                Rp. <s><?= number_format($row['harga'], 0, ',', '.'); ?></s>
                            </span>
                        </div>
                    </div>
                </label>
            </div>
        <?php
            $counter++;
        }

        // Tutup koneksi database
        $koneksi->close();
        ?>
    </div>
</div>

<script>
    function selectRadio(optionId) {
        var option = document.getElementById(optionId);
        option.checked = true;
    }
</script>

<script>
    function toggleCheckbox(optionId) {
        var option = document.getElementById(optionId);
        option.checked = !option.checked; // Toggle checkbox state
    }
</script>

<!-- =========================================================================================================================== -->
<!-- ----------------------promo---------------------- -->

<div class="pembayan-metode">
                <div class="card-header">
                          Pilih Metode Pembayaran
                          </div>
                          <div class="card-body text-white">
                            <div class="row g-3">
                              <h6 class="ppw">E- Wallet</h6>

                              <div class="col-md-3" width = "100px">
                                <input type="radio" class="btn-check" name="pembayaran" id="dana" autocomplete="off">
                                <label class="col-12 btn btn-outline-light" for="dana">
                                  <div class="row">
                                    <div class="col"><img src="../image/dana.png" width="100px" height="100px" alt=""></div>
                                  </div>
                                </label>
                              </div>

                              <div class="col-md-3">
                                <input type="radio" class="btn-check" name="pembayaran" id="ovo" autocomplete="off">
                                <label class="col-12 btn btn-outline-light" for="ovo">
                                  <div class="row">
                                    <div class="col"><img src="../image/ovo.png" width="100px" height="70px" alt=""></div>
                                  </div>
                                </label>
                              </div>
                            </div>
                          </div>

</div>













    
</body>
</html>