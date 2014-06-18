<?
    $db_host = "localhost";
    $db_name = "company";
    $db_user = "root";
    $db_password = "mysql";
    $dsn = "mysql:host=$db_host;dbname=$db_name";
    $dbh = new PDO($dsn, $db_user, $db_password);
    $dbh->query('SET NAMES UTF8');

    $sql = "TRUNCATE TABLE `companyCount`";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    echo "Table Truncate......."."<br>\n";

    echo "All Data Counting......."."<br>\n";
    $sql = "SELECT COUNT(*) FROM `companyIndex`";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $number_of_rows = $sth->fetchColumn();

    $sql = "INSERT INTO `companyCount`(`Type`, `Count`) VALUES ('All',$number_of_rows)";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    echo $number_of_rows."<br>\n";

    $TypeList = array('公司','分公司','商業登記','教育部','其他');
    $NameList = array('Company','SubCompany','Business','Education','Else');
    for ($count=0; $count < 5; $count++) {

        echo $NameList[$count]." Data Counting......."."<br>\n";
        $sql = "SELECT COUNT(*) FROM `companyIndex` WHERE `Type`='".$TypeList[$count]."'";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $number_of_rows = $sth->fetchColumn();

        $sql = "INSERT INTO `companyCount`(`Type`, `Count`) VALUES ('".$NameList[$count]."',$number_of_rows)";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        echo $number_of_rows."<br>\n";

    }

?>