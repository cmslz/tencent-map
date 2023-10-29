<?php

namespace Cmslz\TencentMap;

use Cmslz\TencentMap\Exception\ServerException;
use GuzzleHttp\Exception\GuzzleException;

class WebServerApi
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 地点搜索
     * @link https://lbs.qq.com/service/webService/webServiceGuide/webServiceSearch
     * @param string $keyword 此参数无需进行url编码
     * @param string $boundary
     * @param array $options
     * @return Response
     * @throws ServerException
     * @throws GuzzleException
     */
    public function locationSearch(string $keyword, string $boundary, array $options = []): Response
    {
        return $this->request->get('/ws/place/v1/search', array_merge(
            compact('boundary'),
            [
                'keyword' => urlencode($keyword)
            ],
            $options
        ));
    }

    /**
     * 地点搜索(周边推荐)
     * @link https://lbs.qq.com/service/webService/webServiceGuide/webServiceSearch#5
     * @param string $boundary
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws ServerException
     */
    public function locationSearchByExplore(string $boundary, array $options = []): Response
    {
        return $this->request->get('/ws/place/v1/explore', array_merge(
            compact('boundary'),
            $options
        ));
    }

    /**
     * 地点搜索(ID查询（detail）)
     * @link https://lbs.qq.com/service/webService/webServiceGuide/webServiceSearch#6
     * @param string|int $id
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws ServerException
     */
    public function locationSearchByDetailId(string|int $id, array $options = []): Response
    {
        return $this->request->get('/ws/place/v1/detail', array_merge(
            compact('id'),
            $options
        ));
    }

    /**
     * 关键词输入提示
     * @link https://lbs.qq.com/service/webService/webServiceGuide/webServiceSuggestion
     * @param string $keyword
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws ServerException
     */
    public function suggestion(string $keyword, array $options = []): Response
    {
        return $this->request->get('/ws/place/v1/suggestion', array_merge(
            compact('keyword'),
            $options
        ));
    }

    /**
     * 逆地址解析
     * @link https://lbs.qq.com/service/webService/webServiceGuide/webServiceGcoder
     * @param string $location
     * @param array $options
     * @throws GuzzleException|ServerException
     * @return Response
     */
    public function inverseAddress(string $location, array $options = []): Response
    {
        return $this->request->get('/ws/geocoder/v1/', array_merge(
            compact('location'),
            $options
        ));
    }

    /**
     * 地址解析
     * @link https://lbs.qq.com/service/webService/webServiceGuide/webServiceGeocoder
     * @param string $address
     * @param array $options
     * @return Response
     * @throws GuzzleException|ServerException
     */
    public function addressResolution(string $address, array $options = []): Response
    {
        return $this->request->get('/ws/geocoder/v1/', array_merge(
            compact('address'),
            $options
        ));
    }

    /**
     * 智能地址解析
     * @link https://lbs.qq.com/service/address_service/SmartGeocoder
     * @param string $smart_address
     * @param array $options
     * @return Response
     * @throws GuzzleException|ServerException
     */
    public function smartAddress(string $smart_address, array $options = []): Response
    {
        return $this->request->get('/ws/geocoder/v1/', array_merge(
            compact('smart_address'),
            $options
        ));
    }

    /**
     * 地址真实性分析API（验真）
     * @link https://lbs.qq.com/service/address_service/truth_analy
     * @param string $address
     * @param array $options
     * @return Response
     * @throws GuzzleException|ServerException
     */
    public function truthAnaly(string $address, array $options = []): Response
    {
        return $this->request->get('/ws/smart_address/truth_analy', array_merge(
            compact('address'),
            $options
        ));
    }

    /**
     * 地址纠正补全API
     * @link https://lbs.qq.com/service/address_service/address_complete
     * @param string $address
     * @param array $options
     * @return Response
     * @throws GuzzleException|ServerException
     */
    public function addressComplete(string $address, array $options = []): Response
    {
        return $this->request->get('/ws/smart_address/address_complete', array_merge(
            compact('address'),
            $options
        ));
    }

    /**
     * 地址异常错误分析API
     * @link https://lbs.qq.com/service/address_service/abnormal_analy
     * @param string $address
     * @param array $options
     * @return Response
     * @throws GuzzleException|ServerException
     */
    public function abnormalAnaly(string $address, array $options = []): Response
    {
        return $this->request->get('/ws/smart_address/abnormal_analy', array_merge(
            compact('address'),
            $options
        ));
    }

    /**
     * 名称与地址匹配真实性校验API
     * @link https://lbs.qq.com/service/address_service/name_address_analy
     * @param string $name
     * @param string $address
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws ServerException
     */
    public function nameAddressAnaly(string $name, string $address, array $options = []): Response
    {
        return $this->request->get('/ws/smart_address/name_address_analy', array_merge(
            compact('name', 'address'),
            $options
        ));
    }

    /**
     * 地址地点分析API
     * @link https://lbs.qq.com/service/address_service/place_analy
     * @param string $address
     * @param string $location
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws ServerException
     */
    public function placeAnaly(string $address = '', string $location = '', array $options = []): Response
    {
        if (empty($address) && empty($location)) {
            throw new ServerException('address 或 location 必须选择其中一个');
        }
        if (!empty($address)) {
            $options['address'] = $address;
        } else {
            $options['location'] = $location;
        }
        return $this->request->get('/ws/smart_address/place_analy/',
            $options
        );
    }

    /**
     * 路线规划(驾车)
     * @link https://lbs.qq.com/service/webService/webServiceGuide/webServiceRoute#2
     * @param string $from
     * @param string $to
     * @param array $options
     * @return Response
     * @throws GuzzleException|ServerException
     */
    public function directionDriving(string $from, string $to, array $options = []): Response
    {
        return $this->request->get('/ws/direction/v1/driving/', array_merge(
            compact('from', 'to'),
            $options
        ));
    }

    /**
     * 路线规划(步行)
     * @link https://lbs.qq.com/service/webService/webServiceGuide/webServiceRoute#3
     * @param string $from
     * @param string $to
     * @param array $options
     * @return Response
     * @throws GuzzleException|ServerException
     */
    public function directionWalking(string $from, string $to, array $options = []): Response
    {
        return $this->request->get('/ws/direction/v1/walking/', array_merge(
            compact('from', 'to'),
            $options
        ));
    }

    /**
     * 路线规划(骑行)
     * @link https://lbs.qq.com/service/webService/webServiceGuide/webServiceRoute#4
     * @param string $from
     * @param string $to
     * @param array $options
     * @return Response
     * @throws GuzzleException|ServerException
     */
    public function directionBicycling(string $from, string $to, array $options = []): Response
    {
        return $this->request->get('/ws/direction/v1/bicycling/', array_merge(
            compact('from', 'to'),
            $options
        ));
    }

    /**
     * 路线规划(骑行)
     * @link https://lbs.qq.com/service/webService/webServiceGuide/webServiceRoute#5
     * @param string $from
     * @param string $to
     * @param array $options
     * @return Response
     * @throws GuzzleException|ServerException
     */
    public function directionEbicycling(string $from, string $to, array $options = []): Response
    {
        return $this->request->get('/ws/direction/v1/ebicycling/', array_merge(
            compact('from', 'to'),
            $options
        ));
    }

    /**
     * 路线规划(公交车)
     * @link https://lbs.qq.com/service/webService/webServiceGuide/webServiceRoute#5
     * @param string $from
     * @param string $to
     * @param array $options
     * @return Response
     * @throws GuzzleException|ServerException
     */
    public function directionTransit(string $from, string $to, array $options = []): Response
    {
        return $this->request->get('/ws/direction/v1/transit/', array_merge(
            compact('from', 'to'),
            $options
        ));
    }

    /**
     * 地址距离计算
     * @link https://lbs.qq.com/service/webService/webServiceGuide/webServiceMatrix
     * @param string $mode
     * @param string $from
     * @param string $to
     * @param array $options
     * @return Response
     * @throws GuzzleException|ServerException
     */
    public function distanceMatrix(string $mode, string $from, string $to, array $options = []): Response
    {
        return $this->request->get('/ws/distance/v1/matrix', array_merge(
            compact('from', 'to', 'mode'),
            $options
        ));
    }

    /**
     * 货车（trucking）路线规划
     * @link https://lbs.qq.com/service/webService/webServiceGuide/directionTrucking
     * @param string $from
     * @param string $to
     * @param string $size
     * @param string $height
     * @param string $width
     * @param string $weight
     * @param string $axle_weight
     * @param string $axle_count
     * @param string $is_trailer
     * @param array $options
     * @return Response
     * @throws GuzzleException|ServerException
     */
    public function directionTrucking(
        string $from,
        string $to,
        string $size,
        string $height,
        string $width,
        string $weight,
        string $axle_weight,
        string $axle_count,
        string $is_trailer,
        array $options = []
    ): Response {
        return $this->request->get('/ws/direction/v1/trucking', array_merge(
            compact('from', 'to', 'size', 'height', 'weight', 'width',
                'axle_weight', 'axle_count', 'is_trailer'),
            $options
        ));
    }

    /**
     * 获取省市区列表
     * @link https://lbs.qq.com/service/webService/webServiceGuide/webServiceDistrict
     * @param array $options
     * @return Response
     * @throws GuzzleException|ServerException
     */
    public function districtList(array $options = []): Response
    {
        return $this->request->get('/ws/district/v1/list', $options);
    }

    /**
     * 获取下级行政区划
     * @link https://lbs.qq.com/service/webService/webServiceGuide/webServiceDistrict#3
     * @param string|int $id
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws ServerException
     */
    public function districtGetChildren(string|int $id, array $options = []): Response
    {
        return $this->request->get('/ws/district/v1/getchildren', array_merge(
            compact('id'),
            $options
        ));
    }

    /**
     * 行政区划搜索
     * @link https://lbs.qq.com/service/webService/webServiceGuide/webServiceDistrict#4
     * @param string $keyword
     * @param array $options
     * @return Response
     * @throws GuzzleException|ServerException
     */
    public function districtSearch(string $keyword, array $options = []): Response
    {
        return $this->request->get('/ws/district/v1/search', array_merge(
            compact('keyword'),
            $options
        ));
    }

    /**
     * 坐标转换
     * @link https://lbs.qq.com/service/webService/webServiceGuide/webServiceTranslate
     * @param string $locations
     * @param string $type
     * @param array $options
     * @return Response
     * @throws GuzzleException|ServerException
     */
    public function coordTranslate(string $locations, string $type, array $options = []): Response
    {
        return $this->request->get('/ws/coord/v1/translate', array_merge(
            compact('locations', 'type'),
            $options
        ));
    }

    /**
     * ip定位
     * @link https://lbs.qq.com/service/webService/webServiceGuide/webServiceIp
     * @param string $ip
     * @param array $options
     * @return Response
     * @throws GuzzleException|ServerException
     */
    public function ip(string $ip, array $options = []): Response
    {
        return $this->request->get('/ws/location/v1/ip', array_merge(
            compact('ip'),
            $options
        ));
    }

    /**
     * 智能硬件定位
     * @link https://lbs.qq.com/service/webService/webServiceGuide/location
     * @param string|int $device_id
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws ServerException
     */
    public function networkLocation(string|int $device_id, array $options = []): Response
    {
        return $this->request->post('/ws/location/v1/network', array_merge(
            compact('device_id'),
            $options
        ));
    }
}