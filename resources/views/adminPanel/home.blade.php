@extends('adminPanel.include')
@section('calculasTitle') Homepage @endsection
@section('calculasBody')
@php
    $today  =   date('Y-m-d');
@endphp
<div class="row align-items-center v-100">
    <div class="col-10 col-md-6 mx-auto my-4">
        @if(Session::has('cashier'))
        <div class="card">
            <div class="card-header fw-bold">Cash Calcuals - {{ $today }}</div>
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
            @php
                $dateToday  = date('Y-m-d');
                $data   = \App\Models\BankCapital::whereDate('created_at',$dateToday)->where('employee_id',$employee_id)->first();
                if(isset($data)):
                    $liquid         = $data->ob;
                    $handCash       = $data->cb;
                    $lastBalance    = $data->lastBalance;
                    $totalBalance   = $liquid+$handCash;
                else:
                    $liquid         = "";
                    $handCash       = "";
                    $lastBalance    = "";
                    $totalBalance   = "";
                endif;
            @endphp
            @if(isset($capitalId))
            <form class="row g-3 card-body" method="POST" action="{{ route('updateCalculas') }}">
                @csrf
                <input type="hidden" name="capitalId" value="{{ $capitalId }}">
                <div class="col-12">
                    <label for="liquid" class="form-label">Liquid Balance</label>
                    <input type="number" class="form-control" value="{{ $liquid }}" name="liquid" id="liquid" placeholder="Enter the liquid of bank today" required />
                </div>
                <div class="col-12">
                    <label for="handCash" class="form-label">Hand Cash</label>
                    <input type="number" class="form-control" value="{{ $handCash }}" id="handCash" name="handCash" placeholder="Enter the hand cash of bank today" required />
                </div>
                <div class="col-12">
                    <label for="handCash" class="form-label">Last Balance</label>
                    <input type="number" class="form-control" value="{{ $lastBalance }}" id="lastBalance" name="lastBalance" placeholder="Enter the last balance of bank today" required />
                </div>
                <div class="col-12">
                    <label for="handCash" class="form-label">Total Balance</label>
                    <input type="number" class="form-control" value="{{ $totalBalance }}" readonly />
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    <a href="{{ route('home') }}" class="btn btn-success btn-sm">Homepage</a>
                </div>
            </form>
            @else
                @if(isset($data))
                <div class="card-body row">
                    <div class="col-12">
                        <div class="h3"><b>Liquid Balance:</b> {{ $liquid }}</div>
                        <div class="h3"><b>Hand Cash:</b> {{ $handCash }}</div>
                        <div class="h3"><b>Last Balance:</b> {{ $lastBalance }}</div>
                        <div class="h3"><b>Total:</b> {{ $totalBalance }}</div>
                        <a href="{{ route('editCalculas',['id'=>$data->id]) }}" class="btn btn-danger btn-sm">Edit</a>
                    </div>
                </div>
                @else
                <form class="row g-3 card-body" method="POST" action="{{ route('saveCalculas') }}">
                    @csrf
                    <input type="hidden" name="employeeId" value="{{ $employee_id }}">
                    <div class="col-12">
                        <label for="liquid" class="form-label">Liquid Balance</label>
                        <input type="number" class="form-control" name="liquid" id="liquid" placeholder="Enter the liquid of bank today" required />
                    </div>
                    <div class="col-12">
                        <label for="handCash" class="form-label">Hand Cash</label>
                        <input type="number" class="form-control" id="handCash" name="handCash" placeholder="Enter the hand cash of bank today" required />
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
                @endif
            @endif
        </div>
        @else
        <div class="alert alert-info">
            Please login as cashier to do any cash related service. Admin can not work on calculas related work like Debit/Credit Page etc.
        </div>
        @endif
    </div>
</div>
@endsection