<?php
  error_reporting(0);
  ob_start();
  session_start();
  if (!$_SESSION['seminar']['id']) {
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Seminar Nasional - IFEST #5</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="bower_components/skeleton/css/normalize.css">
  <link rel="stylesheet" href="bower_components/skeleton/css/skeleton.css">
  <link rel="stylesheet" href="css/style.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

</head>
<body>

  <!-- Primary Page Layout
  ––––––––––––––––––––––––––––––––––––––––––––––––––-->
  <a href="http://ifest-uajy.com">
    <section id="header">
      <div class="container">
        <div class="row">
          <div class="twelve columns">
            <div class="ifest-header">
              <img class="ifest-logo" src="logo-ifest.png" alt="" />
              <h1 class="header-text">Informatics Festival #5</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
  </a>

  <section id="menu">
    <div class="container">
      <div class="row">
        <div class="twelve columns">
            <a href="index.html#header" class="logo">
                <img class="seminar-logo" src="img/logo.png" alt="" />
            </a>
            <nav class="navigation">
                <ul>
                  <li class="nav"><a class="menu-link" href="index.html#speaker"><span class="text-link">PEMBICARA</span></a></li>
                  <li class="nav"><a class="menu-link" href="index.html#benefit"><span class="text-link">INFORMASI</span></a></li>
                  <li class="nav"><a class="menu-link" href="index.html#registration"><span class="text-link">PENDAFTARAN</span></a></li>
                  <li class="nav"><a class="menu-link" href="area-peserta.php"><span class="text-link">AREA PESERTA</span></a></li>
                </ul>
            </nav>
            <div class="dropdown">
                <button type="button" name="button" id="dropdown"><img src="img/menu-icon.png" alt=""></button>
                <ul class="dropdown-list">
                  <li class="dropdown-nav"><a class="menu-link" href="index.html#speaker"><span class="text-link">PEMBICARA</span></a></li>
                  <li class="dropdown-nav"><a class="menu-link" href="index.html#benefit"><span class="text-link">INFORMASI</span></a></li>
                  <li class="dropdown-nav"><a class="menu-link" href="index.html#registration"><span class="text-link">PENDAFTARAN</span></a></li>
                  <li class="dropdown-nav"><a class="menu-link" href="area-peserta.php"><span class="text-link">AREA PESERTA</span></a></li>
                </div>
                </ul>
            </div>
        </div>
      </div>
    </div>
  </section>

  <section id="theme" ng-app="loginApp" ng-controller="loginCtrl">
    <div class="container">
        <div class="row">
            <div class="twelve columns">
              <img src="img/logo.png" alt=""/>
              <h1 class="theme-title">SEMINAR NASIONAL</h1>
              <div id="login-form">
                  <form ng-submit="loginSubmit()" class="form-login">
                      <div class="form-row">
                          <label>Email</label>
                          <input ng-model="formData.email" type="email" name="email" value="" required="">
                      </div>
                      <div class="form-row">
                          <label>Kata Sandi</label>
                          <input ng-model="formData.password" type="password" name="password" value="" required="">
                      </div>
                      <div class="form-row">
                          <button ng-disabled="button == 'MASUK...'" type="submit">{{ button }}</button>
                      </div>
                      <span ng-show="errors">{{ errors }}</span>
                  </form>
              </div>
            </div>
        </div>
    </div>
  </section>

  <section id="footer">
      <div class="container">
        <div class="row">
            <div class="six columns">
                <h2>Contact Person</h2>
                <p>+62 838 4040 2240 (Egik)</p>
            </div>
            <div class="six columns">
                <h2>Follow Us</h2>
                <a href="http://line.me/ti/p/~@ykb1847q"><img class="icon-img" src="img/line-icon.png" alt=""></a>
                <a href="https://www.instagram.com/ifest_uajy/"><img class="icon-img" src="img/ig-icon.png" alt=""></a>
            </div>
        </div>
      </div>
    </section>



<script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="bower_components/scrollreveal/dist/scrollreveal.min.js"></script>
<script type="text/javascript" src="js/animation.js"></script>
<script type="text/javascript" src="bower_components/angular/angular.min.js"></script>

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
      url     : 'http://api.ifest-uajy.com/v1/seminar/login',
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

</script>
<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
<?php
  }else{
    header("location: area-peserta.php");
  }
?>
