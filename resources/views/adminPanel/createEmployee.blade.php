@extends('adminPanel.include')
@section('calculasTitle') Employee Profile @endsection
@section('calculasBody')
<div class="row align-items-center v-100">
    <div class="col-10 col-md-6 mx-auto my-4">
        <div class="card">
            <div class="card-header">New Employee</div>
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
                    <form class="form col-11 mx-auto" action="{{ route('createEmployee') }}" method="POST">
                        @csrf
                        <input type="hidden" name="employeeId" value="{{ $employee_id }}">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="employeeName"><i class="fa-thin fa-circle-user"></i></span>
                            <input type="text" class="form-control" placeholder="Enter employee name" aria-label="employeeName" name="employeeName" aria-describedby="employeeName">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="employeeMail"><i class="fa-thin fa-envelope"></i></span>
                            <input type="text" class="form-control" placeholder="Enter employee email" aria-label="employeeMail" name="employeeMail" aria-describedby="employeeMail" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="loginId"><i class="fa-thin fa-lock"></i></span>
                            <input type="text" class="form-control" placeholder="Enter login ID" aria-label="loginId" name="loginId" aria-describedby="loginId" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="loginPass"><i class="fa-thin fa-key"></i></span>
                            <input type="password" class="form-control" placeholder="Enter password" aria-label="loginPass" name="loginPass" aria-describedby="loginPass" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="profileType"><i class="fa-light fa-layer-group"></i></span>
                            <select name="profileType" id="profileType" class="form-control">
                                @if(Session::get('superAdmin'))
                                <option value="4">Cashier</option>
                                <option value="3">Manager</option>
                                <option value="2">General Admin</option>
                                <option value="1">Super Admin</option>
                                @elseif(Session::get('generalAdmin'))
                                <option value="4">Cashier</option>
                                <option value="3">Manager</option>
                                @else
                                <option value="4">Cashier</option>
                                @endif
                            </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-success" type="submit">
                                <i class="fa-solid fa-right-from-bracket fa-beat"></i> Create Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-10 mx-auto my-4">
        <div class="card">
            <div class="card-header">Employee List</div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $today  = date('Y-m-d');
                            $x = 1;
                        @endphp
                        @if(isset($data) && count($data)>0)
                            @foreach($data as $d)
                                <tr>
                                    <th scope="row">{{ $x }}</th>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->employeeId }}</td>
                                    <td>{{ $d->mobile }}</td>
                                    <td>
                                        <a href="{{ route('editEmployee',['id'=>$d->id]) }}" class="btn btn-sm btn-success" title="Edit Data"><i class="fa-solid fa-file-pen"></i></a>
                                        <a href="{{ route('delEmployee',['id'=>$d->id]) }}" onclick="confirm('Are you sure to delete this record?')" class="btn btn-sm btn-danger" title="Delete Record"><i class="fa-thin fa-trash-xmark"></i></a>
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