<?php

namespace App\Crud;
//@dev: abdullah zahid joy
//crud skeleton for Product

use App\Helpers\Interface\CrudOperation;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProductOperation implements CrudOperation
{
    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
     public function getAll(){
        $data = Product::where('is_deleted','no')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function($row){

                $btn = '<button class="m-2 btn btn-sm btn-primary edit_button" value="'.$row->id.'">Edit</button>';

                $btn = $btn.'<button class="m-2 btn btn-sm btn-danger delete_button" value="'.$row->id.'">Delete</button>';

                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
     }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id){
         return Product::find($id);
    }

    /**
     * @param $id
     */
     public function destroy($id){
        $admin = Auth::id() ? Auth::id() : 1;

        return Product::find($id)->update([
            "deleted_by" =>  $admin,
            "deleted_at" => date('Y-m-d H:i:s'),
            "is_deleted" => "yes",
            "status" => "Inactive",
        ]);
     }

    /**
     * @param $data
     * @param null $id
     * @return mixed
     */
    public function createOrUpdate( $data ,$id = null ){
        if(!empty($id)){
            return Product::find($id)->update($data);
        }else{
           return Product::create($data);
        }
    }

}