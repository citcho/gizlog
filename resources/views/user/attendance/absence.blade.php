@extends ('common.user')
@section ('content')

<h2 class="brand-header">欠席登録</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'attendance.absence']) !!}
      <div class="form-group @if ($errors->has('reason')) has-error @endif">
        {!! Form::textarea('reason', null, ['class' => 'form-control', 'placeholder' => '欠席理由を入力してください。', 'cols' => 50, 'rows' => 10]) !!}
      </div>
      @if ($errors->has('reason'))
        <span class="has-error">{{ $errors->first() }}</span>
      @endif
      {!! Form::submit('登録', ['class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

