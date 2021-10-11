@extends ('common.user')
@section ('content')

<h2 class="brand-header">ランキング&nbsp;「質問数が多いタグ」</h2>
<div class="main-wrap">
  <div class="content-wrapper table-responsive">
    @include('user.question.components.select_ranking')
    <table class="table table-striped">
      <thead>
        <tr class="rows">
          <th class="col-xs-1">Rank</th>
          <th class="col-xs-1">Tag</th>
          <th class="col-xs-2">Question Count</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categoryRanking as $rank => $category)
          <tr class="rows">
            <td class="col-xs-1">{{ $rank + 1 }}</td>
            <td class="col-xs-1">{{ $category->name }}</td>
            <td class="col-xs-2">{{ $category->question_count }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div aria-label="Page navigation example" class="text-center">
      {{ $categoryRanking->links() }}
    </div>
  </div>
</div>

@endsection

@push('js')

<script src="{{ asset('js/ranking.js') }}"></script>

@endpush