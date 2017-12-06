<?php
header("content-type:text/html;charset=utf-8");

//引入函数 https_request(),get_token()
include("../curl.php");


//获取access_token
 $access_token  = get_token();

 //查询分组链接 $group_url
 $group_url = "https://api.weixin.qq.com/shakearound/device/group/getlist?access_token={$access_token}";
 $group_data = '{
  "begin": 0,
  "count" 10
}';

//通过https_request获取分组信息
$result = https_request($group_url,$group_data);
$group_list = json_decode($result,true);

echo "<ul>";
  foreach($group_list['data']['groups'] as $group)
  echo '<li>'.$group['group_name'].'</li>';
echo "</ul>";
