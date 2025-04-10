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


}
