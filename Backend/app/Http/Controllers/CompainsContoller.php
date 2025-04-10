<?php

namespace App\Http\Controllers;

use App\Services\CampaignService;
use Illuminate\Http\Request;

class CompainsContoller extends Controller
{
    
    protected  $campaignService;

    public function __construct(CampaignService $campaignService){
        $this->campaignService = $campaignService;
    }

    public function index(){
        $campaigns = $this->campaignService->getAllCampaigns();
        return response()->json($campaigns);
    }

    public function show($id){
        $campaign = $this->campaignService->getCampaignById($id);
        return response()->json($campaign);
    }


    public function store(Request $request){
        $data = $request->all();
        $campaign = $this->campaignService->createCampaign($data);
        return response()->json($campaign, 201);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $campaign = $this->campaignService->updateCampaign($id, $data);
        return response()->json($campaign);
    }

    public function destroy($id){
        $campaign = $this->campaignService->deleteCampaign($id);
        return response()->json(null, 204);
    }

}
