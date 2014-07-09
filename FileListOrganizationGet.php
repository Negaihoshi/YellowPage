<?php
    
   if(isset($_GET["start"])==true){
        $start = $_GET["start"];
    }else{
        $start = 0;
    }

    $Type = $_GET['Type'];
    switch ($Type) {
        case 'All':
            $Type = "社會團體";
            break;
        case 'Company':
            $Type = "職業團體";
            break;

        default:
            $Type = "All";
            break;
    }

    $db_host = "localhost";
    $db_name = "company";
    $db_user = "root";
    $db_password = "mysql";
    $dsn = "mysql:host=$db_host;dbname=$db_name";
    $dbh = new PDO($dsn, $db_user, $db_password);
    $dbh->query('SET NAMES UTF8');

    if($Type=="All"){
        $sql = "SELECT * FROM `companyIndex` Limit ".$start.",25";
    }else{
        $sql = "SELECT * FROM `companyIndex` WHERE `Type`= '"."$Type"."' Limit ".$start.",25";
    }

    $sth = $dbh->prepare($sql);
    $sth->execute();

    foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $output[]=$row;
    }

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>
