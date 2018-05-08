<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCID AUX</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/nifty.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/demo/nifty-demo.min.css" rel="stylesheet">
</head>
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-out reveal">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <header id="navbar">
            <div id="navbar-container" class="boxed">
                <div class="navbar-header">
                    <a href="<?php echo base_url(); ?>" class="navbar-brand">
                        <img src="<?php echo base_url(); ?>assets/img/logo.png" class="brand-icon" style="height: 35px; width: auto; margin-top: 3px;">
                    </a>
                </div>
                <div class="navbar-content clearfix">
                    <ul class="nav navbar-top-links pull-right">
                        <li><a href="<?php echo base_url(); ?>dashboard">DASHBOARD</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="boxed">
            <div id="content-container">
                <div id="page-title">
                    <h1 class="page-header text-overflow">User Manual For Daily Use</h1>
                </div>

                <div id="page-content">
                	<div class="col-md-12 col-lg-12">
				        <div class="panel-group accordion" id="manualUse">
				            <div class="panel panel-bordered panel-primary">
				                <div class="panel-heading">
				                    <h4 class="panel-title">
				                        <a data-parent="#manualUse" data-toggle="collapse" href="#starter">Cara Memulai</a>
				                    </h4>
				                </div>
				                <div class="panel-collapse collapse in" id="starter">
				                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4>Aksesibilitas Aplikasi</h4>
                                            </div>
                                            <div class="col-lg-12">
                                                <ol>
                                                    <li>Buka Browser Pada Masing - Masing Perangkat Anda Dan Terhubung Pada Domain Lokal Transcosmos Indonesia <code>( Rekomendasi Browser Adalah Firefox dan Chrome)</code></li>
                                                    <li>Gunakan Link : <a class="text-info" target="_blank" href="http://10.0.24.45/tcid_att">http://10.0.24.45/tcid_att</a></li>
                                                    <li>Sebelum memulai Login, silahkan sesuaikan waktu pada perangkat anda <code>( PC / Laptop)</code>  yang anda gunakan dengan waktu yang tertera di halaman login aplikasi Aux System ini. <code>Jika waktu tidak sesaui dengan ketentuan lebih besar atau sama dengan 5 menit, silahkan hubungi administrator aplikasi ini ( IT System And Development )</code></li>
                                                    <li>Jika sudah sesuai, silahkan melakukan login menggunakan masing - masing NIP sebagai username dan gunakan password default : <span class="text-warning">TCID2017!</span></li>
                                                    <li>Jika login berhasil, maka akan langsung diarahkan ke halaman <span class="text-info">Dashboard</span>. Jika Gagal maka ada kesalahan meliputi : <span class="text-danger"> NIP / Username Salah, kesalahan teknis pada aplikasi, atau user / pengguna belum terdaftar</span></li>

                                                </ol>
                                            </div>
                                        </div>
				                    </div>
				                </div>
				            </div>
				            <div class="panel panel-success panel-bordered">
								<div class="panel-heading">
				                    <h4 class="panel-title">
				                        <a data-parent="#manualUse" data-toggle="collapse" href="#dashboard">Menu Dashboard Dan Fungsinya</a>
				                    </h4>
				                </div>
				                <div class="panel-collapse collapse" id="dashboard">
				                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4>Pengenalan Konten Dashboard</h4>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h5>1. Informasi Status User / Pengguna <code> Status Ini Berlangsung Realtime</code></h5>
                                                        <img src="<?php echo base_url(); ?>assets/img/usermanual/dashboard_ahtall.PNG" style="width: 100%;"/><br/><br/>
                                                        <ol>
                                                            <li><img src="<?php echo base_url(); ?>assets/img/usermanual/dashboard_ahtuser.PNG"> adalah jumlah user / pengguna yang sedang login pada hari tersebut</li> <br/>
                                                            <li><img src="<?php echo base_url(); ?>assets/img/usermanual/dashboard_ahtaux.PNG"> adalah jumlah user / pengguna yang sedang Aux pada hari tersebut</li> <br/>
                                                            <li><img src="<?php echo base_url(); ?>assets/img/usermanual/dashboard_ahtavail.PNG"> adalah jumlah user / pengguna yang sedang login dan tidak sedang aux pada hari tersebut</li> <br/>
                                                            <li><img src="<?php echo base_url(); ?>assets/img/usermanual/dashboard_ahtshift.PNG"> adalah jumlah user / pengguna yang memiliki shift pada hari tersebut, baik sedang login maupun belum login</li> <br/>
                                                        </ol>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h5>2. Melakukan AUX ( memulai dan mengakhiri ) <code> Status Ini Berlangsung Realtime Pada Semua Dashboard Pengguna Lain</code></h5></h5>
                                                        <img src="<?php echo base_url(); ?>assets/img/usermanual/dashboard_auxfunction.PNG" style="width: 100%;"/><br/><br/>
                                                        <ol>
                                                            <li>Untuk memulai AUX, perhatikan gambar diatas, terletak pada sisi kiri halaman dashboard</li>
                                                            <li>Pilih alasan / reason aux pada dropdown list seperti gambar diatas, kemudian</li>
                                                            <li>Klik / tekan tombol Jingga pada gambar diatas</li>
                                                            <li>Jika berhasil, maka halaman akan melakukan penyegaran / reload otomatis dan jendela pop-up baru akan muncul seperti gambar dibawah ini</li>
                                                            <br/><img src="<?php echo base_url(); ?>assets/img/usermanual/dashboard_popupaux.PNG" style="width: 20%;"/><br/><br/>
                                                            <li>Jika pop-up diatas muncul, maka anda sedang dalam status aux</li>
                                                            <li>Jika ingin kembali available atau mengakhiri aux, klik / tekan tombol merah "END AUX"</li>
                                                            <li>Jika berhasil, maka jendela pop up akan hilang, dan kembali ke halaman dashboard</li>
                                                        </ol>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h5>2. Melakukan Log-out ( Mengakhiri Session Aplikasi Aux) <code> Status Ini Berlangsung Realtime Pada Semua Dashboard Pengguna Lain</code></h5></h5>
                                                        <img src="<?php echo base_url(); ?>assets/img/usermanual/dashboard_logoutfunction.PNG" style="width: 100%;"/><br/><br/>
                                                        <ol>
                                                            <li>Untuk melakukan logout dan mengakhiri session pada aplikasi ini, perhatikan gambar diatas, terdapat beberapa informasi seperti : Waktu Login, Informasi Shift, dan Tanggal Shift</li>
                                                            <li>Klik / tekan tombol berwarna merah</li>
                                                            <li>Jika berhasil maka session anda akan terhapus dan waktu logout anda akan otomatis tersimpan pada sistem.</li>
                                                            <li>Halaman akan otomatis diarahkan pada halamn login</li>
                                                        </ol>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h5>3. Tabel Detail Informasi Masing - Masing User / Pengguna <code> Status Ini Berlangsung Realtime Pada Semua Dashboard Pengguna Lain</code></h5></h5>
                                                        <img src="<?php echo base_url(); ?>assets/img/usermanual/dashboard_statusList.PNG" style="width: 100%;"/><br/><br/>
                                                        <p>Bagian / konten pada tabel dan fungsinya </p>
                                                        <ol class="text-justify">
                                                            <li><img src="<?php echo base_url(); ?>assets/img/usermanual/dashboard_statuslog.PNG"> dan <img src="<?php echo base_url(); ?>assets/img/usermanual/dashboard_statuslog2.PNG"> menunjukkan status login masing - masing pengguna dan terdapat pada kolom "Login At" tabel, jika biru "Datang Tepat Waktu" dan merah jika status terlambat</li> <br/>
                                                            <li>Kolom "Aux Reason" menunjukkan status aux masing - masing pengguna. Status ini otomatis muncul dan berubah jika masing - masing user / pengguna memulai dan mengakhiri aux session</li><br/>
                                                            <li>Kolom "Aux Status" terdapat dua status, yaitu : <img src="<?php echo base_url(); ?>assets/img/usermanual/dashboard_statusauxavail.PNG"> untuk status user / pengguna yang available dan tidak aux dan <img src="<?php echo base_url(); ?>assets/img/usermanual/dashboard_statusauxavail2.PNG"> jika user / pengguna sedang dalam status aux ( disertakan penghitungan waktu berjalan )</li><br/>
                                                            <li>Kolom "Limit Aux" menunjukkan jumlah keseluruhan waktu yang digunakan untuk aux dalam shift kehadiran pada hari tersebut. Quota default limit yang diberikan adalah 1 Jam 15 Menit ( 1:15:00 ). Terdapat 3 warna status pada kolom ini, yaitu : <img src="<?php echo base_url(); ?>assets/img/usermanual/dashboard_statuslimit.PNG"> Jika jumlah Keseluruhan waktu yang digunakan lebih besar atau sama dengan 85 % dari quota limit yang diberikan, <img src="<?php echo base_url(); ?>assets/img/usermanual/dashboard_statuslimit2.PNG"> Jika jumlah Keseluruhan waktu yang digunakan lebih besar atau sama dengan 65 % dan lebih kecil atau sama dengan 85 % dari quota limit yang diberikan, dan <img src="<?php echo base_url(); ?>assets/img/usermanual/dashboard_statuslimit3.PNG"> Jika jumlah Keseluruhan waktu yang digunakan lebih kecil dari 65 % dari quota limit yang diberikan</li><br/>
                                                            <li>Kolom "Settings" berisikan button / tombol yang berfungsi untuk melakukan logout paksa / force logout. tombol ini dibutuhkan jika user / pengguna lupa logout atau sudah melebihi waktu shift namun belum logout</li><br/>
                                                        </ol>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h5 class="text-right"><code> Perlu Diperhatikan !</code></h5>
                                                        
                                                            <ol class="text-justify">
                                                                <li><code>Setiap session login harus di logout</code></li>
                                                                <li><code>Jadi, setiap user / pengguna yang sudah login harus melakukan logout untuk mengakhiri session. Jika terkendala dan lupa logout silahkan konfirmasi ke masing - masing admin project untuk melakukan force logout, atau silahkan melakukan logout keesokan harinya lalu login kembali. ( Jika tidak melakukan logout dan tidak mengkonfirmasi pada admin untuk force logout maka session login / out per hari setelahnya akan tetap berjalan menggunakan shift sebelumnya dan hanya terhitung hadir pada hari sebelumnya bukan pada hari tersebut / current day )</code></li>
                                                                <li><code>Untuk Aux, setiap user / pengguna yang sedang melakukan aux / start aux harus mengakhiri session auxnya, jika tidak aux akan tetap terus berjalan dan terhitung sampai user / pengguna mengakhirinya ( akan beresiko untuk jumlah aux melebihi limit yang diberikan ) untuk masing - masing pengguna per masing - masing project</code></li>
                                                            </ol>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
				                    </div>
				                </div>
				            </div>
				            <div class="panel panel-warning panel-bordered">
								<div class="panel-heading">
				                    <h4 class="panel-title">
				                        <a data-parent="#manualUse" data-toggle="collapse" href="#report">Menu Report Dan Fungsinya</a>
				                    </h4>
				                </div>
				                <div class="panel-collapse collapse" id="report">
				                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4>Tampilan Default Report</h4>
                                            </div>
                                            <div class="col-lg-6">
                                                <img src="<?php echo base_url(); ?>assets/img/usermanual/report_view.png" style="width: 100%;">
                                            </div>
                                            <div class="col-lg-6">
                                                <h5>Bagian / Konten Pada Menu Report</h5>
                                                <ol>
                                                    <li>Konten Block Form Export Excel : Bagian kontent yang digunakan untuk melakukan download data Aux dan Login sesuai dengan pilihan tanggal dan user / pengguna</li>
                                                    <li>Kontent Block All Agent On Shift Today : Bagian view untuk melihat aktifitas user login dan aux pada waktu yang dipilih dan user / pengguna yang dipilih. Jika tidak dalam pilihan / tampilan default list adalah tanggal waktu tersebut / current date</li>
                                                </ol>
                                                <h5>Melakukan Export Data Login Dan Aux</h5>
                                                <ol>
                                                    <li>Fokuskan tampilan pada block konten "Form Export Excel", kemudian</li>
                                                    <li>Pilih datepicker "select start date" dan "select end date", kemudian</li>
                                                    <li>Pilih dropdown list user / pengguna, kemudian</li>
                                                    <li>Klik / tekan tombol "Export Excel"</li>
                                                    <li>Jika datepicker dan dropdown list employee tidak dipilih maka filter defaultnya adalah current date dan all employees</li>
                                                </ol>
                                                <h5>Menampilkan Status Aux dan Login Pengguna Menggunakan Filter Pencarian</h5>
                                                <ol>
                                                    <li>Fokuskan tampilan pada block konten "All Agent On Shift Today", kemudian</li>
                                                    <li>Pilih datepicker "select start date" dan "select end date", kemudian</li>
                                                    <li>Pilih dropdown list user / pengguna, kemudian</li>
                                                    <li>Klik / tekan tombol "Search Data"</li>
                                                    <li>Maka akan tampil list aux dan login pengguna sesuai dengan filter yang dipilih</li>
                                                </ol>
                                                <h5>Menampilkan Detail Login Dan Aux Masing - Masing User / Pengguna</h5>
                                                <ol>
                                                    <li>Fokuskan tampilan pada block konten "All Agent On Shift Today", kemudian</li>
                                                    <li>Pilih dan klik tombol biru "Detail pada masing masing list pengguna"</li>
                                                    <li>Akan muncul pop-up tabel detail login dan aux pada user / pengguna yang dipilih</li>
                                                </ol>
                                            </div>
                                        </div>
				                    </div>
				                </div>
				            </div>
				            <div class="panel panel-danger panel-bordered">
								<div class="panel-heading">
				                    <h4 class="panel-title">
				                        <a data-parent="#manualUse" data-toggle="collapse" href="#configuration">Menu Konfigurasi Dan Fungsinya</a>
				                    </h4>
				                </div>
				                <div class="panel-collapse collapse" id="configuration">
				                    <div class="panel-body">
                                         <div class="row">
                                            <div class="col-lg-12">
                                                <h4>Tampilan Menu "CONFIG SHIFT LIST"</h4>
                                            </div>
                                            <div class="col-lg-6">
                                                <img src="<?php echo base_url(); ?>assets/img/usermanual/shift_config.png" style="width: 100%;">
                                            </div>
                                            <div class="col-lg-6">
                                                <h5>Bagian / Konten Pada Menu "CONFIG SHIFT LIST"</h5>
                                                <ol>
                                                    <li>Konten Block Form Import Shift : Bagian kontent yang digunakan untuk melakukan import data shift user / pengguna menggunakan template yang sudah diberikan</li>
                                                    <li>Kontent Block Shift List : Bagian view untuk melihat list shift seluruh user / pengguna dalam satu project ( Tampilan default adalah shift pada current date )</li>
                                                </ol>
                                                <h5>Melakukan Import Data Shift</h5>
                                                <ol>
                                                    <li>Fokuskan tampilan pada block konten "Form import Shift", kemudian</li>
                                                    <li>Pilih monthpicker "select start date" dan "select month", kemudian</li>
                                                    <li>Klik "Select Data" dan pilih file shift yang akan di-import, kemudian</li>
                                                    <li>Klik / tekan tombol "Submit Upload"</li>
                                                    <li>Tunggu beberapa saat, jika berhasil maka halaman shift list akan menyegarkan kembali / reload otomatis, jika gagal akan ada notifikasi gagal pada pojok kanan atas halaman</li>
                                                </ol>
                                                <h5>Menampilkan Shift Pengguna Menggunakan Filter Pencarian</h5>
                                                <ol>
                                                    <li>Fokuskan tampilan pada block konten "Shift List", kemudian</li>
                                                    <li>Pilih datepicker "select shift date", kemudian</li>
                                                    <li>Pilih dropdown list user / pengguna, kemudian</li>
                                                    <li>Klik / tekan tombol "Search Data"</li>
                                                    <li>Maka akan tampil list shift pengguna sesuai dengan filter yang dipilih</li>
                                                </ol>
                                                <h5>Menampilkan Dan Merubah Shift Masing - Masing User / Pengguna</h5>
                                                <ol>
                                                    <li>Fokuskan tampilan pada block konten "Shift List", kemudian</li>
                                                    <li>Cari menggunakan input search / scroll tampilan menggunakan pilihan halaman pada bagian bawah tabel</li>
                                                    <li>Silahkan merubah shift pada kolom tabel list "Shift Code" dengan memilih pada dropdown list shift, kemudian</li>
                                                    <li>Tekan / Klik tombol hijau "Save"</li>
                                                </ol>
                                            </div>
                                        </div>
				                    </div>
				                </div>
				            </div>

				        </div>
				    </div>
                </div>
            </div>
        </div>
        <footer id="footer">
            <div class="hide-fixed pull-right pad-rgt"> Aplikasi Aux System Ver.3.0.1</div>
            <p class="pad-lft">&#0169; 2017 Transcosmos Indonesia</p>
        </footer>
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
    </div>
    <!--jQuery [ REQUIRED ]-->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/nifty.min.js"></script>

</body>
</html>
