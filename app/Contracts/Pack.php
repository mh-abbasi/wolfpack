<?php


namespace App\Contracts;


interface Pack
{
    public function store($payload);
    public function update($packId, $payload);
    public function index();
    public function getById($packId);
    public function destroy($packId);
}
