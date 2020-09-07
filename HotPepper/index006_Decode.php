<?php 

//初期変数宣言
$url_000="http://webservice.recruit.co.jp/hotpepper/gourmet/v1/?key=788279bc399948c3&large_area=Z011";
$url_001="http://webservice.recruit.co.jp/hotpepper/gourmet/v1/?key=788279bc399948c3&large_area=";


?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Hot Pepper　レストラン検索</title>
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css">
             <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>
             <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
             <style type="text/css">
                #map{
                    height:600px;
                }
             </style>
        
        
        </head>

        <body>
            <h1>Hot Pepper　レストラン検索&地図</h1>
            <form action="" method="post" name="form">
                <p>都道府を選択してください</p>
                
                <select name="pref">
                   
                <option value="北海道">北海道</option>
			<option value="青森">青森</option>
			<option value="岩手">岩手</option>
			<option value="宮城">宮城</option>
			<option value="秋田">秋田</option>
			
			<option value="山形">山形</option>
			<option value="福島">福島</option>
			<option value="茨城">茨城</option>
			<option value="栃木">栃木</option>
			<option value="群馬">群馬</option>
			
			<option value="埼玉">埼玉</option>
			<option value="千葉">千葉</option>
			<option value="東京">東京</option>
            <option value="神奈川">神奈川</option>
			<option value="新潟">新潟</option>
			<option value="富山">富山</option>
			
			<option value="石川">石川</option>
			<option value="福井">福井</option>
			<option value="山梨">山梨</option>
			<option value="長野">長野</option>
			<option value="岐阜">岐阜</option>
			
			<option value="静岡">静岡</option>
			<option value="愛知">愛知</option>
			<option value="三重">三重</option>
			<option value="滋賀">滋賀</option>
			<option value="京都">京都</option>
			
			<option value="大阪">大阪</option>
			<option value="兵庫">兵庫</option>
			<option value="奈良">奈良</option>
			<option value="和歌山">和歌山</option>
			<option value="鳥取">鳥取</option>
			
			<option value="島根">島根</option>
			<option value="岡山">岡山</option>
			<option value="広島">広島</option>
			<option value="山口">山口</option>
			<option value="徳島">徳島</option>
			
			<option value="香川">香川</option>
			<option value="愛媛">愛媛</option>
			<option value="高知">高知</option>
			<option value="福岡">福岡</option>
			<option value="佐賀">佐賀</option>
			
			<option value="長崎">長崎</option>
			<option value="熊本">熊本</option>
			<option value="大分">大分</option>
			<option value="宮崎">宮崎</option>
			<option value="鹿児島">鹿児島</option>
			
			<option value="沖縄">沖縄</option>
                    
                </select>
                

                <input type="submit" value="レストラン検索">

            </form>

            <!--ボタンがクリックされて、レストラン情報を表示-->
            <ul id="list"></ul>

            <!--ボタンがクリックされて、tableにレストラン情報を表示-->
            <div id="table"></div>

            <!--地図の描画-->
            <div id="map"></div>
        </body>
    </html>

<script type="text/javascript">
//ボタンクリックで反応


    //javascritpでのプルダウンメニューの都道府名の取得
    //参考サイト
    //https://qiita.com/glaytomohiko/items/03569ca138bbee015ff3
    var pullSellect=document.form.pref.selectedIndex;
    var pref_js=document.form.pref.options[pullSellect].value;
    //console.log(pref_js);
   
    <?php
        
        $pref=$_POST['pref'];
        //echo $pref;

        //PHPでjsonファイルを読み込む
        //指定したファイルの要素をすべて取得する
        $json=file_get_contents('json001.json');
        //json形式のデータを連想配列の形にする
        $json=json_decode($json,true);
       

    //プルダウンの都道府情報=>$jsonと照合して、合致したらareacodeを引き出す
    
    for($i=0;$i<46;$i++){
        if($pref==$json[$i]["pref"]){
            $areacode=$json[$i]["areacode"];
            $lat=$json[$i]["lat"];
            $lng=$json[$i]["lng"];
        }
    }
    //echo $areacode;
    
        //$largeAreaCode="Z011";
        $largeAreaCode=$areacode;
       $url_002=$url_001.$largeAreaCode;

        //require('check.php');
        $xml=simplexml_load_file($url_002);
    ?>


    
    //⓵WEB APIをPHPで読み込んだXMLをjson化して、javascriptに変数を渡す
    var xml_j=<?php echo json_encode($xml);?>;
    //console.log(xml_j);

    

    //変数初期宣言
    var shop_name=new Array(100);
    var address=new Array(100);
    var station_name=new Array(100);
    var lat=new Array(100);
    var lng=new Array(100);
    var menu=new Array(100);
    var catch_copy=new Array(100);
    var price=new Array(100);
    var description=new Array(100);
    var access=new Array(100);
    var open=new Array(100);
    var photo=new Array(100);

    //console.log(xml_j.shop[i-1].name);
    //console.log(xml_j.shop.length);

    for(i=0; i<xml_j.shop.length; i++){
        shop_name[i]=xml_j.shop[i].name;
            //console.log(shop_name[i]);
        address[i]=xml_j.shop[i].address;
            //console.log(address[i]);
        station_name[i]=xml_j.shop[i].station_name;
            //console.log(station_name[i]);
        lat[i]=xml_j.shop[i].lat;
           // console.log(lat[i]);
        lng[i]=xml_j.shop[i].lng;
            //console.log(lng[i]);

        menu[i]=xml_j.shop[i].genre.name;
           // console.log(menu[i]);
        catch_copy[i]=xml_j.shop[i].genre.catch;
            //console.log(catch_copy[i]);
        price[i]=xml_j.shop[i].budget.name;
            //console.log(price[i]);
        description[i]=xml_j.shop[i].budget.average;
            //console.log(description[i]);
        access[i]=xml_j.shop[i].access;
            //console.log(access[i]);

        open[i]=xml_j.shop[i].open;
            //console.log(open[i]);
        photo[i]=xml_j.shop[i].photo.pc.l;
            //console.log(photo[i]);
    }

/**********テーブル表示 */
//参考サイト　http://titi-fe.hatenablog.com/entry/2016/02/15/152723
    var table01=document.createElement("table");
    table01.border="1";

    //tbodyタグを生成してtableタグ要素に追加
    var tbody=document.createElement('tbody');
    table01.appendChild(tbody);

    for(var i=1; i<=xml_j.shop.length; i++){

        var tr='tr'+i;

        var tr=table01.insertRow(i-1);

    var td1_1=tr.insertCell(0);
    var td1_2=tr.insertCell(1);
    var td1_3=tr.insertCell(2);
    var td1_4=tr.insertCell(3);

    var td1_5=tr.insertCell(4);
    var td1_6=tr.insertCell(5);
    var td1_7=tr.insertCell(6);
    var td1_8=tr.insertCell(7);

    var td1_9=tr.insertCell(8);
    var td1_10=tr.insertCell(9);
    var td1_11=tr.insertCell(10);
    var td1_12=tr.insertCell(11);
    
    td1_1.appendChild(document.createTextNode(shop_name[i-1]));
    td1_2.appendChild(document.createTextNode(address[i-1]));
    td1_3.appendChild(document.createTextNode(station_name[i-1]));
    td1_4.appendChild(document.createTextNode(lat[i-1]));

    td1_5.appendChild(document.createTextNode(lng[i-1]));
    td1_6.appendChild(document.createTextNode(menu[i-1]));
    td1_7.appendChild(document.createTextNode(catch_copy[i-1]));
    td1_8.appendChild(document.createTextNode(price[i-1]));

    td1_9.appendChild(document.createTextNode(description[i-1]));
    td1_10.appendChild(document.createTextNode(access[i-1]));
    td1_11.appendChild(document.createTextNode(open[i-1]));
    //URLから画像の表示
	//参考サイト　https://hakuhin.jp/js/image.html#IMAGE_01
    var image=new Image();
    image.src=photo[i-1];
    td1_12.appendChild(image);

    }

    document.getElementById('table').appendChild(table01);


/*********地図の描画 */
//参考サイトhttp://www.nowhere.co.jp/blog/archives/20180705-160052.html

var mymap = L.map('map');

L.tileLayer('https://cyberjapandata.gsi.go.jp/xyz/std/{z}/{x}/{y}.png', {
  maxZoom: 18,
  attribution: '<a href="https://maps.gsi.go.jp/development/ichiran.html" target="_blank">国土地理院</a>',
}).addTo(mymap);

var center_lat=<?php echo json_encode($lat);?>;
var center_lng=<?php echo json_encode($lng);?>;

console.log(center_lat);
console.log(center_lng);

//mymap.setView([35.681236 , 139.767125], 11);
mymap.setView([center_lat,center_lng],11);
mymap.once('focus',function(){mymap.scrollWheelZoom.disable();});

//マーカのアイコンを作成
var markerIcon=L.icon({
    iconUrl: 'http://www.nowhere.co.jp/blog/wp-content/uploads/2018/07/marker.png', // アイコン画像のURL
    iconSize:     [32, 32], // アイコンの大きさ
    iconAnchor:   [16, 32], // 画像内でマーカーの位置を指し示す点の位置
    popupAnchor:  [0, -32]
})

//マーカを作成
var marker1=L.marker([lat[0] , lng[0]],{icon: markerIcon}).addTo(mymap);

//クリックした時のポップアップメッセージを表示する
marker1.bindPopup(shop_name[0]);

for(var i=1;i<=xml_j.shop.length;i++){

    var marker='marker'+i;
    //マーカを作成
    var marker=L.marker([lat[i-1] , lng[i-1]],{icon: markerIcon}).addTo(mymap);

    //クリックした時のポップアップメッセージを表示する
    marker.bindPopup('No'+i+' '+shop_name[i-1]);
}


</script>