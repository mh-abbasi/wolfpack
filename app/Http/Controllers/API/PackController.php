<?php

namespace App\Http\Controllers\API;

use App\Contracts\Pack as PackInterface;
use App\Contracts\Packable as PackableInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePackRequest;
use App\Http\Requests\UpdatePackRequest;
use App\Pack;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PackController extends Controller
{

    private $packHandler = null;
    private $wolfHandler = null;

    public function __construct(PackInterface $pack,PackableInterface $wolf)
    {
        $this->packHandler = $pack;
        $this->wolfHandler = $wolf;
    }

    /**
     * @OA\Get(
     *     path="/packs",
     *     tags={"Pack"},
     *     summary="Returns all the packs",
     *     description="Returns list of the packs stored in the database",
     *     @OA\Response(
     *         response=200,
     *          description="successful operation",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Pack"))
     *     )
     * )
     */
    public function index()
    {
        return $this->packHandler->index();
    }

    /**
     * @OA\Post(
     *     path="/packs",
     *     tags={"Pack"},
     *     summary="Create a pack",
     *     description="Create a pack using desired payload",
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
     * @param StorePackRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePackRequest $request)
    {
        try {
            $pack = $this->packHandler->store($request->all());
            return response()->json([
                "message" => trans("Pack has been created successfully!"),
                "pack" => $pack
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/packs/{Id}",
     *     tags={"Pack"},
     *     summary="Get a pack",
     *     description="Get a pack details by its ID",
     *     @OA\Response(
     *         response=200,
     *          description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Pack")
     *     ),
     *     @OA\Response(
     *         response=404,
     *          description="Not found",
     *     )
     * )
     * @param int $packId
     * @return Pack|\Illuminate\Http\JsonResponse
     */
    public function show($packId)
    {
        $pack = $this->packHandler->getById($packId);
        return response()->json($pack
            , 200);
    }

    /**
     * @OA\Put(
     *     path="/packs/{id}",
     *     tags={"Pack"},
     *     summary="Update a pack",
     *     description="Update a pack using its ID and payload",
     *     @OA\Response(
     *         response=200,
     *          description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Pack")
     *     ),
     *     @OA\Response(
     *         response=404,
     *          description="Not found",
     *     )
     * )
     * @param UpdatePackRequest $request
     * @param int $packId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePackRequest $request, $packId)
    {
        try {
            $pack = $this->packHandler->update($packId, $request->all());
            return response()->json([
                "message" => trans("Pack has been updated successfully!"),
                "pack" => $pack
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/packs/{id}",
     *     tags={"Pack"},
     *     summary="Delete a pack",
     *     description="Delete a pack using its ID",
     *     @OA\Response(
     *         response=200,
     *          description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=404,
     *          description="Not found",
     *     )
     * )
     * @param int $packId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($packId)
    {
        try {
            $this->packHandler->destroy($packId);
            return response()->json(['message' => trans('Pack has been deleted successfully!')], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/packs/{id}/addWolf",
     *     tags={"Pack"},
     *     summary="Add a wolf to pack",
     *     description="Adding a wolf to a pack using its ID",
     *     @OA\Response(
     *         response=200,
     *          description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=404,
     *          description="Not found",
     *     )
     * )
     * @param Request $request
     * @param int $packId
     * @return \Illuminate\Http\JsonResponse
     */
    public function addWolfToPack(Request $request, $packId)
    {
        try {
            $this->wolfHandler->addToPack($request->get('id'), $packId);
            return response()->json([
                "message" => trans("Wolf added to the pack!")
            ], 200);
        } catch (Exception $e) {
            if( $e instanceof ModelNotFoundException ) {
                throw new ModelNotFoundException;
            }
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    /**
     * @OA\Post(
     *     path="/packs/{id}/removeWolf",
     *     tags={"Pack"},
     *     summary="Add a wolf to pack",
     *     description="Adding a wolf to a pack using its ID",
     *     @OA\Response(
     *         response=200,
     *          description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=404,
     *          description="Not found",
     *     )
     * )
     * @param Request $request
     * @param int $packId
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeWolfFromPack(Request $request, $packId)
    {
        try {
            $this->wolfHandler->removeFromPack($request->get('id'), $packId);
            return response()->json([
                "message" => trans("Wolf deleted from the pack!")
            ], 200);
        } catch (Exception $e) {
            if( $e instanceof ModelNotFoundException ) {
                throw new ModelNotFoundException;
            }
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
