<?php

namespace App\Http\Controllers;

use App\Services\NewsletterService;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    protected $newsletterService;

    public function __construct(NewsletterService $newsletterService)
    {
        $this->newsletterService = $newsletterService;
    }

    /**
     * Display a listing of the newsletters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */


    public function index(Request $request)
    {
        $newsletters = $this->newsletterService->getAllNewsletters();
        return response()->json($newsletters);
    }
    public function show($id)
    {
        $newsletter = $this->newsletterService->getNewsletterById($id);
        return response()->json($newsletter);
    }



    /**
     * Store a newly created newsletter in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newsletter = $this->newsletterService->createNewsletter($data);
        return response()->json($newsletter, 201);
    }

    
    /**
     * Update the specified newsletter in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $newsletter = $this->newsletterService->updateNewsletter($id, $data);
        return response()->json($newsletter);
    }

    /**
     * Remove the specified newsletter from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newsletter = $this->newsletterService->deleteNewsletter($id);
        return response()->json(null, 204);
    }
}
