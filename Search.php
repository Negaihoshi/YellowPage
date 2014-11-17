<?php
    $db_host = "localhost";
    $db_name = "company";
    $db_user = "root";
    $db_password = "mysql";
    $dsn = "mysql:host=$db_host;dbname=$db_name";
    $dbh = new PDO($dsn, $db_user, $db_password);
    $dbh->query('SET NAMES UTF8');

$TypeNumber = $_POST['optradio'];
$v = $_POST['inputstring'];
$option1 = $_POST['option1'];
$option2 = $_POST['option2'];
$flag = $_POST['flag'];

$Type = "";
$data = array();

switch($TypeNumber) {
    case '1':
        $Type = 'Company';
        $sql = "SELECT * FROM `companyData`";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        while($number_of_rows = $sth->fetch(PDO::FETCH_ASSOC))
        {
            if($flag == 0)
            {
                switch($option1)
                {
                    case '1':
                        if(strpos($number_of_rows['Id'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                    case '2':
                        if(strpos($number_of_rows['CompanyName'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    case '3':
                        if(strpos($number_of_rows['CompanyAddress'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    default:
                        break;
                }
            }
            else
                break;
        }

        if(isset($Type)== false)
            $Type = 'Company';
        break;
    case '2':
        $Type = 'SubCompany';
        $sql = "SELECT * FROM `subcompanyData`";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        while($number_of_rows = $sth->fetch(PDO::FETCH_ASSOC))
        {
            if($flag == 0)
            {
                switch($option1)
                {
                    case '1':
                        if(strpos($number_of_rows['DataId'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                    case '2':
                        if(strpos($number_of_rows['SubcompanyName'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    case '3':
                        if(strpos($number_of_rows['SubcompanyAddress'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    default:
                        break;
                }
            }
            else
                break;
        }

        if(isset($Type)== false)
            $Type = 'SubCompany';
        break;
    case '3':
        $Type = 'Business';
        $sql = "SELECT * FROM `businessData`";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        while($number_of_rows = $sth->fetch(PDO::FETCH_ASSOC))
        {
            if($flag == 0)
            {
                switch($option1)
                {
                    case '1':
                        if(strpos($number_of_rows['DataId'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                    case '2':
                        if(strpos($number_of_rows['BusinessName'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    case '3':
                        if(strpos($number_of_rows['BusinessAddress'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    default:
                        break;
                }
            }
            else
                break;
        }

        if(isset($Type)== false)
            $Type = 'Business';
        break;
    case '4':
        $Type = 'Organization';
        $sql = "SELECT * FROM `organizationData`";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        while($number_of_rows = $sth->fetch(PDO::FETCH_ASSOC))
        {
            if($flag == 1)
            {
                switch($option2)
                {
                    case '1':
                        if(strpos($number_of_rows['Name'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    case '2':
                        if(strpos($number_of_rows['Address'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    default:
                        break;
                }
            }
            else
                break;
        }

        if(isset($Type)== false)
            $Type = 'Organization';
        break;
    case '5':
        $Type = 'Fundation';
        $sql = "SELECT * FROM `fundationData`";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        while($number_of_rows = $sth->fetch(PDO::FETCH_ASSOC))
        {
            if($flag == 1)
            {
                switch($option2)
                {
                    case '1':
                        if(strpos($number_of_rows['Name'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    case '2':
                        if(strpos($number_of_rows['Address_1'], $v) !== false || strpos($number_of_rows['Address_2'], $v) !== false)
                        {
                            array_push($data, $number_of_rows);
                        }
                        break;
                    default:
                        break;
                }
            }
            else
                break;
        }

        if(isset($Type)== false)
            $Type = 'Fundation';
        break;
    default:
        break;
}

/*switch($TypeNumber)
{
    case '1':
        print_r($data);
        break;
    case '2':
        print_r($data);
        break;
    case '3':
        print_r($data);
        break;
    case '4':
        print_r($data);
        break;
    case '5':
        print_r($data);
        break;
    default:
        break;
}*/
//print_r($data[0]['Name']);
//print_r($data[3]['BusinessName']);
//print_r($data[2]['SubcompanyName']);
//print_r($data[0]['CompanyName']);


?>