<?php
//@abdullah zahid joy
namespace App\Interface;

interface Crud
{
    public function getAll($model,$type = 'datatable' ,$files = []);
    public function getById($model,$id);
    public function destroy($model,$id);
    public function createOrUpdate($model,$data , $id = null);
}