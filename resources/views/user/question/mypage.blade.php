@extends ('common.user')
@section ('content')

<h2 class="brand-header">
  <img src="" class="avatar-img">&nbsp;&nbsp;My page
</h2>
<div class="main-wrap">
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-2">date</th>
          <th class="col-xs-1">category</th>
          <th class="col-xs-5">title</th>
          <th class="col-xs-2">comments</th>
          <th class="col-xs-1"></th>
          <th class="col-xs-1"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($myQuestions as $question)
        <tr class="row">
          <td class="col-xs-2">{{ $question->created_at->format('Y-m-d') }}</td>
          <td class="col-xs-1">
            @foreach ($question->tagCategories as $tagCategory)
            @if ($loop->last)
            {{ $tagCategory->name }}&nbsp;
            @else
            {{ $tagCategory->name }}
            @endif
            @endforeach
          </td>
          <td class="col-xs-5">{{ $question->title }}</td>
          <td class="col-xs-2"><span class="point-color">{{ $question->comments_count }}</span></td>
          <td class="col-xs-1">
            <a class="btn btn-success" href="{{ route('question.show.edit', $question->id) }}">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
          </td>
          <td class="col-xs-1">
            {!! Form::open(['route' => ['question.delete', $question->id]]) !!}
              @method('DELETE')
              {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div aria-label="Page navigation example" class="text-center">{{ $myQuestions->links() }}</div>
  </div>
</div>

@endsection

