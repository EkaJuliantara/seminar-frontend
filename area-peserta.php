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
                  <a href="http://ifest-uajy.com/i2c" class="logo">
                      <img class="i2c-logo" src="img/logo.png" alt="" />
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
	              <table>
	                <tr>
	                  <th>Nama</th>
	                  <td>{{ dataPeserta.name }}</td>
	                </tr>
	                <tr>
	                  <th>Email</th>
	                  <td>{{ dataPeserta.email }}</td>
	                </tr>
	                <tr>
	                  <th>No. HP</th>
	                  <td>{{ dataPeserta.phone }}</td>
	                </tr>
	              </table>
              </div>

                <div>
                 <h5>Bukti Pembayaran</h5>
                 <table class="table">
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
                         <button ng-show="dataPeserta.media_id != NULL && dataPeserta.status == 0" ng-click="destroyDetail(dataPeserta.id)" type="button" class="btn delete-detail {{ dataPeserta.id }}">Hapus</button>
                       </td>
                     </tr>
                   </tbody>
                 </table>

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
                <p>Kecepatan koneksi internet mempengaruhi cepatnya data ditampilkan. Apabila data belum tertampil, silakan muat ulang halaman.</p>
                <p>Kami menyarankan menggunakan browser Mozilla Firefox</p>
                <p>Diberitahukan kepada seluruh perserta i2c kategori ide aplikasi mobile, bahwa batas pengumpulan proposal diundur sampai tanggal 8 April 2017. Bagi peserta yang sudah mendaftar jangan lupa juga untuk melengkapi data-data diri ya</p>
                <p>Untuk kategori FTI Promotional Video, batas pengumpulan video juga diundur sampai tanggal 28 April 2017. Pada tanggal 19-27 April 2017, peserta sudah diijinkan untuk mengambil video di seluruh Lab. FTI dengan membawa surat pernyataan peserta yang bisa diambil di stand iFest atau bisa meminta surat tersebut ke panitia iFest.</p>
                <p>Untuk mengambil surat pernyataan peserta ini, peserta harus melakukan pelunasan terlebih dahulu dan membawa bukti pembayarannya pada saat meminta surat.</p>
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

<script>
  function httpInterceptor() {
    return {
      request: function(config) {
        return config;
      },

      requestError: function(config) {
        return config;
      },

      response: function(res) {
        return res;
      },

      responseError: function(res) {
        return res;
      }
    }
  }

  var app = angular.module('seminarApp', ['ngFileUpload'])
    .factory('httpInterceptor', httpInterceptor)
    .config(function($httpProvider) {
      $httpProvider.interceptors.push('httpInterceptor');
    });

  app.controller('dataIndex', function($scope, $http, $timeout, Upload) {

   $scope.dataDetail = {};

    $scope.getTeam = function() {
      $http.get("http://api.ifest-uajy.com/v1/seminar/"+$scope.idTeam).then(function (response) {
        $scope.dataPeserta = response.data.data;
      });
    }

    $scope.uploadPayment = function(file, errFiles, id) {
      $scope.payment = file;
      $scope.errPayment = errFiles;

      if (id) {
        $('.payment-info.'+id).text($scope.payment.name);
      }else{
        $scope.infoPayment = $scope.payment.name;
      }
    }

    $scope.updateDetail = function(id) {

      if ($scope.payment) {

        $('.btn.update-detail.'+id).text('Menyimpan...');

        $scope.payment.upload = Upload.upload({
            url: 'http://api.ifest-uajy.com/v1/media',
            data: { media: $scope.payment }
        }).then(function (response) {

          $scope.dataDetail['media_id'] = response.data.data.id;

          $http({
            method  : 'PATCH',
            url     : 'http://api.ifest-uajy.com/v1/seminar/'+$scope.idTeam+'/detail',
            data    : $.param($scope.dataDetail),
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
           })
          .then(function(data) {
            $scope.getTeam();
          });
        });
      }
    }

    $scope.destroyDetail = function(id) {

     $scope.dataDetail['media_id'] = null;
     $scope.dataDetail['status'] = null;

     $http({
       method  : 'PATCH',
       url     : 'http://api.ifest-uajy.com/v1/seminar/'+$scope.idTeam+'/detail',
       data    : $.param($scope.dataDetail),
       headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      })
     .then(function(data) {
       $scope.getTeam();
       $('.btn.update-detail.'+id).text('Simpan');
     });
    }


    $scope.getTeam();
  });



</script>

<?php
  }else{
    header("location: login.php");
  }
?>
