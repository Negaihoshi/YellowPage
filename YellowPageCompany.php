<?
    $ID = $_GET["Id"];
    $db_host = "localhost";
    $db_name = "company";
    $db_user = "root";
    $db_password = "mysql";
    $dsn = "mysql:host=$db_host;dbname=$db_name";
    $dbh = new PDO($dsn, $db_user, $db_password);
    $dbh->query('SET NAMES UTF8');

    $sql = "SELECT * FROM `companyData` WHERE `Id`=".$ID;

    $sth = $dbh->prepare($sql);
    $sth->execute();
    $data = $sth->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="zh-tw" ng-app="yellowpage">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>名錄 || <?echo $data['CompanyName'];?></title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="yellowpage.php">名錄</a>
        </div>
        <!--
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">全台灣</a></li>
            <li><a href="#">台北市</a></li>
            <li><a href="#">新北市</a></li>
            <li><a href="#">基隆市</a></li>
            <li><a href="#">宜蘭縣</a></li>
            <li><a href="#">連江縣</a></li>
            <li><a href="#">新竹市</a></li>
            <li><a href="#">新竹縣</a></li>
            <li><a href="#">桃園縣</a></li>
            <li><a href="#">苗栗縣</a></li>
            <li><a href="#">台中市</a></li>
            <li><a href="#">彰化縣</a></li>
            <li><a href="#">南投縣</a></li>
            <li><a href="#">嘉義市</a></li>
            <li><a href="#">嘉義縣</a></li>
            <li><a href="#">雲林縣</a></li>
            <li><a href="#">台南市</a></li>
            <li><a href="#">高雄市</a></li>
            <li><a href="#">澎湖縣</a></li>
            <li><a href="#">金門縣</a></li>
            <li><a href="#">屏東縣</a></li>
            <li><a href="#">台東縣</a></li>
            <li><a href="#">花蓮縣</a></li>
          </ul>
        </div>
        -->
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3 main"></div>
        <div class="col-md-6 main">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">名單</h3>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
              <table class="table  table-hover Bordered table" >
                <tbody>
                  <tr>
                    <td>統一編號</td>
                    <td><?echo $data['Id'];?></td>
                  </tr>
                  <tr>
                    <td>公司名稱</td>
                    <td><?echo $data['CompanyName'];?></td>
                  </tr>
                  <tr>
                    <td>公司狀況</td>
                    <td><?echo $data['CompanyType'];?></td>
                  </tr>
                  <tr>
                    <td>資本總額(元)</td>
                    <td><?echo $data['AssetAmount'];?></td>
                  </tr>
                  <tr>
                    <td>代表人姓名</td>
                    <td><?echo $data['Leader'];?></td>
                  </tr>
                  <tr>
                    <td>公司所在地</td>
                    <td><?echo $data['CompanyAddress'];?></td>
                  </tr>
                  <tr>
                    <td>登記機關</td>
                    <td><?echo $data['Government'];?></td>
                  </tr>
                  <tr>
                    <td>核准設立日期</td>
                    <td><?echo $data['AccessTime'];?></td>
                  </tr>
                  <tr>
                    <td>最後核准變更日期</td>
                    <td><?echo $data['LastChangeTime'];?></td>
                  </tr>
                  <tr>
                    <td>所營事業資料</td>
                    <td><?echo $data['Business'];?></td>
                  </tr>
                  <tr>
                    <td>董監事名單</td>
                    <td><?echo $data['Director'];?></td>
                  </tr>
                  <tr>
                    <td>經理人名單</td>
                    <td><?echo $data['ManagerList'];?></td>
                  </tr>
                  <tr>
                    <td>停業日期(起)</td>
                    <td><?echo $data['StopDateFrom'];?></td>
                  </tr>
                  <tr>
                    <td>停業日期(迄)</td>
                    <td><?echo $data['StopDateTo'];?></td>
                  </tr>
                  <tr>
                    <td>網址</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>電話</td>
                    <td></td>
                  </tr>
                </tbody>

              </table>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/docs.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.min.js"></script>
    <script src="https://code.angularjs.org/1.2.16/angular-resource.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/ui-bootstrap-tpls-0.11.0.min.js"></script>
    </body>
    <script>
        var yellowpage = angular.module('yellowpage', ['ui.bootstrap']);


        yellowpage.controller('yellowpage', function($scope, $http) {
            $http.get('FileListGet.php?start=<? echo $_GET["start"]?>&Type=<? echo $_GET["Type"]?>').success(function(data) {
                $scope.companys = data;
            });

        });
    </script>
</html>
