<?

    $db_host = "localhost";
    $db_name = "company";
    $db_user = "root";
    $db_password = "mysql";
    $dsn = "mysql:host=$db_host;dbname=$db_name";
    $dbh = new PDO($dsn, $db_user, $db_password);
    $dbh->query('SET NAMES UTF8');

    $sql = "SELECT `Count` FROM `companyCount`";

    $sth = $dbh->prepare($sql);
    $sth->execute();
    $number_of_rows = $sth->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_GET['Type'])== false){
        $_GET['Type'] = "All";
    }
    if(isset($_GET['start'])== false){
        $_GET['start'] = 0;
    }
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

    <title>名錄</title>

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
          <a class="navbar-brand" href="#">名錄</a>
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
    <div>
        <form class="navbar-form navbar-left" role="search" method="post" action="Search.php">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search" name="inputstring" required>
            </div>
            <div class="radio" id="optradio">
                <label><input type="radio" name="optradio" value="1">公司</label>
                <label><input type="radio" name="optradio" value="2">分公司</label>
                <label><input type="radio" name="optradio" value="3">商業登記</label>
                <label><input type="radio" name="optradio" value="4">協會</label>
                <label><input type="radio" name="optradio" value="5">基金會</label>
            </div>
            <div class="radio" id="option1">
                <label><input type="radio" name="option1" class="option1" value="1">統編</label>
                <label><input type="radio" name="option1" class="option1" value="2">名稱</label>
                <label><input type="radio" name="option1" class="option1" value="3">地址</label>
            </div>
            <div class="radio" id="option2">
                <label><input type="radio" name="option2" class="option2" value="1">名稱</label>
                <label><input type="radio" name="option2" class="option2" value="2">地址</label>
            </div>
            <input type="hidden" name="flag" id="flag" value="">
            <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>

    <div class="container-fluid" ng-controller="yellowpage">

      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <!--
          <ul class="nav nav-sidebar">
            <li><a href="#">所有類別 </a></li>
            <li><a href="#">Ａ大類【農、林、漁、牧業】 </a></li>
            <li><a href="#">Ｂ大類【礦業及土石採取業】 </a></li>
            <li><a href="#">Ｃ大類【製造業】 </a></li>
            <li><a href="#">Ｄ大類【水電燃氣業】 </a></li>
            <li><a href="#">Ｅ大類【營造及工程業】</a></li>
            <li><a href="#">Ｆ大類【批發、零售及餐飲業】 </a></li>
            <li><a href="#">Ｇ大類【運輸、倉儲及通信業】</a></li>
            <li><a href="#">Ｈ大類【金融、保險及不動產業】</a></li>
            <li><a href="#">Ｉ大類【專業、科學及技術服務業】 </a></li>
            <li><a href="#">Ｊ大類【文化、運動、休閒及其他服務業】 </a></li>
            <li><a href="#">Ｚ大類【其他未分類業】 </a></li>
          </ul>
            -->
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <ul class="nav nav-pills">
            <li class="active">
              <a href="yellowpage.php?Type=All">
                <span class="badge pull-right"><?php echo $number_of_rows[0]['Count']; ?></span>
                全部
              </a>
            </li>
            <li>
              <a href="yellowpage.php?Type=Company">
                <span class="badge pull-right"><?php echo $number_of_rows[1]['Count']; ?></span>
                公司
              </a>
            </li>
            <li>
              <a href="yellowpage.php?Type=SubCompany">
                <span class="badge pull-right"><?php echo $number_of_rows[2]['Count']; ?></span>
                分公司
              </a>
            </li>
            <li>
              <a href="yellowpage.php?Type=Business">
                <span class="badge pull-right"><?php echo $number_of_rows[3]['Count']; ?></span>
                商業
              </a>
            </li>
            <li>
              <a href="yellowpage.php?Type=Organization">
                <span class="badge pull-right"><?php echo $number_of_rows[6]['Count']+$number_of_rows[7]['Count']; ?></span>
                協會
              </a>
            </li>
            <li>
              <a href="yellowpage.php?Type=Fundation">
                <span class="badge pull-right"><?php echo $number_of_rows[8]['Count']; ?></span>
                基金會
              </a>
            </li>
          </ul>
          <br>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">名單</h3>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
              <table class="table  table-hover Bordered table" >
                <thead>
                  <tr>
                    <td>編號</td>
                    <td>類型</td>
                    <td>名稱</td>
                  </tr>
                </thead>

                <tbody>
                <tr  ng-repeat="company in companys">
                    <td>
                        <?
                            switch ($_GET['Type'])
                            {
                                case 'All':
                                    echo "<a href='YellowPageCompany.php?Id={{company.Id}}'>{{company.Id}}</a>";
                                    break;

                                case 'SubCompany':
                                    echo "<a href='YellowPageSubCompany.php?Id={{company.Id}}'>{{company.Id}}</a>";
                                    break;

                                case 'Company':
                                    echo "<a href='YellowPageCompany.php?Id={{company.Id}}'>{{company.Id}}</a>";
                                    break;

                                case 'Business':
                                    echo "<a href='YellowPageBusiness.php?Id={{company.Id}}'>{{company.Id}}</a>";
                                    break;

                                case 'Organization':
                                    echo "<a href='YellowPageOrganization.php?Id={{company.DataId}}'>{{company.DataId}}</a>";
                                    break;

                                case 'Fundation':
                                    echo "<a href='YellowPageFundation.php?Id={{company.DataId}}'>{{company.DataId}}</a>";
                                    break;

                                default:
                                    echo "<a href='YellowPageCompany.php?Id={{company.Id}}'>{{company.Id}}</a>";//尚未修改成company+fundation+organization
                                    break;
                            }
                        ?>
                    </td>

                    <td>
                    <?php
                        if($_GET['Type']=='Fundation')
                            echo "基金會";
                    ?>
                        {{company.Type}}
                    </td>

                    <td>
                        <?
                            switch ($_GET['Type'])
                            {
                                case 'All':
                                    echo "<a href='YellowPageCompany.php?Id={{company.Id}}'>{{company.Name}}</a>";
                                    break;

                                case 'SubCompany':
                                    echo "<a href='YellowPageSubCompany.php?Id={{company.Id}}'>{{company.Name}}</a>";
                                    break;

                                case 'Company':
                                    echo "<a href='YellowPageCompany.php?Id={{company.Id}}'>{{company.Name}}</a>";
                                    break;

                                case 'Business':
                                    echo "<a href='YellowPageBusiness.php?Id={{company.Id}}'>{{company.Name}}</a>";
                                    break;

                                case 'Organization':
                                    echo "<a href='YellowPageOrganization.php?Id={{company.DataId}}'>{{company.Name}}</a>";
                                    break;

                                case 'Fundation':
                                    echo "<a href='YellowPageFundation.php?Id={{company.DataId}}'>{{company.Name}}</a>";
                                    break;

                                default:
                                    echo "<a href='YellowPageCompany.php?Id={{company.Id}}'>{{company.Name}}</a>";
                                    break;
                            }
                        ?>
                    </td>
                  </tr>

                </tbody>

              </table>
            <ul class="pager">
                <?
                    switch ($_GET['Type']) {
                        case 'All':
                            $TypeNumber = 0;
                            break;
                        case 'Company':
                            $TypeNumber = 1;
                            break;
                        case 'SubCompany':
                            $TypeNumber = 2;
                            break;
                        case 'Business':
                            $TypeNumber = 3;
                            break;
                        case 'Organization':
                            $TypeNumber = 4;
                            break;
                        case 'Fundation':
                            $TypeNumber = 5;
                            break;
                        default:
                            $TypeNumber = 0;
                            break;
                    }
                    $Next = $_GET['start'] + 25;
                    if($_GET['start']!= 0) $Previous = $_GET['start'] - 25;
                    else $Previous = 0;
                    if($_GET['start']==0){
                        echo '<li class="previous disabled"><a href="">&larr; Previous</a></li>';
                        echo '<li class="next"><a href="yellowpage.php?start='.$Next.'&Type='.$_GET["Type"].'">Next &rarr;</a></li>';
                    }else if($_GET['start'] >= $number_of_rows[$TypeNumber]['Count']/4){
                        echo '<li class="previous"><a href="yellowpage.php?start='.$Previous.'&Type='.$_GET["Type"].'">&larr; Previous</a></li>';
                        echo '<li class="next disabled"><a href="">Next &rarr;</a></li>';
                    }else{
                        echo '<li class="previous"><a href="yellowpage.php?start='.$Previous.'&Type='.$_GET["Type"].'">&larr; Previous</a></li>';
                        echo '<li class="next"><a href="yellowpage.php?start='.$Next.'&Type='.$_GET["Type"].'">Next &rarr;</a></li>';
                    }
                ?>

            </ul>

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

            $http.get('fileListGet.php?start=<? echo $_GET["start"]?>&Type=<? echo $_GET["Type"]?>').success(function(data) {
                $scope.companys = data;
            });

        });



    </script>
    <script>
            $('#optradio').change(function() {
                if($('input[name="optradio"]:checked').val() == 1 || $('input[name="optradio"]:checked').val() == 2 || $('input[name="optradio"]:checked').val() == 3)
                {
                    $('#option2').hide();
                    $('#option1').show();
                    $('input#flag').val("0");
                }
                else if($('input[name="optradio"]:checked').val() == 4 || $('input[name="optradio"]:checked').val() == 5)
                {
                    $('#option1').hide();
                    $('#option2').show();
                    $('input#flag').val("1");
                }
            }).change();
    </script>
</html>
