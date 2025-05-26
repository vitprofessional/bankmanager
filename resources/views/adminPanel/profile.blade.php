@extends('adminPanel.include')
@section('calculasTitle') My Profile @endsection
@section('calculasBody')
<div class="row align-items-center v-100">
    <div class="col-10 col-md-6 mx-auto my-4">
        <div class="card">
            <div class="card-header">My Profile</div>
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
                    <form class="form col-11 mx-auto" action="{{ route('updateEmployeeProfile') }}" method="POST">
                        @csrf
                        <input type="hidden" name="employeeId" value="{{ $employee_id }}">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="employeeName"><i class="fa-thin fa-circle-user"></i></span>
                            <input type="text" class="form-control" placeholder="Enter your full name" aria-label="employeeName" value="{{ $employee->name }}" name="employeeName" aria-describedby="employeeName">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="employeeMail"><i class="fa-thin fa-envelope"></i></span>
                            <input type="text" class="form-control" placeholder="Enter your email" aria-label="employeeMail" value="{{ $employee->email }}" name="employeeMail" aria-describedby="employeeMail">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="employeeMobile"><i class="fa-thin fa-phone"></i></span>
                            <input type="text" class="form-control" placeholder="Enter your mobile number" aria-label="employeeMobile" value="{{ $employee->mobile }}" name="employeeMobile" aria-describedby="employeeMobile">
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-success" type="submit">
                                <i class="fa-solid fa-right-from-bracket fa-beat"></i> Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection