<?php

namespace App\Interfaces;

interface CrudInterface
{
    public function getAll();

    public function find($id);

    public function delete($id);

    public function create($data);

    public function update($data, $id);
}