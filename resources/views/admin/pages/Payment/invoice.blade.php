<!-- @abdullah zahid joy-->
@extends('admin.layout.master')
@section('title')
    Invoice
@endsection

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Invoice</h1>
            <div class="row">
                <div class="col-12">
                    <div class=" row ">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table caption-top" id="data">
                                        <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Group</th>
                                            <th scope="col">Fee Type</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Month</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($payments as $payment )
                                            <tr>
                                                <td>{{$payment->invoice->user->username ?? "" }}</td>
                                                <td>{{$payment->invoice->user->details->first_name . " " .$payment->invoice->user->details->last_name }}</td>
                                                <td>{{$payment->invoice->user->group->name  }}  {{$payment->invoice->user->group->bn_name ? "/ ".$payment->invoice->user->group->bn_name : "" }}</td>
                                                <td>{{$payment->invoice->feeType->name}}</td>
                                                <td> {{$payment->amount}} </td>
                                                <td>{{$payment->created_at->format("d-m-Y")}}</td>
                                                <td>{{$payment->status}}</td>
                                                <td>
                                                    <a class="btn btn-success rounded btn-sm px-3 " type="button" href="{{route('Payment.pdf',$payment->id)}}">Print</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#data').DataTable({
                "order":false
            });
        });
    </script>
@endsection