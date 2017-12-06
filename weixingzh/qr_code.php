<?php

include "curl.php";


$access_token = get_token();

//二维码ticket接口
$ticket_url = " https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={$access_token}";

//二维码参数
$qr_data = '{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": 1}}}';

$result = https_request($ticket_url,$qr_data);
$ticket = json_decode($result,true);

//获取二维码图片
$qr_code = get_qr_code($ticket['ticket']);

function get_qr_code($ticket)
{
  //获取qr_code接口
  $qr_url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket={UrlEncode($ticket)}";

  //初始化curl资源
  $curl = curl_init();

  //curl参数设置
  curl_setopt($curl,CURLOPT_URL,$qr_url);
  curl_setopt($curl,CURLOPT_HEADER,0);
  curl_setopt($curl,CURLOPT_NOBODY,0);
  curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

  //获取curl结果
  $result = curl_exec($curl);

  //定义二维码文件名
  $filename = "QR_Code.jpg";

  //写入二维码数据
  file_put_contents($filename,$result);

}

echo '<img src="QR_Code.jpg">';
