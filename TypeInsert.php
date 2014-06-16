<?php
    $link = mysql_connect('localhost', 'root', 'mysql');
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db("company", $link);
    //echo 'Connected successfully<br>';

    //mysql_close($link);
    $fileList =array();
    $row = 1;
    if (($handle = fopen("TypeCode.csv", "r")) !== FALSE) {
        while ((!feof($handle)) !== FALSE) {
            $line_of_text = fgets($handle);
            if($line_of_text != ""){
                $data = explode(",", $line_of_text);

                if ($row == 1) {
                    echo $data[0]." : ".$data[1]."<br>\n";
                }else{
                    $defaultSQL = "INSERT INTO `companyType` (`TypeCode`, `BigType`, `MidType`, `SmallType`, `TypeName`) VALUES ";
                    preg_match('/^(((\S).)..).+$/', $data[0], $match);
                    $TypeCodeBig = $match[3];
                    $TypeCodeMid = $match[2];
                    $TypeCodeSmall = $match[1];

                    $addSQL = "('". $data[0]."','". $TypeCodeBig ."','". $TypeCodeMid ."','". $TypeCodeSmall ."','". $data[1] ."')";
                    array_push($fileList, $addSQL);

                }
                $row++;
            }
        }
        $sql = $defaultSQL.implode(",", $fileList);
        echo $sql;
        mysql_query($sql) or die('<br>Insert data fail: '.mysql_error());
        fclose($handle);
    }
?>
