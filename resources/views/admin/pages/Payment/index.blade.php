<!-- @abdullah zahid joy-->
@extends('admin.layout.master')
@section('title')
    Payment
@endsection

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
{{--            <h1 class="h3 mb-3">Payment</h1>--}}
            <div class="row">
                <div class="col-12">
                    @if(empty($student))
                        <div class="card">
                            <div class="card-body">
                                <form class="row g-3" method="get" action="{{route('Payment.due')}}">

                                    <div class="col-auto">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Student Id">
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-3">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="d-flex justify-content-center ">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="{{$student->avatar}}" alt="student" class="rounded-circle" width="70" height="70">
                                        <div class="mt-3">
                                            <p class="text-secondary mb-1">{{$student->group->name }}  {{$student->group->bn_name ? "/ ".$student->group->bn_name : "" }}</p>
                                            <h4>{{ucfirst($student->details->first_name)}} {{$student->details->last_name}} ({{$student->username}})</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" row ">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="Post" action="{{route('Payment.pay')}}">
                                            @csrf
                                            <table class="table caption-top">
                                                <caption class="text-center fw-bold h4">Due List</caption>
                                                <thead>
                                                <tr>
                                                    <th scope="col">Month</th>
                                                    <th scope="col">Fee Type</th>
                                                    <th scope="col">Total Amount</th>
                                                    <th scope="col">Total Due</th>
                                                    <th scope="col">Total paid</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($student->invoice as $invoice )
                                                    <tr>
                                                        <td>{{$invoice->date}}</td>
                                                        <td>{{$invoice->feeType->name}}</td>
                                                        <td>{{$invoice->total_amount}}</td>
                                                        <td>{{$invoice->total_due}}</td>
                                                        <td>{{$invoice->total_paid}}</td>
                                                        <td>{{ucfirst($invoice->status)}}</td>
                                                        <td> <input class="form-control" type="number" name="amount[{{$loop->index}}]" min="1" max="{{$invoice->total_due}}" > </td>
                                                        <input type="hidden" name="invoice[{{$loop->index}}]" value="{{$invoice->id}}">
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <button type="submit" class="btn btn-success float-end">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
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