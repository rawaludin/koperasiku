@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Your API Token is <code>{{ auth()->user()->api_token }}</code>
                    <a href="{{ route('token.regenerate') }}" class="btn btn-primary">Regenerate</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
