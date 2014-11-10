<?php
    /*
    $link = mysql_connect('localhost', 'root', 'mysql');
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db("company", $link);


    //mysql_close($link);
    $sql = "SELECT * FROM companyIndex";
    $result = mysql_query($sql) or die('<br>Insert data fail: '.mysql_error());
    while($r = mysql_fetch_assoc($result)){
        $output[] = $r;
    }
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    */
    if(isset($_GET["start"])==true){
        $start = $_GET["start"];
    }else{
        $start = 0;
    }

    $Type = $_GET['Type'];
    switch ($Type) {
        case 'All':
            $Type = "All";
            break;
        case 'Company':
            $Type = "公司";
            break;
        case 'SubCompany':
            $Type = "分公司";
            break;
        case 'Else':
            $Type = "其他";
            break;
        case 'Business':
            $Type = "商業登記";
            break;
        case 'Education':
            $Type = "教育部";
            break;
        case 'Organization':
            $Type = "Organization";
            $TypeResult = "`Type`="."'職業團體'"." OR "."`Type`="."'社會團體'";
            break;
        case 'Fundation':
            $Type = "Fundation";
            $TypeResult = "`Type`="."'基金會'";
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
    }else if($Type=="Fundation"){
        $sql = "SELECT `DataId`, `Name` FROM `fundationData`  Limit ".$start.",25";
    }else if($Type=="Organization"){
        $sql = "SELECT `DataId`, `Type`, `Name` FROM `organizationData`  Limit ".$start.",25";
    }else{
        $sql = "SELECT * FROM `companyIndex` WHERE `Type`= '"."$Type"."' Limit ".$start.",25";
    }

    $sth = $dbh->prepare($sql);
    $sth->execute();

    foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $output[]=$row;
    }

    //print_r($output);
    print_r(json_encode($output));
    //echo json_encode($output, JSON_UNESCAPED_UNICODE);
/*
    $result = $sth->fetch(PDO::FETCH_OBJ);
    echo $result->name . $result->location;

    $dbh = NULL;
*/

//."AND".`Type`="職業團體"."' Limit ".$start.",25"
?>