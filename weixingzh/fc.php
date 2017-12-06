<?php
header("content-type:text/html;charset=utf-8");
require("phpanalysis.class.php");


               //实例化分词对象
function fwords($text)
{
  $pa = new PhpAnalysis();
  $pa -> SetSource($text);               //传入分词数据
  $pa -> resultType = 2;                 //指定分词返回类型
  $pa -> differMax = true;               //是否优化分词结果
  $pa -> StartAnalysis();                //开始分词
  $result = $pa -> GetFinallyResult();   //获取分词结果，字符串
  //$arr = explode(' ',$result);           //字符串转化为数组
  return trim($result);
}


//获取天气数据
function getWeather($city)
{

  //获取一个curl资源
    $ch = curl_init();

  //设置相关参数
    curl_setopt($ch,CURLOPT_URL,"http://www.sojson.com/open/api/weather/json.shtml?city={$city}");

    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

  //获取html结果
    $output = curl_exec($ch);
  //释放curl句柄
    curl_close($ch);
  //打印获取的信息
  $output = json_decode($output,true);
  return $output;

}
  //$result =  getWeather("北京");
  //echo $result['date']."<br>";
  //echo $result['data']['quality']."<br>";
  //echo $result['data']['yesterday']['date']."<br>";
  //echo $result['data']['forecast']['0']['date']."<br>";
//数据库链接查询城市
//function getcity($arr)
//{
//  require("connect.php");
//  mysql_query("set names utf8");
//  $city = "";
//  foreach($arr as $vo)
//  $city .= "'".$vo."',";
//  $city = rtrim($city,",");
//  //in('北京','上海','广州')
//  $sql = "select name from city where name in({$city})";
//  if($result = mysql_query($sql))
//  {
//    while($raw = mysql_fetch_array($result))
//    $contentStr[] = $raw['name'];
//  } else {
//    $contentStr = "暂时无法找到该城市~~";
//  }
//  mysql_query($con);
//  return $contentStr;
//
//}
