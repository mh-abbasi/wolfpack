<?php


namespace App\Services;
use App\Contracts\Packable;


class Wolf implements Packable
{

    public function store($payload)
    {
        // TODO: Implement store() method.
    }

    public function update($packableId, $payload)
    {
        // TODO: Implement update() method.
    }

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function getById($packableId)
    {
        // TODO: Implement getById() method.
    }

    public function destroy($packableId)
    {
        // TODO: Implement destroy() method.
    }

    public function addToPack($packableId, $packId)
    {
        // TODO: Implement addToPack() method.
    }

    public function removeFromPack($packableId, $packId)
    {
        // TODO: Implement removeFromPack() method.
    }
}
