<?php
    $db_host = "localhost";
    $db_name = "company";
    $db_user = "root";
    $db_password = "mysql";
    $dsn = "mysql:host=$db_host;dbname=$db_name";
    $dbh = new PDO($dsn, $db_user, $db_password);
    $dbh->query('SET NAMES UTF8');

$TypeNumber = $_POST['optradio'];
$v = $_POST['inputstring'];
$option1 = $_POST['option1'];
$option2 = $_POST['option2'];
$flag = $_POST['flag'];

$Type = "";
$data = array();

if(isset($_GET["start"])==true)
{
    $start = $_GET["start"];
}
else
{
    $start = 0;
}

switch($TypeNumber) {
    case '1':
        $Type = 'Company';
        $sql = "SELECT * FROM `companyData`";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        while($number_of_rows = $sth->fetch(PDO::FETCH_ASSOC))
        {
            if($flag == 0)
            {
                switch($option1)
                {
                    case '1':
                        if(strpos($number_of_rows['Id'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                    case '2':
                        if(strpos($number_of_rows['CompanyName'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    case '3':
                        if(strpos($number_of_rows['CompanyAddress'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    default:
                        break;
                }
            }
            else
                break;
        }

        if(isset($Type)== false)
            $Type = 'Company';
        break;
    case '2':
        $Type = 'SubCompany';
        $sql = "SELECT * FROM `subcompanyData`";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        while($number_of_rows = $sth->fetch(PDO::FETCH_ASSOC))
        {
            if($flag == 0)
            {
                switch($option1)
                {
                    case '1':
                        if(strpos($number_of_rows['DataId'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                    case '2':
                        if(strpos($number_of_rows['SubcompanyName'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    case '3':
                        if(strpos($number_of_rows['SubcompanyAddress'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    default:
                        break;
                }
            }
            else
                break;
        }

        if(isset($Type)== false)
            $Type = 'SubCompany';
        break;
    case '3':
        $Type = 'Business';
        $sql = "SELECT * FROM `businessData`";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        while($number_of_rows = $sth->fetch(PDO::FETCH_ASSOC))
        {
            if($flag == 0)
            {
                switch($option1)
                {
                    case '1':
                        if(strpos($number_of_rows['DataId'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                    case '2':
                        if(strpos($number_of_rows['BusinessName'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    case '3':
                        if(strpos($number_of_rows['BusinessAddress'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    default:
                        break;
                }
            }
            else
                break;
        }

        if(isset($Type)== false)
            $Type = 'Business';
        break;
    case '4':
        $Type = 'Organization';
        $sql = "SELECT * FROM `organizationData`";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        while($number_of_rows = $sth->fetch(PDO::FETCH_ASSOC))
        {
            if($flag == 1)
            {
                switch($option2)
                {
                    case '1':
                        if(strpos($number_of_rows['Name'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    case '2':
                        if(strpos($number_of_rows['Address'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    default:
                        break;
                }
            }
            else
                break;
        }

        if(isset($Type)== false)
            $Type = 'Organization';
        break;
    case '5':
        $Type = 'Fundation';
        $sql = "SELECT * FROM `fundationData`";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        while($number_of_rows = $sth->fetch(PDO::FETCH_ASSOC))
        {
            if($flag == 1)
            {
                switch($option2)
                {
                    case '1':
                        if(strpos($number_of_rows['Name'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    case '2':
                        if(strpos($number_of_rows['Address_1'], $v) !== false || strpos($number_of_rows['Address_2'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    default:
                        break;
                }
            }
            else
                break;
        }

        if(isset($Type)== false)
            $Type = 'Fundation';
        break;
    default:
        break;
}
$length = count($data);
json_encode($data);


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

        <title>搜尋結果</title>

        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/dashboard.css" rel="stylesheet">
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
                    <a class="navbar-brand" href="Yellowpage.php">名錄</a>
                </div>
            </div>
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
                <span class="badge pull-right"></span>
                全部
              </a>
            </li>
            <li>
              <a href="yellowpage.php?Type=Company">
                <span class="badge pull-right"></span>
                公司
              </a>
            </li>
            <li>
              <a href="yellowpage.php?Type=SubCompany">
                <span class="badge pull-right"></span>
                分公司
              </a>
            </li>
            <li>
              <a href="yellowpage.php?Type=Business">
                <span class="badge pull-right"></span>
                商業
              </a>
            </li>
            <li>
              <a href="yellowpage.php?Type=Organization">
                <span class="badge pull-right"></span>
                協會
              </a>
            </li>
            <li>
              <a href="yellowpage.php?Type=Fundation">
                <span class="badge pull-right"></span>
                基金會
              </a>
            </li>
          </ul>
          <br>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">搜尋結果</h3>
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
<?php
    if (empty($data))
    echo "ffsffsffs";
    switch($Type)
    {
        case 'Company':
            for ($i = 0; $i < $length; $i++)
            {
                echo "<tr>";
                echo "<td><a href='YellowPageCompany.php?Id=".$data[$i]['Id']."'>".$data[$i]['Id']."</a></td>";
                echo "<td>公司</td>";
                echo "<td><a href='YellowPageCompany.php?Id=".$data[$i]['Id']."'>".$data[$i]['CompanyName']."</a></td>";
                echo "</tr>";
            }
            break;
        case 'SubCompany':
            for ($i = 0; $i < $length; $i++)
            {
                echo "<tr>";
                echo "<td><a href='YellowPageSubCompany.php?Id=".$data[$i]['DataId']."'>".$data[$i]['DataId']."</a></td>";
                echo "<td>分公司</td>";
                echo "<td><a href='YellowPageSubCompany.php?Id=".$data[$i]['DataId']."'>".$data[$i]['SubcompanyName']."</a></td>";
                echo "</tr>";
            }
            break;
        case 'Business':
            for ($i = 0; $i < $length; $i++)
            {
                echo "<tr>";
                echo "<td><a href='YellowPageBusiness.php?Id=".$data[$i]['DataId']."'>".$data[$i]['DataId']."</a></td>";
                echo "<td>商業登記</td>";
                echo "<td><a href='YellowPageBusiness.php?Id=".$data[$i]['DataId']."'>".$data[$i]['BusinessName']."</a></td>";
                echo "</tr>";
            }
            break;
        case 'Organization':
            for ($i = 0; $i < $length; $i++)
            {
                echo "<tr>";
                echo "<td><a href='YellowPageOrganization.php?Id=".$data[$i]['DataId']."'>".$data[$i]['DataId']."</a></td>";
                if($data[$i]['Type']== "社會團體")
                    echo "<td>社會團體</td>";
                else
                    echo "<td>職業團體</td>";
                echo "<td><a href='YellowPageOrganization.php?Id=".$data[$i]['DataId']."'>".$data[$i]['Name']."</a></td>";
                echo "</tr>";
            }
            break;
        case 'Fundation':
        for ($i = 0; $i < $length; $i++)
            {
                echo "<tr>";
                echo "<td><a href='YellowPageFundation.php?Id=".$data[$i]['DataId']."'>".$data[$i]['DataId']."</a></td>";
                echo "<td>基金會</td>";
                echo "<td><a href='YellowPageFundation.php?Id=".$data[$i]['DataId']."'>".$data[$i]['Name']."</a></td>";
                echo "</tr>";
            }
        default:
            break;
    }
?>


                </tbody>

              </table>
            <ul class="pager">
                <?
                    switch ($Type) {
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
                /*    $Next = $_GET['start'] + 25;
                    if($_GET['start']!= 0) $Previous = $_GET['start'] - 25;
                    else $Previous = 0;
                    if($_GET['start']==0){
                        echo '<li class="previous disabled"><a href="">&larr; Previous</a></li>';
                        echo '<li class="next"><a href="yellowpage.php?start='.$Next.'&Type='.$Type.'">Next &rarr;</a></li>';
                    }else if($_GET['start'] >= $number_of_rows[$TypeNumber]['Count']/4){
                        echo '<li class="previous"><a href="yellowpage.php?start='.$Previous.'&Type='.$Type.'">&larr; Previous</a></li>';
                        echo '<li class="next disabled"><a href="">Next &rarr;</a></li>';
                    }else{
                        echo '<li class="previous"><a href="yellowpage.php?start='.$Previous.'&Type='.$Type.'">&larr; Previous</a></li>';
                        echo '<li class="next"><a href="yellowpage.php?start='.$Next.'&Type='.$Type.'">Next &rarr;</a></li>';
                    }*/
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
</html>