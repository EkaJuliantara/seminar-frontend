<?php
  ob_start();
  session_start();
  if ($_SESSION['seminar']['id']) {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Basic Page Needs
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Seminar - Area Peserta</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="bower_components/skeleton/css/normalize.css">
    <link rel="stylesheet" href="bower_components/skeleton/css/skeleton.css">
    <link rel="stylesheet" href="css/admin.css">

    <!-- Favicon
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="icon" type="image/png" href="img/favicon.png">
  </head>
  <body>
    <section id="header">
        <div class="container">
            <div class="row">
                <div class="twelve columns">
                  <a href="index.html" class="logo">
                      <img class="seminar-logo" src="img/logo.png" alt="" />
                  </a>
                  <a class="btn logout" href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </section>

    <section ng-app="seminarApp" ng-init="idTeam=<?php echo $_SESSION['seminar']['id']; ?>" id="main">
      <div ng-controller="dataIndex" class="container">
        <div class="row">
          <div class="eight columns">
            <div class="box">
              <div class="box-body">

              <div>
                <h5>Data Peserta</h5>
                <form ng-show="dataPesertaLoaded" ng-submit="updateTeam()">
                  <table>
                    <tr>
                      <th>Nama</th>
                      <td><input ng-model="dataPeserta.name" type="text" name="name" required /></td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td><input ng-model="dataPeserta.email" type="email" name="email" required /></td>
                    </tr>
                    <tr>
                      <th>No. HP</th>
                      <td><input ng-model="dataPeserta.phone" type="text" name="phone" required /></td>
                    </tr>
                    <tr>
                      <th>Vegetarian</th>
                      <td>
                        <input ng-model="dataPeserta.vegetarian" type="radio" name="vegetarian" ng-value="1" /> Iya
                        <input ng-model="dataPeserta.vegetarian" type="radio" name="vegetarian" ng-value="0" /> Tidak
                      </td>
                    </tr>
                  </table>
                  <button type="submit" class="btn">{{ button }}</button>
                </form>
                <p ng-hide="dataPesertaLoaded">Sedang mengambil data dari server. Mohon tunggu sebentar ya...</p>
              </div>

                <div>
                 <h5>Bukti Pembayaran</h5>
                 <table ng-show="dataPesertaLoaded" class="table">
                   <thead>
                     <tr>
                       <th style="width: 150px;">
                         Bukti Pembayaran
                       </th>
                       <th>
                         Status
                       </th>
                       <th>
 					              Action
                       </th>
                     </tr>
                   </thead>
                   <tbody id="detail-list">
                     <tr>
                       <td>
                         <a ng-show="dataPeserta.media_id != NULL" href="http://api.ifest-uajy.com/storage/media/{{ dataPeserta.payment_name }}" target="_blank">Lihat</a>

                         <button ng-show="dataPeserta.media_id == NULL" type="file" ngf-select="uploadPayment($file, $invalidFiles, dataPeserta.id)" accept="image/*" ngf-max-size="10MB" class="btn">Unggah</button> <br>
                         <span ng-show="dataPeserta.media_id == NULL" class="payment-info {{ dataPeserta.id }}">Pilih file</span>
                       </td>
                       <td>
                         <span ng-show="dataPeserta.media_id == NULL">Silahkan Uploud Bukti Pembayaran</span>
                         <span ng-show="dataPeserta.status == NULL && dataPeserta.media_id != NULL">Menunggu verifikasi...</span>
                         <span ng-show="dataPeserta.status == 0">Tidak lolos</span>
                         <span ng-show="dataPeserta.status == 1">Lolos</span>
                       </td>
                       <td>
                         <button ng-show="dataPeserta.media_id == NULL" ng-click="updateDetail(dataPeserta.id)" type="button" class="btn update-detail {{ dataPeserta.id }}">Simpan</button>
                         <button ng-show="dataPeserta.media_id != NULL && dataPeserta.status == NULL" ng-click="destroyDetail(dataPeserta.id)" type="button" class="btn delete-detail {{ dataPeserta.id }}">Hapus</button>
                       </td>
                     </tr>
                   </tbody>
                 </table>
                 <p ng-hide="dataPesertaLoaded">Sedang mengambil data dari server. Mohon tunggu sebentar ya...</p>
                </div>

                <br>
              </div>
            </div>
          </div>
          <div class="four columns">
            <div class="box">
              <div class="box-header">
                <h5>Pengumuman</h5>
              </div>
              <div class="box-body">
                <p>Silakan melakukan pembayaran pendaftaran seminar sebesar Rp50.000</p>
                <p>Untuk pembayaran dapat dilakukan langsung ke stand IFest di Lobby Fakultas Teknologi Industri, Kampus 3, Gedung Bonaventura, Jalan Babarsari 43 Yogyakarta atau melalui transfer ke <strong> Bank BCA dengan nomor rekening 0373749971 atas nama Grelly Lucia Yovellia Londo.</strong></p>
                <p>Kecepatan koneksi internet mempengaruhi cepatnya data ditampilkan. Apabila data belum tertampil, silakan muat ulang halaman.</p>
                <p>Kami menyarankan menggunakan browser Mozilla Firefox</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Document
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
 </body>
</html>

<script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="bower_components/angular/angular.min.js"></script>
<script type="text/javascript" src="bower_components/ng-file-upload-shim/ng-file-upload-shim.min.js"></script>
<script type="text/javascript" src="bower_components/ng-file-upload/ng-file-upload.min.js"></script>
<script type="text/javascript" src="js/seminarApp.js"></script>

<?php
  }else{
    header("location: login.php");
  }
?>
