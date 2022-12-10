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
                                    <table class="table caption-top">
                                        <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Group</th>
                                            <th scope="col">Fee Type</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">paid</th>
                                            <th scope="col">Month</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($invoices as $invoice )
                                            <tr>

                                                <td>{{$invoice->user->username ?? "" }}</td>
                                                <td>{{$invoice->user->details->first_name . " " .$invoice->user->details->last_name }}</td>
                                                <td>{{$invoice->user->group->name  }}  {{$invoice->user->group->bn_name ? "/ ".$invoice->user->group->bn_name : "" }}</td>
                                                <td>{{$invoice->feeType->name}}</td>
                                                <td>{{$invoice->total_amount}}</td>
                                                <td>{{$invoice->total_paid}}</td>
                                                <td>{{$invoice->date}}</td>
                                                <td>{{ucfirst($invoice->status)}}</td>
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
        document.addEventListener("DOMContentLoaded", function() {});
    </script>
@endsection