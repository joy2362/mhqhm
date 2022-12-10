<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BaseController;
use App\Models\Invoice;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends BaseController
{
    public function index(){
        return view('admin.pages.payment.index');
    }

    public function due(Request $request){
            $student = User::with(['invoice' => function($q){
                $q->with('feeType')->whereNot('status',"paid");
            },'group:id,name,bn_name'
            ])->where('username',$request->username)->first();

            return $student ? view('admin.pages.payment.index',['student'=>$student]) : redirect()->route("Payment.index");
    }

    public function pay(Request $request){
        try {
            DB::beginTransaction();
            foreach ($request->invoice as $key=>$value){
                if(!empty($request->amount[$key])){
                    $data = $this->calculateDue($value ,$request->amount[$key]);
                    Invoice::find($value)->update($data);

                }
            }
            DB::commit();
            $notification = array(
                'messege' => "payment Successful.",
                'alert-type' => 'success'
            );
            return Redirect()->route('Payment.index')->with($notification);

        }catch (Exception $ex){
            DB::rollBack();
            $notification = array(
                'messege' => $ex->getMessage(),
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }

    }

    private function calculateDue($id , $amount){
        $invoice = Invoice::find($id);
        $data["total_due"] = $invoice->total_due - $amount;
        $data["total_paid"] = $invoice->total_paid + $amount;
        if($data["total_due"] == 0) $data["status"] = "paid";
        $invoice->payments()->create(['amount'=>$amount]);
        return $data;
    }

    public function invoice(){
        $invoices = Invoice::whereHas("payments")->with(['feeType:id,name,bn_name', 'user'=> function($q){
            $q->with(['details','group:id,name,bn_name']);
        }])->get();

        return view('admin.pages.payment.invoice' , ['invoices' => $invoices]);
    }

}
