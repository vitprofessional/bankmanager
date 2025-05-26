@extends('adminPanel.include')
@section('calculasTitle') Generate Report {{ date('d-M-Y') }} @endsection
<style type="text/css">
    .table>:not(caption)>*>* {
        padding: .3rem 0 !important;
        padding-left: 1rem !important;
    }
</style>
@section('calculasBody')
<div class="row align-items-center v-100">
    <div class="col-10 col-md-7 mx-auto my-2 noprint">
        <div class="card">
            <div class="card-header">Generate Report</div>
            <div class="row">
                <div class="col-12">
                    @if(session()->has('success'))
                        <div class="alert alert-success w-100 rounded-0">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger w-100 rounded-0">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                </div>
            </div>
            
            <form class="row g-3 card-body" method="POST" action="{{ route('getData') }}">
                @csrf
                <input type="hidden" name="employeeId" value="{{ $employee_id }}">
                <div class="col-12">
                    <label for="reportDate" class="form-label">Date</label>
                    <input type="date" class="form-control" name="reportDate" id="reportDate" placeholder="Enter the date of your query" required />
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Get Data</button>
                </div>
            </form>
        </div>
    </div>
    @if(isset($data) && isset($debit) && isset($credit))
        @php
            $y = 1;
            $liquid         = $data->ob;
            $handCash       = $data->cb;
            $totalCalculas  = $liquid+$handCash+$creditTotal;
            $finalCalculas  = $totalCalculas-$debitTotal;
            $lastBalance    = $data->lastBalance;
            $lastHandCash   = $finalCalculas-$lastBalance;
        @endphp
    <div class="row">
        <button class="btn btn-warning btn-sm noprint col-3 col-md-1 mx-auto" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
    </div>
    <div class="row" id="printArea">
        <div class="col-12 col-md-6 mx-auto my-2">
            <div class="card">
                <div class="card-header fw-bold">Debit Details</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Purpose</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @if(isset($debit))
                                @foreach($debit as $d)
                                    <tr>
                                        <th scope="row">{{ $x }}</th>
                                        <td>{{ $d->details }}</td>
                                        <td>{{ $d->amount }}</td>
                                    </tr>
                                    @php
                                    $x++;
                                    @endphp
                                @endforeach
                                <tr><td colspan="3"><h4>Total Debit: {{ $debitTotal }}</h4></td></tr>
                            @else
                            <tr>
                                <td colspan="5">Sorry! No data found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mx-auto my-2">
            <div class="card">
                <div class="card-header fw-bold">Credit Details</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Purpose</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $y = 1;
                            @endphp
                            @if(isset($credit))
                                @foreach($credit as $c)
                                    <tr>
                                        <th scope="row">{{ $y }}</th>
                                        <td>{{ $c->details }}</td>
                                        <td>{{ $c->amount }}</td>
                                    </tr>
                                    @php
                                    $y++;
                                    @endphp
                                @endforeach
                                <tr><td colspan="3"><h4>Total Credit: {{ $creditTotal }}</h4></td></tr>
                            @else
                            <tr>
                                <td colspan="5">Sorry! No data found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-7 mx-auto my-2">
            <div class="card">
                <div class="card-header fw-bold">Final Calculas:- {{ Carbon\Carbon::parse($reportDate)->format('d-M-Y') }}</div>
                <div class="">
                    <table class="table table-bordered">
                        <tbody>
                            @if(isset($data))
                                <tr>
                                    <th scope="row">Opening Balance</th>
                                    <td>{{ $liquid }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Opening Cash</th>
                                    <td>{{ $handCash }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Credit</th>
                                    <td>{{ $creditTotal }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Total</th>
                                    <td>{{ $totalCalculas }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Debit</th>
                                    <td>{{ $debitTotal }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Final Calculas</th>
                                    <td>{{ $finalCalculas }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">EOD Balance</th>
                                    <td>{{ $lastBalance }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">EOD Cash</th>
                                    <td>{{ $lastHandCash }}</td>
                                </tr>
                            @else
                            <tr>
                                <td colspan="5">Sorry! No data found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-12 col-md-10 mx-auto my-2">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-info">Sorry! No data found with your query</div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection