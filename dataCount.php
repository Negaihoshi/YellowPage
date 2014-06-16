<?
    $db_host = "localhost";
    $db_name = "company";
    $db_user = "root";
    $db_password = "mysql";
    $dsn = "mysql:host=$db_host;dbname=$db_name";
    $dbh = new PDO($dsn, $db_user, $db_password);
    $dbh->query('SET NAMES UTF8');

    $sql = "SELECT COUNT(*) FROM `companyIndex` WHERE `Type`='教育部'";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $number_of_rows = $sth->fetchColumn();

    $sql = "INSERT INTO `dataCount`(`Type`, `Count`) VALUES ('Education',$number_of_rows)";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    echo $number_of_rows;
?>