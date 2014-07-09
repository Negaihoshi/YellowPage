<?php
    $link = mysql_connect('localhost', 'root', 'mysql');
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db("company", $link);
    //echo 'Connected successfully<br>';

    $sql = "TRUNCATE TABLE `organizationData`";
    mysql_query($sql) or die('<br>Insert data fail: '.mysql_error());

    $fileList =array();
    $row = 1;
    $title;
    $data;
    $sql;
    if (($handle = fopen("20140702-social.tsv", "r")) !== FALSE) {
        while ((!feof($handle)) !== FALSE) {
            $line_of_text = fgets($handle);
            if($row==1){
                $title = explode("\t",$line_of_text);
                $row++;
            }else if($line_of_text!= ""){
                $data = explode("\t",$line_of_text);
                $defaultSQL = "INSERT INTO `organizationData` (`Name`, `Type`, `SubType`, `JobTitle`, `Leader`, `CreateDate`, `Phone`, `GovId`, `Address`) VALUES ";
                $addSQL = "('". $data[1] ."','". $data[2] ."','". $data[3] ."','". $data[4] ."','". $data[5]."','". $data[6] ."','". $data[7] ."','". $data[8] ."','". $data[9] ."')";
                array_push($fileList, $addSQL);
                $row++;
                if($row%100==0) {
                    $sql = $defaultSQL.implode(",", $fileList);
                    $fileList =array();
                    mysql_query($sql) or die('<br>Insert data fail: '.mysql_error());
                }else if($data[0]==14096){
                    $sql = $defaultSQL.implode(",", $fileList);
                    $fileList =array();
                    mysql_query($sql) or die('<br>Insert data fail: '.mysql_error());
                }
            }
        }

        fclose($handle);
    }
    $row=1;
    if (($handle = fopen("20140702-professional.tsv", "r")) !== FALSE) {
        while ((!feof($handle)) !== FALSE) {
            $line_of_text = fgets($handle);
            if($row==1){
                $title = explode("\t",$line_of_text);
                $row++;
            }else if($line_of_text!= ""){
                $data = explode("\t",$line_of_text);
                $defaultSQL = "INSERT INTO `organizationData` (`Name`, `Type`, `SubType`, `JobTitle`, `Leader`, `CreateDate`, `Phone`, `GovId`, `Address`) VALUES ";
                $addSQL = "('". $data[1] ."','". $data[2] ."','". $data[3] ."','". $data[4] ."','". $data[5]."','". $data[6] ."','". $data[7] ."','". $data[8] ."','". $data[9] ."')";
                array_push($fileList, $addSQL);

                $sql = $defaultSQL.implode(",", $fileList);
                $fileList =array();
                mysql_query($sql) or die('<br>Insert data fail: '.mysql_error());
            }
        }

        fclose($handle);
    }
    //mysql_close($link);
?>
