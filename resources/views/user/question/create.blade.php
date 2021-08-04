@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問投稿</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'question.create.confirm']) !!}
      <div class="form-group">
        @include('user.question.components.select_category', ['tagCategories' => $tagCategories])
      </div>
      <div class="form-group">
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'title']) !!}
        @if ($errors->has('title'))
        @foreach ($errors->get('title') as $error)
        <span class="help-block">{{ $error }}</span>
        @endforeach
        @endif
      </div>
      <div class="form-group">
        {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Please write down your question here...', 'cols' => 50, 'rows' => 10]) !!}
        @if ($errors->has('content'))
        @foreach ($errors->get('content') as $error)
        <span class="help-block">{{ $error }}</span>
        @endforeach
        @endif
      </div>
      {!! Form::button('create', ['class' => 'btn btn-success pull-right', 'type' => 'submit']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection
