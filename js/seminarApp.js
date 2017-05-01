var base_url = "http://127.0.0.1:8000/v1/seminar/";
var media_url = "http://127.0.0.1:8000/v1/media/";

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

var registerApp = angular.module("registerApp", [])
  .factory('httpInterceptor', httpInterceptor)
  .config(function($httpProvider) {
    $httpProvider.interceptors.push('httpInterceptor');
  });

registerApp.controller("registerCtrl", function($scope, $http, $window) {

  $scope.formData = {};
  $scope.errors = {};

  $scope.button = "DAFTAR";

  $scope.registerSubmit = function () {

    $scope.errors = {};

    $scope.button = "MENDAFTAR...";

    $http({
      method  : 'POST',
      url     : base_url,
      data    : $.param($scope.formData),
      headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
     })
    .then(function(response) {
      switch (response.status) {
        case 400:
          $scope.errors = response.data.errors;
          $scope.button = "DAFTAR";
        break;
        case 500:
          $scope.errors.ise = "Mohon maaf terdapat kesalahan di bagian server.";
          $scope.button = "DAFTAR";
          break;
        default:
          $window.location.href = 'pendaftaran-berhasil.html';
          $scope.button = "DAFTAR";
      }
    });
  }
});

var loginApp = angular.module("loginApp", [])
  .factory('httpInterceptor', httpInterceptor)
  .config(function($httpProvider) {
    $httpProvider.interceptors.push('httpInterceptor');
  });

  loginApp.controller("loginCtrl", function($scope, $http, $window) {

  $scope.formData = {};
  $scope.errors = "";

  $scope.button = "MASUK";

  $scope.loginSubmit = function () {

    $scope.errors = "";

    $scope.button = "MASUK...";

    $http({
      method  : 'POST',
      url     : base_url+'login',
      data    : $.param($scope.formData),
      headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
     })
    .then(function(response) {
      switch (response.status) {
        case 400:
          $scope.errors = response.data.errors;
          $scope.button = "MASUK";
        break;
        case 500:
          $scope.errors.ise = "Mohon maaf terdapat kesalahan di bagian server.";
          $scope.button = "MASUK";
          break;
        default:
          $scope.button = "MASUK...";

          $http({
            method  : 'POST',
            url     : 'proses-login.php',
            data    : $.param({ id: response.data.data.id }),
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
          }).then(function(data) {
            $window.location.href = 'area-peserta.php';
          });
      }
    });
  }
});

var app = angular.module('seminarApp', ['ngFileUpload'])
  .factory('httpInterceptor', httpInterceptor)
  .config(function($httpProvider) {
    $httpProvider.interceptors.push('httpInterceptor');
  });

app.controller('dataIndex', function($scope, $http, $timeout, Upload) {

  $scope.dataPeserta = {};
  $scope.dataDetail = {};
  $scope.errors = {};
  $scope.status = "";
  $scope.button = "Simpan";

  $scope.dataDetailsLoaded = 0;

  $scope.getTeam = function() {
    $http.get(base_url+$scope.idTeam).then(function (response) {

      $scope.dataPesertaLoaded = 0;
      $scope.dataPeserta = response.data.data;
      $scope.dataPesertaLoaded = 1;

      if ($scope.dataPeserta.media_id) {
        $http.get(media_url+$scope.dataPeserta.media_id).then(function (response) {
          $scope.dataPeserta.payment_name = response.data.data.file_name;
        });
      }

    });
  }

  $scope.updateTeam = function () {

    //$scope.dataPeserta['status'] = 0;
    $scope.errors = {};
    $scope.button = "Menyimpan...";

    $http({
      method  : 'PATCH',
      url     : base_url+$scope.idTeam,
      data    : $.param($scope.dataPeserta),
      headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
     })
    .then(function(response) {
      switch (response.status) {
        case 400:
          $scope.errors = response.data.errors;
          $scope.button = "Simpan";
        break;
        case 500:
          $scope.errors.ise = "Mohon maaf terdapat kesalahan di bagian server.";
          $scope.button = "DAFTAR";
          break;
        default:
          $scope.button = "Tersimpan";
          $timeout(function() { $scope.button = "Simpan"; }, 1000);
      }
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
          url     : base_url+$scope.idTeam+'/detail',
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

   $('.btn.delete-detail.'+id).text('Menghapus...');

   $http({
     method  : 'PATCH',
     url     : base_url+$scope.idTeam+'/detail',
     data    : $.param($scope.dataDetail),
     headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
   .then(function(data) {
     $scope.getTeam();
     $('.btn.delete-detail.'+id).text('Hapus');
   });
  }

  $scope.getTeam();
});