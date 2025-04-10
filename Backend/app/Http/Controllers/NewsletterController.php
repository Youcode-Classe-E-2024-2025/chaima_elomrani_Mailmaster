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
     * @OA\Get(
     *     path="/api/newsletters",
     *     summary="Get all newsletters",
     *     description="Returns a list of all newsletters",
     *     operationId="getNewsletters",
     *     tags={"Newsletters"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Monthly Update"),
     *                 @OA\Property(property="content", type="string", example="Newsletter content here"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */



    public function index(Request $request)
    {
        $newsletters = $this->newsletterService->getAllNewsletters();
        return response()->json($newsletters);
    }

    
    /**
     * Display the specified newsletter.
     *
     * @OA\Get(
     *     path="/api/newsletters/{id}",
     *     summary="Get newsletter by ID",
     *     description="Returns a specific newsletter by ID",
     *     operationId="getNewsletterById",
     *     tags={"Newsletters"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of newsletter to return",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Monthly Update"),
     *             @OA\Property(property="content", type="string", example="Newsletter content here"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Newsletter not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */


    public function show($id)
    {
        $newsletter = $this->newsletterService->getNewsletterById($id);
        return response()->json($newsletter);
    }


    /**
     * Store a newly created newsletter in storage.
     *
     * @OA\Post(
     *     path="/api/newsletters",
     *     summary="Create a new newsletter",
     *     description="Creates a new newsletter and returns the created resource",
     *     operationId="storeNewsletter",
     *     tags={"Newsletters"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Newsletter data",
     *         @OA\JsonContent(
     *             required={"title", "content"},
     *             @OA\Property(property="title", type="string", example="April Newsletter"),
     *             @OA\Property(property="content", type="string", example="Content of the newsletter"),
     *             @OA\Property(property="send_date", type="string", format="date-time"),
     *             @OA\Property(property="status", type="string", example="draft")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Newsletter created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="April Newsletter"),
     *             @OA\Property(property="content", type="string", example="Content of the newsletter"),
     *             @OA\Property(property="send_date", type="string", format="date-time"),
     *             @OA\Property(property="status", type="string", example="draft"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
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
     * @OA\Put(
     *     path="/api/newsletters/{id}",
     *     summary="Update an existing newsletter",
     *     description="Updates a newsletter and returns the updated resource",
     *     operationId="updateNewsletter",
     *     tags={"Newsletters"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of newsletter to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Newsletter data",
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Updated April Newsletter"),
     *             @OA\Property(property="content", type="string", example="Updated content of the newsletter"),
     *             @OA\Property(property="send_date", type="string", format="date-time"),
     *             @OA\Property(property="status", type="string", example="published")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Newsletter updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Updated April Newsletter"),
     *             @OA\Property(property="content", type="string", example="Updated content of the newsletter"),
     *             @OA\Property(property="send_date", type="string", format="date-time"),
     *             @OA\Property(property="status", type="string", example="published"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Newsletter not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
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
     * @OA\Delete(
     *     path="/api/newsletters/{id}",
     *     summary="Delete a newsletter",
     *     description="Deletes a newsletter and returns no content",
     *     operationId="deleteNewsletter",
     *     tags={"Newsletters"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of newsletter to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Newsletter deleted successfully"
     *     ),
     *     @OA\Response(response=404, description="Newsletter not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
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
