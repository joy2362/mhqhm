<?php
//@abdullah zahid joy
namespace App\Helpers\Interface;

interface CrudOperation
{
    public function getAll();
    public function getById($id);
    public function destroy($id);
    public function createOrUpdate($data , $id = null);
}