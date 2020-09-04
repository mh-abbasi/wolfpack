<?php

namespace App\Http\Controllers\API;

use App\Contracts\Packable as PackableInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWolfRequest;
use App\Http\Requests\UpdateWolfRequest;
use App\Wolf;
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
     * @OA\Get(
     *     path="/wolves/{Id}",
     *     tags={"Wolf"},
     *     summary="Get a wolf",
     *     description="Get a wolf details by its ID",
     *     @OA\Response(
     *         response=200,
     *          description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Wolf")
     *     ),
     *     @OA\Response(
     *         response=404,
     *          description="Not found",
     *     )
     * )
     * @param int $wolfId
     * @return Wolf|\Illuminate\Http\JsonResponse
     */
    public function show($wolfId)
    {
        $wolf = $this->wolfHandler->getById($wolfId);
        return response()->json($wolf
            , 200);
    }

    /**
     * @OA\Put(
     *     path="/wolves/{id}",
     *     tags={"Wolf"},
     *     summary="Update a wolf",
     *     description="Update a wolf using its ID and payload",
     *      @OA\Parameter(
     *          name="id", required=true, in="path", @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *          @OA\MediaType(mediaType="application/json",
     *                  @OA\Schema(
     *                      type="object",
     *                      ref="#/components/schemas/Wolf"
     *                  )
     *         )
     *      ),
     *     @OA\Response(
     *         response=200,
     *          description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Wolf")
     *     ),
     *     @OA\Response(
     *         response=404,
     *          description="Not found",
     *     )
     * )
     * @param UpdateWolfRequest $request
     * @param int $wolfId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateWolfRequest $request, $wolfId)
    {
        try {
            $wolf = $this->wolfHandler->update($wolfId, $request->all());
            return response()->json([
                "message" => trans("Wolf has been updated successfully!"),
                "wolf" => $wolf
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

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
