<?
    $ID = $_GET["Id"];
    $db_host = "localhost";
    $db_name = "company";
    $db_user = "root";
    $db_password = "mysql";
    $dsn = "mysql:host=$db_host;dbname=$db_name";
    $dbh = new PDO($dsn, $db_user, $db_password);
    $dbh->query('SET NAMES UTF8');

    $sql = "SELECT * FROM `organizationData` WHERE `DataId`=".$ID;

    $sth = $dbh->prepare($sql);
    $sth->execute();
    $data = $sth->fetch(PDO::FETCH_ASSOC);

?>
<?php
    include("YellowpageHeader.php");
?>
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
                    <td>編號</td>
                    <td><?echo $data['DataId'];?></td>
                  </tr>
                  <tr>
                    <td>名稱</td>
                    <td><?echo $data['Name'];?></td>
                  </tr>
                  <tr>
                    <td>分類</td>
                    <td><?echo $data['Type'];?></td>
                  </tr>
                  <tr>
                    <td>子分類</td>
                    <td><?echo $data['SubType'];?></td>
                  </tr>
                  <tr>
                    <td>會長頭銜</td>
                    <td><?echo $data['JobTitle'];?></td>
                  </tr>
                  <tr>
                    <td>會長名稱</td>
                    <td><?echo $data['Leader'];?></td>
                  </tr>
                  <tr>
                    <td>成立日期</td>
                    <td><?echo $data['CreateDate'];?></td>
                  </tr>
                  <tr>
                    <td>電話</td>
                    <td><?echo $data['Phone'];?></td>
                  </tr>
                  <tr>
                    <td>核准立案字號</td>
                    <td><?echo $data['GovId'];?></td>
                  </tr>
                  <tr>
                    <td>會址</td>
                    <td><?echo $data['Address'];?></td>
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
    <script>
            $(function(){
                $('#optradio').val('1');
                $('#option1').val('2');
                $('input[name="optradio"][value="1"]').prop("checked",true);
                $('input[name="option1"][value="2"]').prop("checked",true);
                $('#option2').hide();
            });
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
