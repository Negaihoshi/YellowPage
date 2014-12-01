<!DOCTYPE html>
<html lang="zh-tw" ng-app="yellowpage">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <?php
        switch($_GET['Type'])
        {
            case 'All':
                echo "<title>名錄</title>";
                break;

            case 'SubCompany':
                echo "<title>名錄 || ";
                echo $data['SubcompanyName'];
                echo "</title>";
                break;

            case 'Company':
                echo "<title>名錄 || ";
                echo $data['CompanyName'];
                echo "</title>";
                break;

            case 'Business':
                echo "<title>名錄 || ";
                echo $data['BusinessName'];
                echo "</title>";
                break;

            case 'Organization':
                echo "<title>名錄 || ";
                echo $data['Name'];
                echo "</title>";
                break;

            case 'Fundation':
                echo "<title>名錄 || ";
                echo $data['Name'];
                echo "</title>";
                break;
            default:
                echo "<title>名錄</title>";
            break;

        }
    ?>

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
          <form class="navbar-form navbar-left" role="search" method="post" action="Search.php" style="color:white;">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="搜尋" name="inputstring" required>
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
            <button type="submit" class="btn btn-default">查詢</button>
      </form>
        </div>
      </div>
    </div>
