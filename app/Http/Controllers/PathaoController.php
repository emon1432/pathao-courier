<?php

namespace App\Http\Controllers;

use App\Services\PathaoAPIService;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;


class PathaoController extends Controller
{
    protected $pathaoService;

    public function __construct(PathaoAPIService $pathaoService)
    {
        $this->pathaoService = $pathaoService;
    }

    public function createStore(Request $request)
    {
        $accessToken = $this->pathaoService->getAccessToken();
        $data = [];
        $data['name'] = "Emon Store";
        $data['contact_name'] = "Emon";
        $data['contact_number'] = "01521437220";
        $data['secondary_contact'] = "01638849305";
        $data['address'] = "Dholairpar, Jatrabari";
        $data['city_id'] = 1;
        $data['zone_id'] = 248;
        $data['area_id'] = 17920;
        $store = $this->pathaoService->createStore($accessToken, $data);
        return response()->json($store);
    }

    public function getStores()
    {
        $accessToken = $this->pathaoService->getAccessToken();
        $stores = $this->pathaoService->getStores($accessToken);
        return response()->json($stores);
    }

    public function getCityList()
    {
        $accessToken = $this->pathaoService->getAccessToken();
        $cityList = $this->pathaoService->getCityList($accessToken);

        return response()->json($cityList);
    }

    public function getZoneList($cityId)
    {
        $accessToken = $this->pathaoService->getAccessToken();
        $zoneList = $this->pathaoService->getZoneList($accessToken, $cityId);

        return response()->json($zoneList);
    }

    public function getAreaList($zoneId)
    {
        $accessToken = $this->pathaoService->getAccessToken();
        $areaList = $this->pathaoService->getAreaList($accessToken, $zoneId);

        return response()->json($areaList);
    }

    public function getPrice(Request $request)
    {
        $accessToken = $this->pathaoService->getAccessToken();
        $price = $this->pathaoService->getPrice($accessToken, $request->all());
        return response()->json($price);
    }

    public function createOrder(Request $request)
    {
        // return response()->json($request->all());
        $accessToken = $this->pathaoService->getAccessToken();
        $order = $this->pathaoService->createOrder($accessToken, $request->all());
        return response()->json($order);
    }
}
