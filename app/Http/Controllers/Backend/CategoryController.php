<?php
//@abdullah zahid joy
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BaseController;
use App\Interface\CrudOperation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends BaseController
{

    /**
     * @var
     */
     private $crud , $model_name;

    /**
     * @param CrudOperation $crud
     */
     public function __construct(CrudOperation $crud){
        parent::__construct();
        $this->crud = $crud;
        $this->model_name = str_replace("Controller", "", "CategoryController");
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->crud->getAll($this->model_name);
        }
        return view('admin.pages.'. $this->model_name .'.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param Request $request
    * @return JsonResponse
    */
    public function store(Request $request): JsonResponse
    {
         $validator = Validator::make($request->all(),[
             'title' => 'required|max:191',
         ]);

        if ($validator->fails()){
           return response()->json([
               'status' => 400,
               'errors' => $validator->messages()
           ]);
        }

       $data  = $request->all();
       $this->crud->createOrUpdate($this->model_name,$data);

       return response()->json([
           'status' => 200,
           'message' => "Added Successfully!!"
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse
    {

         $data = $this->crud->getById($this->model_name ,$id);
         return response()->json([
            'status' => 200,
            'data' =>  $data
         ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
       $validator = Validator::make($request->all(),[
            'title' => 'required|max:191',
       ]);

       if ($validator->fails()){
           return response()->json([
               'status' => 400,
               'errors' => $validator->messages()
           ]);
       }

       $data  = $request->all();
       $this->crud->createOrUpdate($this->model_name, $data , $id);

       return response()->json([
           'status' => 200,
           'message' => "Updated Successfully!!"
       ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->crud->destroy( $this->model_name , $id );

         return response()->json([
            'status' => 200,
            'message' => "Deleted successfully!!"
         ]);
    }
}
