<?php

namespace App\Services;

use App\Models\Subscribers;
use App\Models\NewsLetter;
use App\Models\Campaign;


class CamapaignService{
    

    public function getAllCampaigns(){
        return Campaign::all();
    }

   
}