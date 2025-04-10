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

    public function index(Request $request){
        $subscribers = $this->subscriberService->getAllSubscribers();
        return response()->json($subscribers);
    }

    public function show($id){
        $subscriber = $this->subscriberService->getSubscriberById($id);
        return response()->json($subscriber);
    }

    public function store(Request $request){
        $data = $request->all();
        $subscriber = $this->subscriberService->createSubscriber($data);
        return response()->json($subscriber, 201);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $subscriber = $this->subscriberService->updateSubscriber($id, $data);
        return response()->json($subscriber);
    }

    publci function destroy($id){
        $subscriber = $this->subscriberService->deleteSubscriber($id);
        return response()->json(null, 204);
    }


}
