@extends('adminPanel.include')
@section('calculasTitle') Account List @endsection
@section('calculasBody')
<div class="row align-items-center v-100">
    <div class="col-10 col-md-10 mx-auto my-4">
        <div class="card">
            <div class="card-header">Account List</div>
            <div class="card-body">
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
                    <div class="col-6">
                        <a class="btn btn-success btn-sm noprint mx-auto mb-3" href="{{ route('accountCreation') }}"><i class="fas fa-plus"></i> Add New</a>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Account Name</th>
                            <th scope="col">Account Number</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $data   = \App\Models\AccountList::orderBy('id','DESC')->get();
                            $x = 1;
                        @endphp
                        @if(!empty($data) && count((array)$data)>0)
                            @foreach($data as $d)
                                <tr>
                                    <th scope="row">{{ $x }}</th>
                                    <td>{{ $d->acName }}</td>
                                    <td>{{ $d->acNumber }}</td>
                                    <td>{{ $d->acMobile }}</td>
                                    <td>
                                        <a href="{{ route('acView',['id'=>$d->id]) }}" class="btn btn-sm btn-info text-white" title="View Data"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{ route('acEdit',['id'=>$d->id]) }}" class="btn btn-sm btn-success" title="Edit Data"><i class="fa-solid fa-file-pen"></i></a>
                                        <a href="{{ route('acDelete',['id'=>$d->id]) }}" onclick="confirm('Are you sure to delete this record?')" class="btn btn-sm btn-danger" title="Delete Record"><i class="fa-thin fa-trash-xmark"></i></a>
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