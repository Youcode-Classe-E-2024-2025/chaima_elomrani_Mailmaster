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

    public function store(Request $request)
    {
        $data = $request->all();
        $newsletter = $this->newsletterService->createNewsletter($data);
        return response()->json($newsletter, 201);
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $newsletter = $this->newsletterService->updateNewsletter($id, $data);
        return response()->json($newsletter);
    }
    public function destroy($id)
    {
        $newsletter = $this->newsletterService->deleteNewsletter($id);
        return response()->json(null, 204);
    }
}
