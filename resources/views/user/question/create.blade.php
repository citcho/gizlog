@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問投稿</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'question.create.confirm', 'method' => 'GET']) !!}
      <div class="form-group">
        {!! Form::select('tag_category_id', $tagCategories, null, ['class' => 'form-control selectpicker form-size-small', 'placeholder' => 'Select category']) !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'title']) !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Please write down your question here...', 'cols' => 50, 'rows' => 10]) !!}
        <span class="help-block"></span>
      </div>
      {!! Form::button('create', ['class' => 'btn btn-success pull-right', 'type' => 'submit']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection
