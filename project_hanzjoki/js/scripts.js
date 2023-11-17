/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});





    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const dataTable = document.getElementById('datatablesSimple');

        searchInput.addEventListener('input', function () {
            const searchTerm = searchInput.value.toLowerCase();
            const rows = dataTable.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length; j++) {
                    const cellValue = cells[j].textContent.toLowerCase();

                    if (cellValue.includes(searchTerm)) {
                        found = true;
                        break;
                    }
                }

                if (found) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    });

    // $(document).ready(function () {
    //     $('.btn-detail').click(function () {
    //         var id_paket = $(this).data('id');
            
    //         // Mengambil data dari server menggunakan AJAX dan memperbarui nilai bidang modal
    //         $.ajax({
    //             url: 'fetch_data.php', // Ganti dengan URL sebenarnya untuk mengambil data
    //             type: 'GET',
    //             data: { id: id_paket },
    //             success: function (data) {
    //                 $('#editJudulPaket').val(data.judul_paket);
    //                 $('#editNamaPaket').val(data.nama_paket);
    //                 $('#editHarga').val(data.harga);
    //                 $('#editModalPopup').modal('show');
    //             },
    //             error: function () {
    //                 alert('Error mengambil data');
    //             }
    //         });
    //     });
    
    //     $('#editForm').submit(function (e) {
    //         e.preventDefault();
    //         // Memproses data formulir menggunakan AJAX dan menutup modal jika berhasil
    //         $.ajax({
    //             url: 'update_data.php', // Ganti dengan URL sebenarnya untuk memperbarui data
    //             type: 'POST',
    //             data: $('#editForm').serialize(),
    //             success: function () {
    //                 $('#editModalPopup').modal('hide');
    //                 // Secara opsional, Anda dapat me-reload atau memperbarui data tabel di sini
    //             },
    //             error: function () {
    //                 alert('Error memperbarui data');
    //             }
    //         });
    //     });
    
    //     // Menangani penutupan modal dengan tombol close
    //     $('.edit-close').click(function () {
    //         $('#editModalPopup').modal('hide');
    //     });
    // });
    
