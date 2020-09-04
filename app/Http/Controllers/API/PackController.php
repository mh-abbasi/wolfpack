<?php

namespace App\Http\Controllers\API;

use App\Contracts\Pack as PackInterface;
use App\Contracts\Packable as PackableInterface;
use App\Http\Controllers\Controller;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
