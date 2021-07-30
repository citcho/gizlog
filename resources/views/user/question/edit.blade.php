@extends ('common.user')
@section ('content')

<h1 class="brand-header">質問編集</h1>

<div class="main-wrap">
  <div class="container">
    {!! Form::open() !!}
      <div class="form-group">
        {!! Form::select('tag_category_id', $tagCategories , $myQuestion->tag_category_id, ['class' => 'form-control selectpicker form-size-small']) !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        {!! Form::text('title', $myQuestion->title, ['class' => 'form-control', 'placeholder' => 'title']) !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        {!! Form::textarea('content', $myQuestion->content, ['class' => 'form-control', 'placeholder' => 'Please write down your question here...', 'cols' => 50, 'rows' => 10]) !!}
        <span class="help-block"></span>
      </div>
      {!! Form::button('UPDATE', ['name' => 'confirm', 'type' => 'submit', 'class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

