@extends ('common.user')
@section ('content')

<h1 class="brand-header">質問編集</h1>

<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['question.edit.confirm', $myQuestion->id]]) !!}
      <div class="form-group">
        @include('user.question.components.update_category', ['myQuestion' => $myQuestion, 'tagCategories' => $tagCategories])
      </div>
      <div class="form-group">
        {!! Form::text('title', $myQuestion->title, ['class' => 'form-control', 'placeholder' => 'title']) !!}
        @if ($errors->has('title'))
        @foreach ($errors->get('title') as $error)
        <span class="help-block">{{ $error }}</span>
        @endforeach
        @endif
      </div>
      <div class="form-group">
        {!! Form::textarea('content', $myQuestion->content, ['class' => 'form-control', 'placeholder' => 'Please write down your question here...', 'cols' => 50, 'rows' => 10]) !!}
        @if ($errors->has('content'))
        @foreach ($errors->get('content') as $error)
        <span class="help-block">{{ $error }}</span>
        @endforeach
        @endif
      </div>
      {!! Form::button('UPDATE', ['type' => 'submit', 'class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

