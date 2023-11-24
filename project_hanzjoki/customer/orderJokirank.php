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
    <span id="hargabro" name="hargabro" class="text-warning" style="text-decoration: line-through; text-decoration-thickness: 2px; text-decoration-color: #FFC436;">
        <?= number_format($row['hasil'], 0, ',', '.'); ?>
    </span>
</div>
<div class="col-12">
    <span class="text-warning">
        <?= number_format($row['harga'], 0, ',', '.'); ?>
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
        <input type="number" id="qtyid" required>
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
                    <th scope="col">Nama Barang</th>
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
        <script>
            function updateHiddenTableDataInput() {
    var tableData = getDataFromTable();
    document.getElementById('hiddenTableData').value = JSON.stringify(tableData);
}

// Panggil fungsi ini sebelum mengirimkan formulir
updateHiddenTableDataInput();


function getTotalValue() {
    // Ambil elemen input dengan ID 'total'
    var totalInput = document.getElementById('total');
    
    // Ambil nilai dari elemen input
    var totalValue = totalInput.value;
    
    return totalValue;
}

// Contoh penggunaan
var totalOrder = getTotalValue();
console.log('Total Order:', totalOrder);
</script>

        <script>
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
                            </script>

        
</div>
    <form id="totalForm">
    <!-- Tambahkan elemen input untuk menampilkan jumlah isi keranjang -->
    
    <!-- Di dalam formulir -->
    <input type="hidden" name="jumlahIsiKeranjang" id="hiddenQty" value="">

    
    <!-- Menghitung Total Harga Yang Ada Di Keranjang -->
    <label for="total" class="ppq"> Total: </label>
    <input type="text" class="bro" id="total" readonly>

    
</form>
    </div>
    <!-- ... Your HTML code ... -->
    <script>
    function hitungIsiKeranjang() {
        var tabel = document.getElementById('keranjangsementara');
        var tbody = tabel.getElementsByTagName('tbody')[0];
        var baris = tbody.getElementsByTagName('tr');
        var total = 0;

        for (var i = 0; i < baris.length; i++) {
            var subtotal = parseFloat(baris[i].getElementsByTagName('td')[4].innerText);
            total += subtotal;
        }

        // Mengisi nilai input pada formulir
        document.getElementById('total').value = total;
        document.getElementById('jumlahIsiKeranjang').value = baris.length;
    }

    // Jalankan fungsi saat halaman dimuat
    window.onload = function() {
        hitungIsiKeranjang();
    };
        
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
            hitungIsiKeranjang();
            
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
        };

        // Append the delete button to the cell
        cell6.appendChild(deleteButton);
    }

    function deleteRow(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>
</form>


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
                            <label for="qtyid" class="ppq"> Masukan No WhatsApp: </label>
                                <input type="number" id="noWhatsApp" required>
                          </div>

                          <script>
            // Mendapatkan label dan menampilkannya di konsol
            var labelNoWhatsApp = document.querySelector('label[for="noWhatsApp"]').innerText;
            console.log("Isi label: " + labelNoWhatsApp);
        </script>

                          <div class="buy-or">
    <button class="payment-button" onclick="processOrder()">
        <img src="../image/cart.png" alt="Payment Image" class="payment-image" id="orderImage">
        <div class="payment-content">
            <h3 class="payment-title">Order Now</h3>
        </div>
    </button>
</div>

<script>
    function orderNow() {
        // Logika untuk meng-handle klik tombol
        console.log('Tombol Order Now diklik!');
    }
</script>


<script>
// ...
function orderNow() {
    // ...

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'proses.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Tampilkan respons dari server jika sukses
                alert(xhr.responseText);
            } else if (xhr.status == 500) {
                // Tangkap dan tampilkan pesan kesalahan dari server
                alert("Terjadi kesalahan saat memesan: " + xhr.responseText);
            }
            // Atau lakukan tindakan lain setelah proses selesai
        }
    };

    // Kumpulkan data form dan kirim sebagai FormData
    var formData = new FormData(document.getElementById('yourFormId')); // Ganti 'yourFormId' dengan ID formulir Anda
    xhr.send(formData);
}
</script>



</div>

<!-- =============================================================================== -->
<script>
function concatenateInputs() {
    var input1Value = document.getElementById('input1').value;
    var input2Value = document.getElementById('input2').value;
    var input3Value = document.getElementById('input3').value;
    var input4Value = document.getElementById('input4').value;
    var input5Value = document.getElementById('input5').value;
    var input6Value = document.getElementById('input6').value;

    // Combine the values into one variable
    var data_akun = input1Value + ' ' + input2Value + ' ' + input3Value + ' ' + input4Value + ' ' + input5Value + ' ' + input6Value;

    // Set the concatenated value to a hidden input field
    document.getElementById('hidden_data_akun').value = data_akun;
}

</script>


<script>
// Fungsi untuk mendapatkan tanggal saat ini
function getFormattedDate() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
    var yyyy = today.getFullYear();

    return yyyy + '-' + mm + '-' + dd;
}

// Set nilai input tanggalnow dengan tanggal saat ini
document.getElementById('tanggalnow').value = getFormattedDate();
// Tampilkan label setelah mengisi nilai
document.getElementById('labelTanggal').style.display = 'inline-block';
</script>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa koneksi ke database
    $koneksi = new mysqli("localhost", "root", "", "hanzjoki");
    if ($koneksi->connect_error) {
        die("Koneksi ke database gagal: " . $koneksi->connect_error);
    }

    $tgl_order = $_POST['tanggalnow'];
    $data_akun = $_POST['hidden_data_akun'];
    $qty_order = $_POST['jumlahIsiKeranjang'];
    $total_transaksi = $_POST['total'];
    $payment = $_POST['payment'];

    // Gunakan prepared statements untuk menghindari SQL injection
    $sql = $koneksi->prepare("INSERT INTO transaksi (id_transaksi, id_customer, data_akun, qty_order, tgl_order, total_transaksi, payment, no_wa, stats)
     VALUES ('', '', ?, ?, ?, ?, ?, 'no_wa', 'Belum Lunas')");
    $sql->bind_param("ssssssss", $data_akun, $qty_order, $tgl_order, $total_transaksi, $payment);

    if ($sql->execute()) {
        echo "Data transaksi berhasil disimpan ke database.";

        // Memasukkan data ke dalam tabel detail_transaksi
        $tableDataJson = $_POST['hiddenTableData'];
        $tableData = json_decode($tableDataJson, true);

        foreach ($tableData as $rowData) {
            $id_barang = $rowData['id'];
            $nama_barang = $rowData['nama_barang'];
            $harga = $rowData['harga'];
            $subtotal = $rowData['subtotal'];
            $aksi = $rowData['aksi'];

            // Gunakan prepared statements untuk menghindari SQL injection
            $sqlDetail = $koneksi->prepare("INSERT INTO detail_transaksi (id_transaksi, id_paket, qty, subtotal) VALUES (?, ?, ?, ?)");
            $sqlDetail->bind_param("ssss", $id_transaksi, $id_barang, $qty_order, $subtotal);

            // Eksekusi query untuk memasukkan data ke dalam tabel detail_transaksi
            $sqlDetail->execute();
            $sqlDetail->close(); // Tutup prepared statement
        }

        $sql->close(); // Tutup prepared statement
    } else {
        http_response_code(500); // Set HTTP response code ke Internal Server Error
        echo "Error: " . $sql->error;
    }

    // Tutup koneksi ke database
    $koneksi->close();
}
?>
















    
</body>
</html>