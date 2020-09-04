<?php


namespace App\Services;

use App\Contracts\Pack as PackInterface;
use App\Pack;

/**
 * Class WolfPack
 * implementing Pack interface
 * @package App\Services
 */
class WolfPack implements PackInterface
{


    /**
     * Store a new Pack
     *
     * @param $payload
     * @return mixed
     */
    public function store($payload)
    {
        return Pack::create($payload);
    }


    /**
     * Update a pack
     *
     * @param $packId
     * @param $payload
     * @return mixed
     */
    public function update($packId, $payload)
    {
        $pack = Pack::findOrFail($packId);
        $pack->fill($payload)->save();
        return $pack;
    }

    /**
     * Return list of all the packs in the database
     *
     * @return Pack[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Pack::all();
    }

    /**
     * Get a pock using a ID
     *
     * @param $packId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getById($packId)
    {
        return Pack::with('wolves')->findOrFail($packId);
    }

    /**
     * Delete a pack
     *
     * @param $packId
     * @return mixed
     */
    public function destroy($packId)
    {
        $pack = Pack::findOrFail($packId);
        return $pack->delete();
    }
}
