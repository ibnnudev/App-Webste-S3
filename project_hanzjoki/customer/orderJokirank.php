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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyD8dJQ2W4G1xlCyD4pD9e2n4P7i8PRDj" crossorigin="anonymous">

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
    <div class="card-header">Lengkapi Data</div>
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

// Query untuk mengambil data promo
$sql_promo = "SELECT paket_joki_rank.*, discount.potongan, (paket_joki_rank.harga - discount.potongan) AS hasil
              FROM paket_joki_rank
              LEFT JOIN discount ON paket_joki_rank.nama_discount = discount.nama_discount
              WHERE paket_joki_rank.judul_paket = 'promo';";
$result_promo = $koneksi->query($sql_promo);
if ($result_promo === false) {
    die("Error saat mengeksekusi query promo: " . $koneksi->error);
}

// Query untuk mengambil data joki star
$sql_joki_star = "SELECT * FROM paket_joki_rank WHERE judul_paket = 'JOKI/Star'";
$result_joki_star = $koneksi->query($sql_joki_star);
if ($result_joki_star === false) {
    die("Error saat mengeksekusi query joki star: " . $koneksi->error);
}

// Query untuk mengambil data paket murah joki
$sql_murah_joki = "SELECT * FROM paket_joki_rank WHERE judul_paket = 'Paket murah joki'";
$result_murah_joki = $koneksi->query($sql_murah_joki);
if ($result_murah_joki === false) {
    die("Error saat mengeksekusi query paket murah joki: " . $koneksi->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/your/bootstrap/css/file.css"> <!-- Sesuaikan path dengan lokasi file CSS Bootstrap -->
    <title>Contoh Joki Rank</title>
</head>
<body>

<div class="container-promo">
    <!-- Promo Joki Rank -->
    <div class="card-header" id="judulPromoRank" style="display: none;">JOKI RANK</div>

    <!-- Promo Joki Rank -->
    <div class="card-header">Pilih Paket Joki</div>
    <div class="promo-classic">Promo Joki Rank</div>
    <div class="container-1">
        <?php
        // Menampilkan data promo
        $counter = 0;
        $data_promo = $result_promo->fetch_all(MYSQLI_ASSOC);
        foreach ($data_promo as $row) {
            $background_class = ($counter % 2 == 0) ? 'even-background' : 'odd-background';
            ?>
            <div class="col-md-4 <?= $background_class; ?>" onclick="selectRadio('option<?= $row['id_paket']; ?>')">
                <input type="radio" class="btn-check" name="nominal" id="option<?= $row['id_paket']; ?>" autocomplete="off">
                <label class="btn btn-outline-light col-12">
                    <div class="row">
                        <div class="col-7 column-font"><?= $row['nama_paket']; ?></div>
                        <div class="col-12">
    <span id="hargabro" name="hargabro" class="text-warning" style="text-decoration: line-through; text-decoration-thickness: 2px; text-decoration-color: RED;">
        <?= number_format($row['hasil'], 0, ',', '.'); ?>
    </span>
</div>
<div class="col-12">
    <span class="text-warning">
        <?= number_format($row['hasil'], 0, ',', '.'); ?>
    </span>
</div>



                        <div class="col-12">
                            
                        </div>
                    </div>
                </label>
            </div>
            <?php
            $counter++;
        }
        ?>
    </div>

    <!-- Joki Rank / Star -->
    <div class="promo-classic">Joki Rank / Star</div>
    <div class="container-1">
        <?php
        // Menampilkan data joki star
        $counter = 0;
        $data_joki_star = $result_joki_star->fetch_all(MYSQLI_ASSOC);
        foreach ($data_joki_star as $row) {
            $background_class = ($counter % 2 == 0) ? 'even-background' : 'odd-background';
            ?>
            <div class="col-md-4 <?= $background_class; ?>" onclick="selectRadio('option<?= $row['id_paket']; ?>')">
                <input type="radio" class="btn-check" name="nominal" id="option<?= $row['id_paket']; ?>" autocomplete="off">
                <label class="btn btn-outline-light col-12">
                    <div class="row">
                        <div class="col-7 column-font"><?= $row['nama_paket']; ?></div>
                        <div class="col-12">
    <span id="hargabro" name="hargabro" class="text-warning">
        <?= number_format($row['harga'], 0, ',', '.'); ?>
    </span>
</div>

                        <div class="col-12">
                            <!-- Isi sesuai kebutuhan -->
                        </div>
                    </div>
                </label>
            </div>
            <?php
            $counter++;
        }
        ?>
    </div>

    <!-- Paket Joki Murah -->
    <div class="promo-classic">Paket Joki Murah</div>
    <div class="container-1">
        <?php
        // Menampilkan data paket murah joki
        $counter = 0;
        $data_murah_joki = $result_murah_joki->fetch_all(MYSQLI_ASSOC);
        foreach ($data_murah_joki as $row) {
            $background_class = ($counter % 2 == 0) ? 'even-background' : 'odd-background';
            ?>
            <div class="col-md-4 <?= $background_class; ?>" onclick="selectRadio('option<?= $row['id_paket']; ?>')">
                <input type="radio" class="btn-check" name="nominal" id="option<?= $row['id_paket']; ?>" autocomplete="on">
                <label class="btn btn-outline-light col-12">
                    <div class="row">
                        <div class="col-7 column-font"><?= $row['nama_paket']; ?></div>
                        <div class="col-12">
    <span id="hargabro" name="hargabro" class="text-warning">
        <?= number_format($row['harga'], 0, ',', '.'); ?>
    </span>
</div>


                        <div class="col-12">
                            <!-- Isi sesuai kebutuhan -->
                        </div>
                    </div>
                </label>
            </div>
            <?php
            $counter++;
        }
        ?>
    
    </div>
    <form id="orderForm">
        <label for="qtyid" class="ppq"> Jumlah: </label>
        <input type="number" name= "jumlahid" id="qtyid" required>
        <button type="button" class="btn btn-warning mt-3" onclick="order()"><i class="bi bi-cart"></i> Masukan Keranjang</button> 
        
        <div class="text_keranjang">
            Keranjang
            
        </div>
    </form>

    <!-- Tabel Keranjang -->
    <div class="tabelok">
        <!-- <div class="card-header">
            Tabel Keranjang
        </div> -->
        <table class="table-keranjang" id="keranjangsementara">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nama Paket</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Aksi</th> 
                </tr>
            </thead>
            <tbody>
                <!-- Data tabel keranjang akan ditampilkan di sini -->
            </tbody>
        </table>
</div>
    <form id="totalForm">
    <!-- Tambahkan elemen input untuk menampilkan jumlah isi keranjang -->
    
    <!-- Di dalam formulir -->
    

    
    <!-- Menghitung Total Harga Yang Ada Di Keranjang -->
    <label for="total" class="ppqmu"> Total: </label>
    <input type="text" class="bro" name= "totaltrans" id="total" readonly>
    
    <input type="text" class="menghilan" name="jumlahIsiKeranjang" id="hiddenQty" value="">
    <input type="text" class="menghilan" name= "DataAkun" id="DataAkun" readonly>
    <input type="text" class="menghilan" name= "tanggalnow" id="setdatetime" readonly>
    <input type="text" class="menghilan" name= "pembayaran" id="pembayaranText" readonly>
    
</form>
    </div>
    <!-- ... Your HTML code ... -->
                                            <script>
                                            function setDateTime() {
                                                            // Ambil elemen dengan id "setdatetime"
                                                            var setDatetimeElement = document.getElementById('setdatetime');

                                                            // Dapatkan tanggal dan waktu saat ini
                                                            var currentDateTime = new Date();
                                                            
                                                            // Format tanggal dan waktu menjadi string (YYYY-MM-DD HH:mm:ss)
                                                            var formattedDateTime = currentDateTime.toISOString().slice(0, 19).replace("T", " ");

                                                            // Set nilai elemen input dengan tanggal dan waktu saat ini
                                                            setDatetimeElement.value = formattedDateTime;
                                                            }

                                                            // Panggil fungsi setDateTime saat halaman dimuat
                                                            document.addEventListener("DOMContentLoaded", function() {
                                                                setDateTime();
                                                            });
                                            function getCombinedInputs() {
                                                        var input1Value = document.getElementById('input1').value;
                                                        var input2Value = document.getElementById('input2').value;
                                                        var input3Value = document.getElementById('input3').value;
                                                        var input4Value = document.getElementById('input4').value;
                                                        var input5Value = document.getElementById('input5').value;
                                                        var input6Value = document.getElementById('input6').value;

                                                        var dataAkun = input6Value + ' , ' + input1Value + ' ( ' + input4Value + ' ) ' + input2Value + ' , ' + input3Value + ' ' + input5Value;
                                                        document.getElementById('DataAkun').value = dataAkun;
                                                        // document.querySelector('.ppq').innerText = 'Data Akun: ' + dataAkun;
                                                        
                                                        }
                                            function getDataFromTable() {
                                                        var table = document.getElementById('keranjangsementara');
                                                        var data = [];

                                                        // Loop melalui setiap baris kecuali baris header
                                                        for (var i = 1; i < table.rows.length; i++) {
                                                        var row = table.rows[i];
                                                        var rowData = {
                                                        id: row.cells[0].innerText,
                                                        namaPaket: row.cells[1].innerText,
                                                        harga: row.cells[2].innerText,
                                                        qty: row.cells[3].innerText,
                                                        subtotal: row.cells[4].innerText,
                                                        // Jika Anda membutuhkan data lain, tambahkan di sini
                                                        };

                                                        data.push(rowData);
                                                        }

                                                        return data;
                                                        }
                                            function getTotalValue() {
                                                        // Ambil elemen input dengan ID 'total'
                                                        var totalInput = document.getElementById('totaltrans');
                                                        
                                                        // Ambil nilai dari elemen input
                                                        var totalValue = totalInput.value;
                                                        
                                                        return totalValue;
                                                        }

                                                        // Contoh penggunaan
                                                        var totalOrder = getTotalValue();
                                                        console.log('Total Order:', totalOrder);
                                            function getQtyFromKeranjang() {
                                                        // Sama seperti sebelumnya

                                                        // ...

                                                            return totalQty;
                                                        }

                                                        function updateHiddenQtyInput() {
                                                            var qtyOrder = getQtyFromKeranjang();
                                                            document.getElementById('hiddenQty').value = qtyOrder;
                                                        }

                                                        // Panggil fungsi ini sebelum mengirimkan formulir
                                                        updateHiddenQtyInput();
                                    
                                                        // Fungsi untuk menghitung total baris yang diisi dalam tabel dan memperbarui input jumlahIsiKeranjang
                                                        function updateTotalKeranjang() {
                                                            var table = document.getElementById('keranjangsementara');
                                                            var totalRows = table.rows.length - 1; // Kurangi 1 untuk mengabaikan baris header
                                                            document.getElementById('hiddenQty').value = totalRows;
                                                        }

                                                        // Panggil fungsi saat halaman dimuat atau ketika ada perubahan dalam tabel keranjang
                                                        document.addEventListener('DOMContentLoaded', updateTotalRows);
                                                        document.getElementById('keranjangsementara').addEventListener('input', updateTotalRows);
                                            function hitungTotal() {
                                                        var tabelKeranjang = document.getElementById('keranjangsementara');
                                                        var baris = tabelKeranjang.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                                                        var total = 0;

                                                        for (var i = 0; i < baris.length; i++) {
                                                            var hasilakhir = baris[i].getElementsByTagName('td')[4];
                                                            if (hasilakhir) {
                                                                total += parseInt(hasilakhir.innerText);
                                                            }
                                                        }

                                                        // Memasukkan total ke dalam input total
                                                        document.getElementById('total').value = total;
                                                        }
                                                        function selectRadio(optionId) {
                                                        // Unselect all radio buttons
                                                        var radioButtons = document.getElementsByName('nominal');
                                                        radioButtons.forEach(function (radioButton) {
                                                            radioButton.closest('.col-md-4').classList.remove('selected-background');
                                                            radioButton.checked = false;
                                                        });

                                                        // Remove the "option" prefix from the ID
                                                        var idWithoutOption = optionId.replace('option', '');

                                                        // Select the clicked radio button
                                                        var selectedRadio = document.getElementById(optionId);
                                                        selectedRadio.checked = true;
                                                        selectedRadio.closest('.col-md-4').classList.toggle('selected-background');
                                                        }
                                            function order() {
                                                
                                                        // Get the selected radio button
                                                        var selectedRadio = document.querySelector('input[name="nominal"]:checked');

                                                        // Check if a radio button is selected
                                                        if (selectedRadio) {
                                                        // Get the quantity value
                                                        var quantity = document.getElementById('qtyid').value;

                                                        // Check if the quantity is valid
                                                        if (quantity > 0) {
                                                        // Get the data from the selected radio button
                                                        var packageName = selectedRadio.parentNode.querySelector('.column-font').innerText;
                                                        var price = selectedRadio.parentNode.querySelector('.text-warning').innerText;

                                                        // Remove the "option" prefix from the ID
                                                        var idWithoutOption = selectedRadio.id.replace('option', '');

                                                        // Add the order to the cart table
                                                        addToCart(idWithoutOption, packageName, price, quantity);

                                                        // Clear the selected radio button
                                                        selectedRadio.checked = false;

                                                        // Clear the quantity input
                                                        document.getElementById('qtyid').value = '';

                                                        // Menghitung total setelah menambah item
                                                        hitungTotal();
                                                        updateTotalKeranjang();
                                                        getCombinedInputs();
                                                        
                                                        
                                                        
                                                        } else {
                                                        alert('Please enter a valid quantity.');
                                                        }
                                                        } else {
                                                            alert('Please select a package.');
                                                        }
                                                        
                                                        }
                                            function addToCart(id, packageName, price, quantity, subtotal, deleteButton) {
                                                        var cartTable = document.getElementById('keranjangsementara').getElementsByTagName('tbody')[0];
                                                        var newRow = cartTable.insertRow();
                                                        var cell1 = newRow.insertCell(0);
                                                        var cell2 = newRow.insertCell(1);
                                                        var cell3 = newRow.insertCell(2);
                                                        var cell4 = newRow.insertCell(3);
                                                        var cell5 = newRow.insertCell(4);
                                                        var cell6 = newRow.insertCell(5);

                                                        cell1.innerHTML = id;
                                                        cell2.innerHTML = packageName;
                                                        cell3.innerHTML = price; // Format price as currency
                                                        cell4.innerHTML = quantity;

                                                        // Calculate subtotal as an integer
                                                        var calculatedSubtotal = price * quantity;
                                                        cell5.innerHTML = calculatedSubtotal + '000';


                                                        var deleteButton = document.createElement('button');
                                                        deleteButton.innerHTML = 'Hapus';
                                                        deleteButton.className = 'btn btn-danger btn-sm';
                                                        deleteButton.onclick = function () {
                                                            deleteRow(this);
                                                            hitungTotal(); // Panggil fungsi hitungTotal() setelah menghapus baris
                                                            updateTotalKeranjang();
                                                        };

                                                        // Append the delete button to the cell
                                                        cell6.appendChild(deleteButton);
                                                        }

                                                        function deleteRow(button) {
                                                            var row = button.parentNode.parentNode;
                                                            row.parentNode.removeChild(row);
                                                        }
                                            function tampilkanTulisan() {
                                                        var pembayaranText = document.getElementById("pembayaranText");
                                                        var danaRadioButton = document.getElementById("dana");
                                                        var ovoRadioButton = document.getElementById("ovo");

                                                        if (danaRadioButton.checked) {
                                                            pembayaranText.value = "DANA";
                                                        } else if (ovoRadioButton.checked) {
                                                            pembayaranText.value = "OVO";
                                                        } else {
                                                            pembayaranText.value = tampilkanTulisan();
                                                        }
                                                        }
                                                        

                                            </script>
</form>

<!-- ============================================================================================================================================================================== -->
<div class="pembayan-metode">
                <div class="card-header">
                          Pilih Metode Pembayaran
                          </div>
                          <div class="card-body text-white">
                            <div class="row g-3">
                              <h6 class="ppw">E- Wallet</h6>

                              <div class="col-md-3" width = "100px">
                              <input type="radio" id="dana" name="metode_pembayaran" onclick="tampilkanTulisan()">
                                <label class="col-12 btn btn-outline-light" for="dana">
                                  <div class="row">
                                    <div class="col"><img src="../image/dana.png" width="100px" height="100px" alt=""></div>
                                  </div>
                                </label>
                              </div>

                              <div class="col-md-3">
                              <input type="radio" id="ovo" name="metode_pembayaran" onclick="tampilkanTulisan()">
    <label class="col-12 btn btn-outline-light" for="ovo">
        <div class="row">
            <div class="col"><img src="../image/ovo.png" width="100px" height="70px" alt=""></div>
        </div>
    </label>
</div>

                            </div>
                            <label for="qtyid" class="ppq"> Masukan No WhatsApp: </label>
                                <input type="number" name= "whatsappBro" id="noWhatsApp" required>
                          </div>

                          

<div class="buy-or">
    <button class="payment-button" id="orderButton">
        <img src="../image/cart.png" alt="Payment Image" class="payment-image" id="orderImage">
        <div class="payment-content">
            <h3 class="payment-title">Order Now</h3>
            
        </div>
    </button>
</div>

<script>
document.getElementById("orderButton").addEventListener("click", function() {
    // Lakukan pengambilan data dari formulir atau elemen lainnya yang diperlukan
    


    // Buat objek XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Atur metode dan endpoint URL untuk permintaan
    xhr.open("POST", "orderjokirank.php", true);
    
    // Atur header Content-Type
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Atur callback untuk menangani respons dari server
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Tindakan yang diambil setelah mendapatkan respons
            console.log(xhr.responseText);
        }
    };

    // Kirim permintaan dengan formData
    xhr.send(formData);
});

</script>


<?php




// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Periksa koneksi ke database
//     $koneksi = new mysqli("localhost", "root", "", "hanzjoki");
//     if ($koneksi->connect_error) {
//         die("Koneksi ke database gagal: " . $koneksi->connect_error);
//     }

//     $data_akun = $_POST['DataAkun'];
//     $qty_order = $_POST['jumlahIsiKeranjang'];
//     $tgl_order = $_POST['tanggalnow'];
//     $total_transaksi = $_POST['totaltrans'];
//     $payment = $_POST['pembayaran'];
//     $no_wa = $_POST['whatsappBro'];

//     // Gunakan prepared statements untuk menghindari SQL injection
//     $sql = $koneksi->prepare("INSERT INTO transaksi (id_transaksi, id_customer, data_akun, qty_order, tgl_order, total_transaksi, payment, no_wa, stats, butki_tf)
//      VALUES ('', '', ?, ?, ?, ?, ?, ?, 'Belum Lunas', '')");
//     $sql->bind_param("ssssss", $data_akun, $qty_order, $tgl_order, $total_transaksi, $payment, $no_wa);

//     if ($sql->execute()) {
//         echo "Data transaksi berhasil disimpan ke database.";
    
//         // Dapatkan ID transaksi yang baru saja dimasukkan
//         $id_transaksi = $koneksi->insert_id;
    
//         // Loop untuk memasukkan data ke dalam tabel detail_transaksi
//         foreach ($tableData as $rowData) {
//             $id_paket = $rowData['id'];
//             $harga = $rowData['harga'];
//             $subtotal = $rowData['subtotal'];
            
    
//             // Gunakan prepared statements untuk menghindari SQL injection
//             $sqlDetail = $koneksi->prepare("INSERT INTO detail_transaksi (id_transaksi, id_paket, qty, subtotal) VALUES (?, ?, ?, ?)");
//             $sqlDetail->bind_param("ssss", $id_transaksi, $id_paket, $qty, $subtotal);
    
//             // Eksekusi query untuk memasukkan data ke dalam tabel detail_transaksi
//             $sqlDetail->execute();
//             $sqlDetail->close(); // Tutup prepared statement
//         }
//     } else {
//         echo "Terjadi kesalahan saat menyimpan data transaksi: " . $koneksi->error;
//     }
    
//     $sql->close(); // Tutup prepared statement
//     $koneksi->close(); // Tutup koneksi database
// }
?>




















</div>
























<style>
        /* Menghilangkan tanda bulatan pada radio button */
        input[type="radio"] {
            display: none;
        }

        /* Menampilkan gambar sebagai pengganti tanda bulatan (opsional) */
        input[type="radio"] + label::before {
            content: url('unchecked.png'); /* Ganti dengan path ke gambar yang diinginkan untuk status unchecked */
            margin-right: 5px;
            display: inline-block;
        }

        input[type="radio"]:checked + label::before {
            content: url('checked.png'); /* Ganti dengan path ke gambar yang diinginkan untuk status checked */
        }

        /* Menampilkan teks pada input yang di-read-only */
        input[type="text"].menghilang {
            border: none;
            background-color: transparent;
            outline: none;
            width: auto;
        }
    </style>
</body>
</html>