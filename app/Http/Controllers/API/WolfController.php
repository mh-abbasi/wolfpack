<?php

namespace App\Http\Controllers\API;

use App\Contracts\Packable as PackableInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWolfRequest;
use Illuminate\Http\Request;

class WolfController extends Controller
{

    private $wolfHandler = null;

    public function __construct(PackableInterface $wolf)
    {
        $this->wolfHandler = $wolf;
    }


    /**
     * @OA\Get(
     *     path="/wolves",
     *     tags={"Wolf"},
     *     summary="Returns all the wolves",
     *     description="Returns list of the wolves stored in the database",
     *     @OA\Response(
     *         response=200,
     *          description="successful operation",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Wolf"))
     *     )
     * )
     */
    public function index()
    {
        return $this->wolfHandler->index();
    }

    /**
     * @OA\Post(
     *     path="/wolves",
     *     tags={"Wolf"},
     *     summary="Create a wolf",
     *     description="Create a wolf using desired payload",
     *     @OA\Response(
     *         response=201,
     *          description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=422,
     *          description="Payload errors",
     *     ),
     *     @OA\Response(
     *         response=500,
     *          description="Saving errors",
     *     )
     * )
     * @param StoreWolfRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreWolfRequest $request)
    {

        try {
            $wolf = $this->wolfHandler->store($request->all());
            return response()->json([
                "message" => trans("Wolf has been created successfully!"),
                "wolf" => $wolf
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
