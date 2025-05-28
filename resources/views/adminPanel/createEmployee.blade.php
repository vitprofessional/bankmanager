@extends('adminPanel.include')
@section('calculasTitle') Employee Profile @endsection
@section('calculasBody')
<div class="row align-items-center v-100">
    <div class="col-10 col-md-6 mx-auto my-4">
        <div class="card">
            <div class="card-header">@if(isset($profile)) Update @else New @endif Employee</div>
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
                    @php
                        if(isset($profile)):
                            $userName       = $profile->name;
                            $email          = $profile->email;
                            $loginId        = $profile->employeeId;
                            $mobile         = $profile->mobile;
                            $profileType    = $profile->profileType;
                            $profileId      = $profile->id;
                        else:
                            $userName       = "";
                            $email          = "";
                            $loginId        = "";
                            $mobile         = "";
                            $profileType    = "";
                            $profileId      = "";
                        endif;
                    @endphp
                    <form class="form col-11 mx-auto" action="{{ route('createEmployee') }}" method="POST">
                        @csrf
                        <input type="hidden" name="profileId" value="{{ $profileId }}">
                        <input type="hidden" name="employeeId" value="{{ $employee_id }}">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="employeeName"><i class="fa-thin fa-circle-user"></i></span>
                            <input type="text" class="form-control" placeholder="Enter employee name" aria-label="employeeName" value="{{ $userName }}" name="employeeName" aria-describedby="employeeName">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="employeeMail"><i class="fa-thin fa-envelope"></i></span>
                            <input type="text" class="form-control" placeholder="Enter employee email" aria-label="employeeMail" value="{{ $email }}" name="employeeMail" aria-describedby="employeeMail" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="loginId"><i class="fa-thin fa-lock"></i></span>
                            <input type="text" class="form-control" placeholder="Enter login ID" aria-label="loginId" value="{{ $loginId }}" name="loginId" aria-describedby="loginId" required>
                        </div>
                        @if(!isset($profile))
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="loginPass"><i class="fa-thin fa-key"></i></span>
                            <input type="password" class="form-control" placeholder="Enter password" aria-label="loginPass" name="loginPass" aria-describedby="loginPass" required>
                        </div>
                        @endif
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="profileType"><i class="fa-light fa-layer-group"></i></span>
                            <select name="profileType" id="profileType" class="form-control">
                                @if(!empty($profileType))
                                    <option value="4">@if($profileType==1) Super Admin @elseif($profileType==2) General Admin @elseif($profileType==3) Manager @else Cashier @endif</option>
                                @endif
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
                        <div class="input-group mb-3">
                            @if(isset($profile))
                            <button class="btn btn-success" type="submit">
                                <i class="fa-solid fa-right-from-bracket fa-beat"></i>  Update Profile
                            </button>
                            <a href="{{ route('bankEmployee') }}" class="btn btn-primary">Go Back</a>
                            @else
                            <button class="btn btn-success" type="submit">
                                <i class="fa-solid fa-right-from-bracket fa-beat"></i>  Create Profile
                            </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(!isset($profile))
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
                            <th scope="col">Profile Type</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $today  = date('Y-m-d');
                            $x = 1;
                        @endphp
                        @if(!empty($data) && $data->count()>0)
                            @foreach($data as $d)
                                <tr>
                                    <th scope="row">{{ $x }}</th>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->employeeId }}</td>
                                    <td>{{ $d->mobile }}</td>
                                    <td>@if($d->profileType==1) Super Admin @elseif($d->profileType==2) General Admin @elseif($d->profileType==3) Manager @else Cashier @endif</td>
                                    <td>
                                        @if($d->id == $employee_id)
                                        -
                                        @else
                                        <a href="{{ route('editEmployee',['id'=>$d->id]) }}" class="btn btn-sm btn-success" title="Edit Data"><i class="fa-solid fa-file-pen"></i></a>
                                        <a href="{{ route('delEmployee',['id'=>$d->id]) }}" onclick="confirm('Are you sure to delete this record?')" class="btn btn-sm btn-danger" title="Delete Record"><i class="fa-thin fa-trash-xmark"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                $x++;
                                @endphp
                            @endforeach
                        @else
                        <tr>
                            <td colspan="6">Sorry! No data found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection