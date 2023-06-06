<?php

namespace App\Contracts;

interface CommandInterface
{
    public function create($data);
    public function update($id, $data);
    public function delete($id);
}
