<?php

namespace App\Http\Controllers\API;

use App\Contracts\Pack as PackInterface;
use App\Contracts\Packable as PackableInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePackRequest;
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
