@extends('layouts.app')

@section('content')
<div class="container">
    <p>
        {{ $exception->getMessage() }}
    </p>
</div>
@endsection

