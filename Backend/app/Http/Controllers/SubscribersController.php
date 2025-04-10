<?php

namespace App\Http\Controllers;

use App\Services\SubscriberService;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Subscribers API",
 *     version="1.0.0",
 *     description="API endpoints for managing subscribers"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */

class SubscribersController extends Controller
{
    protected $subscriberService;

    public function __construct(SubscriberService $subscriberService){

        $this->subscriberService = $subscriberService;
    }

    /**
     * Retrieve all subscribers
     *
     * @OA\Get(
     *     path="/api/subscribers",
     *     summary="Get all subscribers",
     *     description="Returns a list of all subscribers",
     *     operationId="getSubscribers",
     *     tags={"Subscribers"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="John Doe"),
     *                 @OA\Property(property="email", type="string", example="john@example.com"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function index(Request $request){
        $subscribers = $this->subscriberService->getAllSubscribers();
        return response()->json($subscribers);
    }


    /**
     * Display the specified subscriber.
     *
     * @OA\Get(
     *     path="/api/subscribers/{id}",
     *     summary="Get subscriber by ID",
     *     description="Returns a specific subscriber by ID",
     *     operationId="getSubscriberById",
     *     tags={"Subscribers"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of subscriber to return",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="john@example.com"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Subscriber not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */


    public function show($id){
        $subscriber = $this->subscriberService->getSubscriberById($id);
        return response()->json($subscriber);
    }


    /**
     * Store a newly created subscriber in storage.
     *
     * @OA\Post(
     *     path="/api/subscribers",
     *     summary="Create a new subscriber",
     *     description="Creates a new subscriber and returns the created resource",
     *     operationId="storeSubscriber",
     *     tags={"Subscribers"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Subscriber data",
     *         @OA\JsonContent(
     *             required={"name", "email"},
     *             @OA\Property(property="name", type="string", example="Jane Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="jane@example.com"),
     *             @OA\Property(property="status", type="string", example="active"),
     *             @OA\Property(property="preferences", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Subscriber created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Jane Doe"),
     *             @OA\Property(property="email", type="string", example="jane@example.com"),
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
        $subscriber = $this->subscriberService->createSubscriber($data);
        return response()->json($subscriber, 201);
    }




    /**
     * Update the specified subscriber in storage.
     *
     * @OA\Put(
     *     path="/api/subscribers/{id}",
     *     summary="Update an existing subscriber",
     *     description="Updates a subscriber and returns the updated resource",
     *     operationId="updateSubscriber",
     *     tags={"Subscribers"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of subscriber to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Subscriber data",
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Jane Doe Updated"),
     *             @OA\Property(property="email", type="string", format="email", example="janeupdated@example.com"),
     *             @OA\Property(property="status", type="string", example="inactive"),
     *             @OA\Property(property="preferences", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Subscriber updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Jane Doe Updated"),
     *             @OA\Property(property="email", type="string", example="janeupdated@example.com"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Subscriber not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function update(Request $request, $id){
        $data = $request->all();
        $subscriber = $this->subscriberService->updateSubscriber($id, $data);
        return response()->json($subscriber);
    }


    /**
     * Remove the specified subscriber from storage.
     *
     * @OA\Delete(
     *     path="/api/subscribers/{id}",
     *     summary="Delete a subscriber",
     *     description="Deletes a subscriber and returns no content",
     *     operationId="deleteSubscriber",
     *     tags={"Subscribers"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of subscriber to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Subscriber deleted successfully"
     *     ),
     *     @OA\Response(response=404, description="Subscriber not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id){
        $subscriber = $this->subscriberService->deleteSubscriber($id);
        return response()->json(null, 204);
    }


}
