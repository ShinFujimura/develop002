
<?php
    //require('index002.php');

    //初期変数宣言
    $url_000="http://webservice.recruit.co.jp/hotpepper/gourmet/v1/?key=788279bc399948c3&large_area=Z011";
    $url_001="http://webservice.recruit.co.jp/hotpepper/gourmet/v1/?key=788279bc399948c3&large_area=";


    //echo "lllfjdfslss";
    //javascriptの都道府県の変数pref_jsをPHPにPOSTで渡してきた
    $pref=$_POST['pref_js'];
    //echo $pref;

    //PHPでjsonファイルを読み込む
    //指定したファイルの要素をすべて取得する
    $json=file_get_contents('json000.json');
    //json形式のデータを連想配列の形にする
    $json=json_decode($json,true);
    //var_dump($json);
    /*
        [
            {"pref":"東京","areacode":"Z011","lat":"35.68944","lng":"139.69167"},
            {"pref":"神奈川","areacode":"Z012","lat":"35.44778","lng":"139.6425"}
        ]
    */
    //echo $json[0]["pref"];

    //プルダウンの都道府県情報=>$jsonと照合して、合致したらareacodeを引き出す
    for($i=0;$i<=1;$i++){
        if($pref==$json[$i]["pref"]){
            $areacode=$json[$i]["areacode"];
        }
    }
    //echo $areacode;
    
    //$largeAreaCode="Z011";
    $largeAreaCode=$areacode;
    //プルダウンで選択した都道府県の情報をWEBApiのURLに反映させる
    $url_002=$url_001.$largeAreaCode;

    //echo $url_002;

    $xml=simplexml_load_file($url_002);

    //var_dump($xml);

    ?> 




