<?php
$apiKey = 'AIzaSyA_S7IN7rgKsEKwGte5eFXpP57Xeu-cJnc';
$file = file_get_contents('001.png');

//APIに送りつけるパラメータの設定
$json = json_encode([
  "requests" => [
    [ "image"   => [ "content" => base64_encode(file_get_contents($file)), ],
      "features" => [ [ "type" => "TEXT_DETECTION", "maxResults" => 10, ], ],
    ],
  ],
]);

// 各種オプションを設定
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://vision.googleapis.com/v1/images:annotate?key=" . $apiKey);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
curl_setopt($curl, CURLOPT_TIMEOUT, 15);
curl_setopt($curl, CURLOPT_POSTFIELDS, $json);

//curlの実行
$res = curl_exec($curl);
//取得データの配列化
$data = json_decode($res, true);

print_r($data, true);


