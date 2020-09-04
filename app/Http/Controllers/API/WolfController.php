<?php

namespace App\Http\Controllers\API;

use App\Contracts\Packable as PackableInterface;
use App\Http\Controllers\Controller;
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
