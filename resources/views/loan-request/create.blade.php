@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">Pinjaman Baru</div>

                <div class="card-body">
                    {!! Form::open(['route' => 'loan-requests.store']) !!}

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            {!! Form::label('Jumlah pinjaman') !!}
                            {!! Form::number('amount', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('amount', '<p class="text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Lama pinjaman (bln)') !!}
                            {!! Form::number('duration', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('duration', '<p class="text-danger">:message</p>') !!}
                        </div>
                        <div class="form-check">
                            {!! Form::checkbox('is_submitted', 1, null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('Ajukan sekarang.') !!}
                            {!! $errors->first('is_submitted', '<p class="text-danger">:message</p>') !!}
                        </div>
                    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!} 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
