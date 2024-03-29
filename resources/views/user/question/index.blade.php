@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問一覧</h2>
<div class="main-wrap">
  {!! Form::open(['route' => 'question.index', 'method' => 'GET', 'id' => 'question-search-form']) !!}
    <div class="btn-wrapper">
      <div class="search-box">
        {!! Form::text('search_word', null, ['placeholder' => 'Search words...', 'class' => 'form-control search-form']) !!}
        {!! Form::button('<i class="fa fa-search" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'search-icon']) !!}
      </div>
      <a class="btn" href="{{ route('question.show.create') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
      <a class="btn" href="{{ route('question.show.mypage') }}">
        <i class="fa fa-user" aria-hidden="true"></i>
      </a>
      <a class="btn" href="{{ route('question.ranking.user_questions') }}">
        <i class="fa fa-trophy" aria-hidden="true"></i>
      </a>
    </div>
    <div class="category-wrap">
      <div class="btn all">all</div>
      @foreach ($tagCategories as $categoryId => $categoryName)
      <div class="btn {{ $categoryName }}" id="{{ $categoryId }}">{{ $categoryName }}</div>
      @endforeach
      {!! Form::hidden('tag_category_id', null, ['id' => 'category-val']) !!}
    </div>
  {!! Form::close() !!}
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-1">user</th>
          <th class="col-xs-2">category</th>
          <th class="col-xs-6">title</th>
          <th class="col-xs-1">comments</th>
          <th class="col-xs-2"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($questions as $question)
        <tr class="row">
          <td class="col-xs-1">{{ $question->user->name }}<img src="{{ $question->user->avatar }}" class="avatar-img"></td>
          <td class="col-xs-2">
            @foreach ($question->tagCategories as $tagCategory)
            @if ($loop->last)
            {{ $tagCategory->name }}
            @else
            {{ $tagCategory->name }}&nbsp;
            @endif
            @endforeach
          </td>
          <td class="col-xs-6">{{ str_limit($question->title, 30, '...') }}</td>
          <td class="col-xs-1"><span class="point-color">{{ $question->comments_count }}</span></td>
          <td class="col-xs-2">
            <a class="btn btn-success" href="{{ route('question.show.detail', $question->id) }}">
              <i class="fa fa-comments-o" aria-hidden="true"></i>
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div aria-label="Page navigation example" class="text-center">{{ $questions->appends(request()->query())->links() }}</div>
  </div>
</div>

@endsection

