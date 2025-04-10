<?php

namespace App\Http\Controllers;

use App\Services\SubscriberService;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    protected $subscriberService;

    public function __construct(SubscriberService $subscriberService){

        $this->subscriberService = $subscriberService;
    }

    /**
     * Retrieve all subscribers
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id){
        $subscriber = $this->subscriberService->deleteSubscriber($id);
        return response()->json(null, 204);
    }


}
