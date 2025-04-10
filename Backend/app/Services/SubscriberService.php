<?php

namespace App\Services;

use App\Models\NewsLetter;
use App\Models\Subscribers;

class SubscriberService{

    public function getAllSubscribers(){
        return Subscribers::all();
    }

    public function getSubscriberById($id){
        return Subscribers::find($id);
    }

    public function createSubscriber($data){
        return Subscribers::create($data);
    }

    public function updateSubscriber($id, $data){
        $subscriber = Subscribers::find($id);
        $subscriber->update($data);
        return $subscriber;
    }
    

}