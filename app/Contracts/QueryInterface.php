<?php

namespace App\Contracts;

interface QueryInterface
{
    public function getAll(array $selectedColumns);
    public function getById($id);
}
