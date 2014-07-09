<?php
    
    if(isset($_GET["start"])==true){
        $start = $_GET["start"];
    }else{
        $start = 0;
    }

    //$Type = $_GET['Type'];
    

    $db_host = "localhost";
    $db_name = "company";
    $db_user = "root";
    $db_password = "mysql";
    $dsn = "mysql:host=$db_host;dbname=$db_name";
    $dbh = new PDO($dsn, $db_user, $db_password);
    $dbh->query('SET NAMES UTF8');

    $sql = "SELECT `DataId`, `Name` FROM `fundationData` WHERE 1".$start.",25";
    $Type = "Fundation";


    $sth = $dbh->prepare($sql);
    $sth->execute();

    foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $output[]=$row;
    }

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
/*
    $result = $sth->fetch(PDO::FETCH_OBJ);
    echo $result->name . $result->location;

    $dbh = NULL;
*/
?>
