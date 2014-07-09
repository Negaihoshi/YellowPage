<?php
    $db_host = "localhost";
    $db_name = "company";
    $db_user = "root";
    $db_password = "mysql";
    $dsn = "mysql:host=$db_host;dbname=$db_name";
    $dbh = new PDO($dsn, $db_user, $db_password);
    $dbh->query('SET NAMES UTF8');

    $sql = "TRUNCATE TABLE `fundOrganIndex`";
    $sth = $dbh->prepare($sql);
    $sth->execute();


    $fileList =array();
    $row = 1;
    if (($handle = fopen("20140702-social.tsv", "r")) !== FALSE) {
        while ((!feof($handle)) !== FALSE) {
            $line_of_text = fgets($handle);
            if($line_of_text != ""){
                $data = explode("\t", $line_of_text);

                if ($row == 1) {

                }else{
                    $defaultSQL = "INSERT INTO `fundOrganIndex` (`DataId`, `Type`, `Name`) VALUES ";
                    $addSQL = "('". $data[0] ."','". $data[2] ."','". $data[1] ."')";
                    array_push($fileList, $addSQL);
                }
                $row++;
            }
        }
        $sql = $defaultSQL.implode(",", $fileList);
        $sth = $dbh->prepare($sql);
        $sth->execute();

        fclose($handle);
    }


    $fileList =array();
    $row = 1;
    if (($handle = fopen("20140702-professional.tsv", "r")) !== FALSE) {
        while ((!feof($handle)) !== FALSE) {
            $line_of_text = fgets($handle);
            if($line_of_text != ""){
                $data = explode("\t", $line_of_text);

                if ($row == 1) {

                }else{
                    $defaultSQL = "INSERT INTO `fundOrganIndex` (`DataId`, `Type`, `Name`) VALUES ";
                    $addSQL = "('". $data[0] ."','". $data[2] ."','". $data[1] ."')";
                    array_push($fileList, $addSQL);
                }
                $row++;
            }
        }
        $sql = $defaultSQL.implode(",", $fileList);
        $sth = $dbh->prepare($sql);
        $sth->execute();

        fclose($handle);
    }



    $fileList =array();
    $row = 1;
    if (($handle = fopen("fundation.csv", "r")) !== FALSE) {
        while ((!feof($handle)) !== FALSE) {
            $line_of_text = fgets($handle);
            if($line_of_text != ""){
                $data = explode(",", $line_of_text);
                if($data[1]=="") break;
                if ($row == 1) {

                }else{
                    $defaultSQL = "INSERT INTO `fundOrganIndex` (`DataId`, `Type`, `Name`) VALUES ";
                    $addSQL = "('". $data[0] ."','". "基金會" ."','". $data[1] ."')";
                    array_push($fileList, $addSQL);
                }
                $row++;
            }
        }
        $sql = $defaultSQL.implode(",", $fileList);
        $sth = $dbh->prepare($sql);
        $sth->execute();

        fclose($handle);
    }

?>
