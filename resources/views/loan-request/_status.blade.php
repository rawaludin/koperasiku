{!! Form::open(['route' => ['loan-requests.destroy', $loanRequest->id], 'method' => 'delete', 'class' => 'form-inline'] ) !!}
    {!! Form::hidden('page', request()->get('page')) !!}
    {!! Form::submit('Batalkan', ['class'=>'btn btn-sm btn-danger']) !!}

{!! Form::close()!!}
