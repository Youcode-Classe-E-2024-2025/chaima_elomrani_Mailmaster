<?php

namespace App\Services;

use App\Models\NewsLetter;
use App\Models\Subscribers;

class SubscriberService{

    public function getAllSubscribers(){
        return Subscribers::all();
    }
    

}