<?php 


/**
 *large_area
 東京　Z011
 神奈川　Z012
 埼玉　Z013
 千葉　Z014
 茨木　Z015
 栃木　Z016
 群馬　Z017

 滋賀　Z021
 京都　Z022
 大阪　Z023
 兵庫　Z024
 奈良　Z025
 和歌山　Z026

 岐阜　Z031
 静岡　Z032
 愛知　Z033
 三重　Z034

 北海道　Z041
    
 青森　Z051
 岩手　Z052
 宮城　Z053
 秋田　Z054
 山形　Z055
 福島　Z056

 新潟　Z061
 富山　Z062
 石川　Z063
 福井　Z064
 山梨　Z065
 長野　Z066

 鳥取　Z071
 島根　Z072
 岡山　Z073
 広島　Z074
 山口　Z075

 徳島　Z081
 香川　Z082
 愛媛　Z083
 高知  Z084

 福岡　Z091
 佐賀　Z092
 長崎　Z093
 熊本　Z094
 大分　Z095
 宮崎　Z096
 鹿児島　Z097
 沖縄　Z098
 * 
 */

 /**
  * 県庁所在地の緯度、経度
  北海道,Z041,43.06417,141.34694
  青森　Z051　40.82444,140.74
  岩手　Z052　39.70361,141.1525
  宮城　Z053　38.26889,140.87194
  秋田　Z054　39.71861,140.1025
  山形　Z055　38.24056,140.36333
  福島　Z056　37.75,140.46778
  茨城　Z015　36.34139,140.44667
  栃木　Z016　36.56583,139.88361
  群馬　Z017　Z01736.39111,139.06083
  埼玉　Z013　35.85694,139.64889
  千葉　Z014　35.60472,140.12333
  東京　Z011　35.68944,139.69167
  神奈川　Z012　35.44778,139.6425
  新潟　Z061　37.90222,139.02361
  富山　Z062　36.69528,137.21139
  石川　Z063　36.59444,136.62556
  福井　Z064　36.06528,136.22194
  山梨　Z065　35.66389,138.56833
　長野　Z066　36.65139,138.18111
　岐阜　Z031　35.39111,136.72222
　静岡　Z032　34.97694,138.38306
　愛知　Z033　35.18028,136.90667
　三重　Z034　34.73028,136.50861
　滋賀　Z021　35.00444,135.86833
　京都　Z022　35.02139,135.75556
　大阪　Z023　34.68639,135.52
　兵庫　Z024　34.69139,135.18306
　奈良　Z025　34.68528,135.83278
　和歌山　Z026　34.22611,135.1675
　鳥取　Z071　35.50361,134.23833
　島根　Z072　35.47222,133.05056
　岡山　Z073　34.66167,133.935
　広島　Z074　34.39639,132.45944
　山口　Z075　34.18583,131.47139
　徳島　Z081　34.06583,134.55944
　香川　Z082　34.34028,134.04333
　愛媛　Z083　33.84167,132.76611
　高知　Z084　33.55972,133.53111
　福岡　Z091　33.60639,130.41806
　佐賀　Z092　33.24944,130.29889
　長崎　Z093　32.74472,129.87361
　熊本　Z094　32.78972,130.74167
　大分　Z095　33.23806,131.6125
　宮崎　Z096　31.91111,131.42389
　鹿児島　Z097　31.56028,130.55806
　沖縄　Z098　26.2125,127.68111
  */
//初期変数宣言
$url_000="http://webservice.recruit.co.jp/hotpepper/gourmet/v1/?key=788279bc399948c3&large_area=Z011";


$xml=simplexml_load_file($url_000);
//print_r($xml);

?>

<DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Hot Pepper　レストラン検索</title>
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css">
             <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>

             <style type="text/css">
                #map{
                    height:600px;
                }
             </style>
        
        
        </head>

        <body>
            <h1>Hot Pepper　レストラン検索</h1>
            <form action="" method="post" name="form">
                <p>都道府県を選択してください</p>
                
                <select name="pref">
                   
                    <option value="茨城県">茨城県</option>
                    <option value="栃木県">栃木県</option>
                    <option value="群馬県">群馬県</option>
                    
                    <option value="埼玉県">埼玉県</option>
                    <option value="千葉県">千葉県</option>
                    <option value="東京都">東京都</option>
                    <option value="神奈川県">神奈川県</option>
                    
                </select>
                

                <input type="button" value="レストラン検索">

            </form>

            <!--ボタンがクリックされて、レストラン情報を表示-->
            <ul id="list"></ul>

            <!--ボタンがクリックされて、tableにレストラン情報を表示-->
            <div id="table"></div>

            <!--地図の描画-->
            <div id="map"></div>
        </body>
    </html>
</DOCTYPE>

<script tyep="text/javascript">
    //PHPで読み込んだXMLをjson化して、javascriptに変数を渡す
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
/*
    //1行目のtrタグ要素を作成しtbodyタグ要素に追加
    var tr1=table01.insertRow(0);
    var td1_1=tr1.insertCell(0);
    var td1_2=tr1.insertCell(1);
    var td1_3=tr1.insertCell(2);
    var td1_4=tr1.insertCell(3);

    var td1_5=tr1.insertCell(4);
    var td1_6=tr1.insertCell(5);
    var td1_7=tr1.insertCell(6);
    var td1_8=tr1.insertCell(7);

    var td1_9=tr1.insertCell(8);
    var td1_10=tr1.insertCell(9);
    var td1_11=tr1.insertCell(10);
    var td1_12=tr1.insertCell(11);
    
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
*/
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

mymap.setView([35.681236 , 139.767125], 11);

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