<?php

namespace App\Services;

use App\Models\Subscribers;
use App\Models\NewsLetter;
use App\Models\Campaign;


class CamapaignService{
    

    public function getAllCampaigns(){
        return Campaign::all();
    }

    public function getCampaignById($id){
        return Campaign::find($id);
    }

    public function createCampaign($data){
        return Campaign::create($data);
    }

    public function updateCampaign($id, $data){
        $campaign = Campaign::find($id);
        $campaign->update($data);
        return $campaign;
    }
    
}