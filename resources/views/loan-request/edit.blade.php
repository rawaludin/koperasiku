@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">Ubah Pinjaman</div>

                <div class="card-body">
                    {!! Form::model($loanRequest, ['route' => ['loan-requests.update', $loanRequest->id], 'method' => 'put']) !!}
                        @include('loan-request._form')
                    {!! Form::close() !!} 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
