@extends('adminPanel.include')
@section('calculasTitle') Debit/Credit @endsection
@section('calculasBody')
<div class="row align-items-center v-100">
    <div class="col-10 col-md-6 mx-auto my-4">
        <div class="card">
            <div class="card-header">Debit/Credit Entry</div>
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
                if(isset($data)):
                    $amount     = $data->amount;
                    $details    = $data->details;
                    $txnType    = $data->txnType;
                    $dcId       = $data->id;
                else:
                    $amount     = "";
                    $details    = "";
                    $txnType    = "";
                    $dcId       = "";
                endif;
            @endphp
            <form class="row g-3 card-body" method="POST" action="{{ route('saveDebitCredit') }}">
                @csrf
                <input type="hidden" value="{{ $dcId }}" name="dcId">
                <input type="hidden" name="employeeId" value="{{ $employee_id }}">
                <div class="col-12">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" class="form-control" value="{{ $amount }}" name="amount" id="amount" placeholder="Enter the amount of transaction" />
                </div>
                <div class="col-12">
                    <label for="note" class="form-label">Note</label>
                    <input type="text" class="form-control" value="{{ $details }}" id="note" name="note" placeholder="Please note the subject of purpose" />
                </div>
                <div class="col-12">
                    <label for="type" class="form-label">Type</label>
                    <select id="type" class="form-select" name="txnType">
                        @if(!empty($txnType))
                        <option value="{{ $txnType }}">{{ $txnType }}</option>
                        @endif
                        <option value="Debit">Debit</option>
                        <option value="Credit">Credit</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-10 mx-auto my-4">
        <div class="card">
            <div class="card-header">Debit/Credit Details</div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Purpose</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Type</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $today  = date('Y-m-d');
                            $data   = \App\Models\DebitCredit::whereDate('created_at',$today)->where(['employee_id'=>$employee_id])->orderBy('id','DESC')->get();
                            $x = 1;
                        @endphp
                        @if(isset($data) && count($data)>0)
                            @foreach($data as $d)
                                <tr>
                                    <th scope="row">{{ $x }}</th>
                                    <td>{{ $d->details }}</td>
                                    <td>{{ $d->amount }}</td>
                                    <td>{{ $d->txnType }}</td>
                                    <td>
                                        <a href="{{ route('editDCdata',['id'=>$d->id]) }}" class="btn btn-sm btn-success" title="Edit Data"><i class="fa-solid fa-file-pen"></i></a>
                                        <a href="{{ route('delDCdata',['id'=>$d->id]) }}" onclick="confirm('Are you sure to delete this record?')" class="btn btn-sm btn-danger" title="Delete Record"><i class="fa-thin fa-trash-xmark"></i></a>
                                    </td>
                                </tr>
                                @php
                                $x++;
                                @endphp
                            @endforeach
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
@endsection