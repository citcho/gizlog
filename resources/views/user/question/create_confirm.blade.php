@extends ('common.user')
@section ('content')

<h2 class="brand-header">投稿内容確認</h2>
<div class="main-wrap">
  <div class="panel panel-success">
    <div class="panel-heading">
      @foreach ($question->tag_category_id_list as $tagCategory)
      {{ $tagCategory->name }}&nbsp;
      @endforeach
      の質問
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
            <td class='td-text'>{{ $question->content }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="btn-bottom-wrapper">
    {!! Form::open(['route' => 'question.create']) !!}
      @foreach ($question->tag_category_id_list as $tagCategory)
      <input name="tag_category_id[]" type="hidden" value='{{ $tagCategory->id }}'>
      @endforeach
      {!! Form::hidden('title', $question->title) !!}
      {!! Form::hidden('content', $question->content) !!}
      {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

