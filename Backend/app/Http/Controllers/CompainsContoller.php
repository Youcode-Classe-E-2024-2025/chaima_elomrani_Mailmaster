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
     * @OA\Get(
     *     path="/api/campaigns",
     *     summary="Get all campaigns",
     *     description="Returns a list of all campaigns",
     *     operationId="getCampaigns",
     *     tags={"Campaigns"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Summer Sale"),
     *                 @OA\Property(property="status", type="string", example="active"),
     *                 @OA\Property(property="start_date", type="string", format="date-time"),
     *                 @OA\Property(property="end_date", type="string", format="date-time"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
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
     * @OA\Get(
     *     path="/api/campaigns/{id}",
     *     summary="Get campaign by ID",
     *     description="Returns a specific campaign by ID",
     *     operationId="getCampaignById",
     *     tags={"Campaigns"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of campaign to return",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Summer Sale"),
     *             @OA\Property(property="status", type="string", example="active"),
     *             @OA\Property(property="start_date", type="string", format="date-time"),
     *             @OA\Property(property="end_date", type="string", format="date-time"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Campaign not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
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
     * @OA\Post(
     *     path="/api/campaigns",
     *     summary="Create a new campaign",
     *     description="Creates a new campaign and returns the created resource",
     *     operationId="storeCampaign",
     *     tags={"Campaigns"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Campaign data",
     *         @OA\JsonContent(
     *             required={"name", "status", "start_date"},
     *             @OA\Property(property="name", type="string", example="Black Friday Campaign"),
     *             @OA\Property(property="status", type="string", example="draft"),
     *             @OA\Property(property="start_date", type="string", format="date-time"),
     *             @OA\Property(property="end_date", type="string", format="date-time"),
     *             @OA\Property(property="target_audience", type="string", example="all subscribers"),
     *             @OA\Property(property="settings", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Campaign created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Black Friday Campaign"),
     *             @OA\Property(property="status", type="string", example="draft"),
     *             @OA\Property(property="start_date", type="string", format="date-time"),
     *             @OA\Property(property="end_date", type="string", format="date-time"),
     *             @OA\Property(property="target_audience", type="string", example="all subscribers"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
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
     * @OA\Put(
     *     path="/api/campaigns/{id}",
     *     summary="Update an existing campaign",
     *     description="Updates a campaign and returns the updated resource",
     *     operationId="updateCampaign",
     *     tags={"Campaigns"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of campaign to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Campaign data",
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Updated Campaign Name"),
     *             @OA\Property(property="status", type="string", example="active"),
     *             @OA\Property(property="start_date", type="string", format="date-time"),
     *             @OA\Property(property="end_date", type="string", format="date-time"),
     *             @OA\Property(property="target_audience", type="string", example="premium subscribers"),
     *             @OA\Property(property="settings", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Campaign updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Updated Campaign Name"),
     *             @OA\Property(property="status", type="string", example="active"),
     *             @OA\Property(property="start_date", type="string", format="date-time"),
     *             @OA\Property(property="end_date", type="string", format="date-time"),
     *             @OA\Property(property="target_audience", type="string", example="premium subscribers"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Campaign not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
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
     * @OA\Delete(
     *     path="/api/campaigns/{id}",
     *     summary="Delete a campaign",
     *     description="Deletes a campaign and returns no content",
     *     operationId="deleteCampaign",
     *     tags={"Campaigns"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of campaign to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Campaign deleted successfully"
     *     ),
     *     @OA\Response(response=404, description="Campaign not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     
    public function destroy($id){
        $campaign = $this->campaignService->deleteCampaign($id);
        return response()->json(null, 204);
    }

}
