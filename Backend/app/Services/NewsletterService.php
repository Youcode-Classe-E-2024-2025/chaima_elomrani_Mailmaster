<?php   
namespace App\Services;
use App\Models\NewsLetter;


class NewsletterService{

    public function getAllNewsletters(){
        return NewsLetter::all();
    }

    public function getNewsletterById($id){
        return NewsLetter::find($id);
    }

    public function createNewsletter($data){
        return NewsLetter::create($data);
    }

    public function updateNewsletter($id, $data){
        $newsletter = NewsLetter::find($id);
        $newsletter->update($data);
        return $newsletter;
    }

    public function deleteNewsletter($id){
        $newsletter = NewsLetter::find($id);
        $newsletter->delete();
        return $newsletter;
    }
}