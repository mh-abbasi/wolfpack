<?php


namespace App\Contracts;


interface Packable
{
    public function store($payload);
    public function update($packableId, $payload);
    public function index();
    public function getById($packableId);
    public function destroy($packableId);
    public function addToPack($packableId, $packId);
    public function removeFromPack($packableId, $packId);
}
