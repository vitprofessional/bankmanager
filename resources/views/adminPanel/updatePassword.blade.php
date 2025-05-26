@extends('adminPanel.include')
@section('calculasTitle') Password Change @endsection
@section('calculasBody')
<div class="row align-items-center v-100">
    <div class="col-10 col-md-6 mx-auto my-4">
        <div class="card">
            <div class="card-header">Password Change</div>
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
                    <form class="form col-11 mx-auto" action="{{ route('updatePassword') }}" method="POST">
                        @csrf
                        <input type="hidden" name="employeeId" value="{{ $employee_id }}">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="loginPass"><i class="fa-thin fa-key"></i></span>
                            <input type="password" class="form-control" placeholder="Enter current password" aria-label="loginPass" name="loginPass" aria-describedby="loginPass" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="newPass"><i class="fa-thin fa-key"></i></span>
                            <input type="password" class="form-control" placeholder="Enter new password" aria-label="newPass" name="newPass" aria-describedby="newPass" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="confirmPass"><i class="fa-thin fa-key"></i></span>
                            <input type="password" class="form-control" placeholder="Confirm new password" aria-label="confirmPass" name="confirmPass" aria-describedby="confirmPass" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-success" type="submit">
                                <i class="fa-solid fa-right-from-bracket fa-beat"></i> Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection