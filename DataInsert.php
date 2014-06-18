<?php
    $link = mysql_connect('localhost', 'root', 'mysql');
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db("company", $link);
    //echo 'Connected successfully<br>';

    //mysql_close($link);

    $count = 1;
    $fileList =array();
    if (($handle = fopen("00000000.json", "r")) !== FALSE) {
        while(!feof($handle)){
            $line_of_text = fgets($handle);
            if($line_of_text=="") continue;
            $defaultSQL = "INSERT INTO `companyData`(
                `Id`, `CompanyType`, `CompanyName`, `AssetAmount`, `Leader`, `CompanyAddress`, `Government`,
                `AccessTime`, `LastChangeTime`, `Business`, `Director`, `ManagerList`, `StopDateFrom`, `StopDateTo`) VALUES ";

            //拆開統一編號跟資料
            preg_match('/^(\d{8}),({.+})$/', $line_of_text, $match);
            $data = json_decode($match[2], true);

            echo $match[1]."<br>\n";

            //公司
            if(isset($data['公司狀況']) && $data['公司狀況']=='核准設立'){
                //print_r($data);
                //格式化時間
                $AccessTime = $data['核准設立日期']['year']."/".$data['核准設立日期']['month']."/".$data['核准設立日期']['day'];
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                if(empty($data['停業日期(起)'])){
                    $data['停業日期(起)']=NULL;
                }
                if(empty($data['停業日期(迄)'])){
                    $data['停業日期(迄)']=NULL;
                }
                //將多行人的資料轉成 JSON 陣列
                $Director = json_encode($data['董監事名單'], JSON_UNESCAPED_UNICODE);
                $ManagerList = json_encode($data['經理人名單'], JSON_UNESCAPED_UNICODE);

                array_push($fileList, $match[1], $data['公司狀況'], $data['公司名稱'], $data['資本總額(元)'],
                    $data['代表人姓名'], $data['公司所在地'], $data['登記機關'], $AccessTime, $LastChangeTime, $Director, $ManagerList, $data['停業日期(起)'], $data['停業日期(迄)']);
                print_r($fileList);
                //print_r($fileList);
                //echo "<hr>";
                //Append 用後清除
                $fileList = array();
            }else if(isset($data['公司狀況']) && $data['公司狀況']=='解散'){
                //print_r($data);
                //格式化時間
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['公司狀況']) && $data['公司狀況']=='撤銷'){
                //print_r($data);
                //格式化時間
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['公司狀況']) && $data['公司狀況']=='核准設立，但已命令解散'){
                //print_r($data);
                //格式化時間
                $AccessTime = $data['核准設立日期']['year']."/".$data['核准設立日期']['month']."/".$data['核准設立日期']['day'];
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['公司狀況']) && $data['公司狀況']=='撤銷已清算完結'){
                //print_r($data);
                //格式化時間
                $AccessTime = $data['核准設立日期']['year']."/".$data['核准設立日期']['month']."/".$data['核准設立日期']['day'];
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['公司狀況']) && $data['公司狀況']=='撤回認許'){
                //print_r($data);
                //格式化時間
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['公司狀況']) && $data['公司狀況']=='解散已清算完結'){
                //print_r($data);
                //格式化時間
                $AccessTime = $data['核准設立日期']['year']."/".$data['核准設立日期']['month']."/".$data['核准設立日期']['day'];
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['公司狀況']) && $data['公司狀況']=='接管'){
                //print_r($data);
                //格式化時間
                $AccessTime = $data['核准設立日期']['year']."/".$data['核准設立日期']['month']."/".$data['核准設立日期']['day'];
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['公司狀況']) && $data['公司狀況']=='撤回認許已清算完結'){
                //print_r($data);
                //格式化時間
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['公司狀況']) && $data['公司狀況']=='撤銷認許已清算完結'){
                //print_r($data);
                //格式化時間
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['公司狀況']) && $data['公司狀況']=='破產'){
                //print_r($data);
                //格式化時間
                $AccessTime = $data['核准設立日期']['year']."/".$data['核准設立日期']['month']."/".$data['核准設立日期']['day'];
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['公司狀況']) && $data['公司狀況']=='重整'){
                //print_r($data);
                //格式化時間
                $AccessTime = $data['核准設立日期']['year']."/".$data['核准設立日期']['month']."/".$data['核准設立日期']['day'];
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['公司狀況']) && $data['公司狀況']=='核准認許'){
                //print_r($data);
                //格式化時間
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['公司狀況']) && $data['公司狀況']=='廢止認許'){
                //print_r($data);
                //格式化時間
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['公司狀況']) && $data['公司狀況']=='廢止'){
                //print_r($data);
                //格式化時間
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['公司狀況']) && $data['公司狀況']=='廢止已清算完結'){
                //print_r($data);
                //格式化時間
                $AccessTime = $data['核准設立日期']['year']."/".$data['核准設立日期']['month']."/".$data['核准設立日期']['day'];
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['公司狀況']) && $data['公司狀況']=='核准報備'){
                //print_r($data);
                //格式化時間
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['公司狀況']) && $data['公司狀況']=='合併解散'){
                //print_r($data);
                //格式化時間
                $AccessTime = $data['核准設立日期']['year']."/".$data['核准設立日期']['month']."/".$data['核准設立日期']['day'];
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['分公司名稱'])  && $data['分公司狀況']=='核准設立'){
                //print_r($data);
                //格式化時間
                $AccessTime = $data['核准設立日期']['year']."/".$data['核准設立日期']['month']."/".$data['核准設立日期']['day'];
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['分公司名稱'])  && $data['分公司狀況']=='撤銷'){
                //print_r($data);
                //格式化時間
                $AccessTime = $data['核准設立日期']['year']."/".$data['核准設立日期']['month']."/".$data['核准設立日期']['day'];
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['分公司名稱'])  && $data['分公司狀況']=='廢止'){
                //print_r($data);
                //格式化時間
                $AccessTime = $data['核准設立日期']['year']."/".$data['核准設立日期']['month']."/".$data['核准設立日期']['day'];
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['商業名稱']) && $data['現況']=='核准設立'){
                //print_r($data);
                //格式化時間
                $AccessTime = $data['核准設立日期']['year']."/".$data['核准設立日期']['month']."/".$data['核准設立日期']['day'];
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['商業名稱']) && $data['現況']=='歇業'){
                //print_r($data);
                //格式化時間
                $AccessTime = $data['核准設立日期']['year']."/".$data['核准設立日期']['month']."/".$data['核准設立日期']['day'];
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else if(isset($data['商業名稱']) && $data['現況']=='核准停業'){
                //print_r($data);
                //格式化時間
                $AccessTime = $data['核准設立日期']['year']."/".$data['核准設立日期']['month']."/".$data['核准設立日期']['day'];
                if(!empty($data['最後核准變更日期']['year'])){
                    $LastChangeTime = $data['最後核准變更日期']['year']."/".$data['最後核准變更日期']['month']."/".$data['最後核准變更日期']['day'];
                }else{
                    $LastChangeTime = "";
                }
                //echo $LastChangeTime;
                //echo $AccessTime;
                //echo "<hr>";
            }else {
                echo "統一編號=>".$match[1]."資料=>".$match[2];
                echo "<hr>";
            }
            //Debug 用
            //$count++;
            //if($count ==5000) break;
        }



        //echo $match[2];
    }
    fclose($handle);
?>
