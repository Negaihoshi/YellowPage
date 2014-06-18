<?php
    $link = mysql_connect('localhost', 'root', 'mysql');
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db("company", $link);
    echo 'Connected successfully<br>';

    //mysql_close($link);

    $row = 1;
    if (($handle = fopen("index.csv", "r")) !== FALSE) {
        $defaultSQL = "INSERT INTO companyIndex(Id,Type,Name) VALUES ";
        $fileList =array();
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

            if($row!=1){
                //echo $data[0] . " " . $data[1] . " " . $data[2] . "<br />\n";
                $data[0] = (string)$data[0];
                $data[0] = htmlspecialchars(stripslashes(trim($data[0])), ENT_QUOTES);
                $data[1] = htmlspecialchars(stripslashes(trim($data[1])), ENT_QUOTES);
                $data[2] = htmlspecialchars(stripslashes(trim($data[2])), ENT_QUOTES);
                //if($data[2]=="") echo "<hr>".$data[0].$data[1].$data[2]."<hr>";
                $string = "('".$data[0]."','".$data[1]."','".$data[2]."')";
                array_push($fileList,$string);
                //$sql = "INSERT INTO companyIndex(Id,Type,Name) VALUES ('$data[0]','$data[1]','$data[2]')";
                //mysql_query($sql) or die('<br>Insert data fail: '.mysql_error());
                $count= $row-1;
                if($count % 15000 ==0){
                    //echo implode(",", $fileList);
                    $sql = $defaultSQL.implode(",", $fileList);
                    echo $sql;
                    mysql_query($sql) or die('<br>Insert data fail: '.mysql_error());
                    //echo $sql."<hr>";
                    $fileList =array();
                }
                else if($data[0]=='99999998'){
                    $sql = $defaultSQL.implode(",", $fileList);
                    mysql_query($sql) or die('<br>Insert data fail: '.mysql_error());
                }
                $row+=1;
            }else{
                $row+=1;
            }
        }
        fclose($handle);
    }
?>
