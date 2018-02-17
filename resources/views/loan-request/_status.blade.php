@switch($loanRequest->status)
    @case('Approved')
    @case('Rejected')
    @case('Waiting Approval')
        <a href="{{ route('loan-requests.show', $loanRequest->id) }}">Tampilkan </a>
        @break
    @case('Draft')
        {!! Form::open(['route' => ['loan-requests.destroy', $loanRequest->id], 'method' => 'delete', 'class' => 'form-inline'] ) !!}
            <a href="{{ route('loan-requests.show', $loanRequest->id) }}">Tampilkan </a> | 
            <a href="{{ route('loan-requests.edit', $loanRequest->id) }}">Ubah</a>
            {!! Form::hidden('page', request()->get('page')) !!}
            {!! Form::submit('Batalkan', ['class'=>'btn btn-sm btn-danger']) !!}
        {!! Form::close()!!}
        @break
@endswitch
