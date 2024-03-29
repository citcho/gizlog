@extends ('common.user')
@section ('content')

<h1 class="brand-header">質問詳細</h1>
<div class="main-wrap">
  <div class="panel panel-success">
    <div class="panel-heading">
      <img src="{{ $question->user->avatar }}" class="avatar-img">
      <p>{{ $question->user->name }}さんの質問&nbsp;
        (
        @foreach ($question->tagCategories as $tagCategory)
        @if ($loop->last)
        {{ $tagCategory->name }}
        @else
        {{ $tagCategory->name }}&nbsp;
        @endif
        @endforeach
        )
      </p>
      <p class="question-date">{{ $question->created_at->format('Y-m-d') }}</p>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th class="table-column">Title</th>
            <td class="td-text">{{ $question->title }}</td>
          </tr>
          <tr>
            <th class="table-column">Question</th>
            <td class='td-text'>{!! nl2br(e($question->content)) !!}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
    @foreach ($question->comments as $comment)
    <div class="comment-list">
        <div class="comment-wrap">
          <div class="comment-title">
            <img src="{{ $comment->user->avatar }}" class="avatar-img">
            <p>{{ $comment->user->name }}</p>
            <p class="comment-date">{{ $comment->created_at->format('Y-m-d') }}</p>
          </div>
          <div class="comment-body">{!! nl2br(e($comment->content)) !!}</div>
        </div>
    </div>
    @endforeach
  <div class="comment-box">
    {!! Form::open(['route' => 'question.create.comment']) !!}
    {!! Form::hidden('question_id', $question->id) !!}
      <div class="comment-title">
        <img src="{{ Auth::user()->avatar }}" class="avatar-img"><p>コメントを投稿する</p>
      </div>
      <div class="comment-body">
        {!! Form::textarea('comment', null, ['class' => 'form-control', 'placeholder' => 'Add your comment...', 'cols' => 50, 'rows' => 10]) !!}
        @if ($errors->has('comment'))
        @foreach ($errors->get('comment') as $error)
        <span class="help-block">{{ $error }}</span>
        @endforeach
        @endif
      </div>
      <div class="comment-bottom">
        {!! Form::button('<i class="fa fa-pencil" aria-hidden="true"></i>',['type' => 'submit', 'class' => 'btn btn-success']) !!}
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection