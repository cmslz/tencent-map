# PHP腾讯地图
> 腾讯地图文档
# 示例
```PHP
$app = new \Cmslz\TencentMap\Application('54YBZ-L4RCX-GMP4X-ZZWPY-ZUWPJ-5JB2X');
//$result = $app->webServerApi()->locationSearch('颐和园', 'region(北京,0)', ['page_size' => 20]);
//$result = $app->webServerApi()->locationSearchByExplore('nearby(40.040394,116.273523,1000)',['page_size' => 20, 'policy' => 1]);
//$result = $app->webServerApi()->locationSearchByDetailId(6621879543162709731);
//$result = $app->webServerApi()->suggestion('北京', ['keyword' => '美食']);
//$result = $app->webServerApi()->inverseAddress('39.984154,116.307490', ['get_poi' => 1]);
//$result = $app->webServerApi()->addressResolution('北京市海淀区彩和坊路海淀西大街74号');
//$result = $app->webServerApi()->smartAddress('北京市海淀区彩和坊路海淀西大街74号张三丰13666665254', ['region' => '北京']);
//$result = $app->webServerApi()->truthAnaly('广东佛山市高明区杨和镇广东省佛山市高明区杨和镇杨梅村桃花街2号科顺建筑材料有限公司');
//$result = $app->webServerApi()->addressComplete('北京市朝阳区平房镇青年路1号北京市朝阳区平房乡姚家园村民委');
//$result = $app->webServerApi()->abnormalAnaly('北京市朝阳区平房镇青年路1号北京市朝阳区平房乡姚家园村民委');
//$result = $app->webServerApi()->nameAddressAnaly('海龙大厦','北京市海淀区北四环西路66号');
//$result = $app->webServerApi()->placeAnaly('青浦区朱家角镇沙家埭路88号');
//$result = $app->webServerApi()->placeAnaly('', '31.102344,121.043075');
//$result = $app->webServerApi()->placeAnaly('青浦区朱家角镇沙家埭路88号', '31.102344,121.043075');
//$result = $app->webServerApi()->directionDriving('39.915285,116.403857','39.915285,116.803857');
//$result = $app->webServerApi()->directionWalking('39.915285,116.403857','39.915285,116.803857');
//$result = $app->webServerApi()->directionBicycling('39.915285,116.403857','39.915285,116.803857');
//$result = $app->webServerApi()->directionEbicycling('39.915285,116.403857','39.915285,116.803857');
//$result = $app->webServerApi()->directionTransit('39.915285,116.403857','39.915285,116.803857');
//$result = $app->webServerApi()->distanceMatrix('driving', '39.915285,116.403857', '39.915285,116.803857');
//$result = $app->webServerApi()->directionTrucking('39.915285,116.403857', '39.915285,116.803857', 2, 2, 2.1, 2.3, 2, 2, 0);
//$result = $app->webServerApi()->districtList();
//$result = $app->webServerApi()->districtGetChildren(713206);
//$result = $app->webServerApi()->districtSearch('青浦区朱家角镇沙家埭路88号');
//$result = $app->webServerApi()->coordTranslate('39.12,116.83;30.21,115.43', 3);
$result = $app->webServerApi()->ip('111.206.145.41');
//$result = $app->webServerApi()->networkLocation('869896021034807');
var_dump($result);
```