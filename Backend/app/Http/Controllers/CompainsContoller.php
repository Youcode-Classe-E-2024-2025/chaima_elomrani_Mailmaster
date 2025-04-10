<?php

namespace App\Http\Controllers;

use App\Services\CampaignService;
use Illuminate\Http\Request;

class CompainsContoller extends Controller
{
    
    protected  $campaignService;

    /**
     * Constructor to inject CampaignService instance
     *
     * @param CampaignService $campaignService
     */
    public function __construct(CampaignService $campaignService){
        $this->campaignService = $campaignService;
    }


    /**
     * Retrieve all campaigns
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $campaigns = $this->campaignService->getAllCampaigns();
        return response()->json($campaigns);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $campaign = $this->campaignService->getCampaignById($id);
        return response()->json($campaign);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created campaign in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request){
        $data = $request->all();
        $campaign = $this->campaignService->createCampaign($data);
        return response()->json($campaign, 201);
    }


    /**
     * Update the specified campaign in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function update(Request $request, $id){
        $data = $request->all();
        $campaign = $this->campaignService->updateCampaign($id, $data);
        return response()->json($campaign);
    }


    /**
     * Remove the specified campaign from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $campaign = $this->campaignService->deleteCampaign($id);
        return response()->json(null, 204);
    }

}
