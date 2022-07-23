<?php
//@abdullah zahid joy
namespace App\Crud;

use App\Interface\CrudOperation;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

/**
 *
 */
class Crud implements CrudOperation
{
    /**
     * @param $model
     * @return JsonResponse
     * @throws Exception
     */
    public function getAll($model): JsonResponse
    {
        $data = App::make( 'App\\Models\\'.$model )->where('is_deleted','no')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function($row){
                return '<div class="dropdown">
                            <span class="btn btn-success rounded btn-sm px-3 " type="button" id="action" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </span>
                            <ul class="dropdown-menu text-center" aria-labelledby="action">
                                <li><button class="m-2 btn btn-sm btn-success edit_button rounded" value="'.$row->id.'"> Edit</button></li>
                                <li><button class="m-2 btn btn-sm btn-danger delete_button rounded" value="'.$row->id.'">Delete</button></li>
                            </ul>
                        </div>';


            })
            ->rawColumns(['actions'])
            ->make(true);

    }

    /**
     * @param $model
     * @param $id
     * @return mixed
     */
    public function getById($model,$id): mixed
    {
        return App::make( 'App\\Models\\'.$model )->find($id);
    }

    /**
     * @param $model
     * @param $id
     * @return mixed
     */
    public function destroy($model,$id): mixed
    {
        $admin = Auth::id() ? Auth::id() : 1;

        return App::make( 'App\\Models\\'.$model )->find($id)->update([
            "deleted_by" =>  $admin,
            "deleted_at" => date('Y-m-d H:i:s'),
            "is_deleted" => "yes",
            "status" => "Inactive",
        ]);
    }

    /**
     * @param $model
     * @param $data
     * @param null $id
     * @return mixed
     */
    public function createOrUpdate($model, $data ,$id = null ): mixed
    {
        if(!empty($id)){
            return App::make( 'App\\Models\\'.$model )->find($id)->update($data);
        }else{
            return App::make( 'App\\Models\\'.$model )->create($data);
        }
    }

}