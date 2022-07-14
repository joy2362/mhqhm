<?php
//@abdullah zahid joy
namespace App\Interface;

interface CrudOperation
{
    public function getAll($model);
    public function getById($model,$id);
    public function destroy($model,$id);
    public function createOrUpdate($model,$data , $id = null);
}