@extends('adminPanel.include')
@section('calculasTitle') Generate Account @endsection
<style type="text/css">
    .table>:not(caption)>*>* {
        padding: .3rem 0 !important;
        padding-left: 1rem !important;
    }
</style>
@section('calculasBody')
<div class="row align-items-center v-100">
    <div class="col-6">
    </div>
    @if(isset($data))
    <div class="row text-center">
        <div class="col-8 mx-auto">
            <button class="btn btn-warning btn-sm noprint mx-auto" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
            <a class="btn btn-success btn-sm noprint mx-auto" href="{{ route('accountCreation') }}"><i class="fas fa-plus"></i> Add New</a>
            <a href="{{ route('acList') }}" class="btn btn-primary btn-sm noprint mx-auto"><i class="fas fa-users"></i> Account List</a>
            <a href="{{ route('acEdit',['id'=>$data->id]) }}" class="btn btn-sm btn-success noprint mx-auto" title="Edit Data"><i class="fa-solid fa-file-pen"></i> Edit Data</a>
        </div>
    </div>
    <div class="row" id="printArea">
        <div class="col-8 col-md-6 mx-auto my-2 account">
            <div class="card">
                <div class="card-header fw-bold">Account Details</div>
                <div class="card-body">
                    <div class="row align-items-center p-2">
                        <div class="col-2">
                            <img src="{{ asset('/public/img/') }}/abLogo.jpg" alt="ABLOGO" class="w-75">
                        </div>
                        <div class="col-2">
                            <img src="{{ asset('/public/img/') }}/bankLogo.png" alt="BankLogo" class="w-100">
                        </div>
                        <div class="col-6">
                            <h6 class="fw-bold mb-0">Dutch Bangla Bank Plc</h6>
                        </div>
                        <div class="col-2">
                            <img src="{{ asset('/public/img/') }}/rocket.jpg" alt="ROCKET" class="w-75">
                        </div>
                        <div class="col-11 mx-auto text-center">
                            <p class="mb-0"><b>Branch: </b> Jhawtala SME/Krishi, Cumilla</p>
                            <p class="mb-0"><b>Routing Number: </b> 090191161, <b>SWIFT: </b> DBBLBDDH</p>
                            <p class="mb-0"><b>Contact: </b> 01784989898,  <b>Helpline: </b> 16216</p>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            @if(isset($data))
                                <tr>
                                    <th scope="row">A/C Name</th>
                                    <td colspan="3">{{ $data->acName }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">A/C Number</th>
                                    <td colspan="3">{{ $data->acNumber }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Type of Account</th>
                                    <td colspan="3">{{ $data->acType }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Mobile Number</th>
                                    <td colspan="3">{{ $data->acMobile }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">A/C Finger</th>
                                    <td>{{ $data->acFinger }}</td>
                                    <th scope="row">Outlet Name</th>
                                    <td>Virtual IT Professional</td>
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