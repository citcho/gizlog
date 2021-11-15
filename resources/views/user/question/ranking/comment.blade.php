@extends ('common.user')
@section ('content')

<h2 class="brand-header">ランキング&nbsp;「コメントが多いユーザー」</h2>
<div class="main-wrap">
  <div class="content-wrapper table-responsive">
    @include('user.question.components.select_ranking')
    <table class="table table-striped">
      <thead>
        <tr class="rows">
          <th class="col-xs-1">Rank</th>
          <th class="col-xs-1"></th>
          <th class="col-xs-2">User</th>
          <th class="col-xs-4">Comment Count</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($commentRanking as $rank => $user)
          <tr class="rows">
            <td class="col-xs-1">{{ $rank + 1 }}</td>
            <td class="col-xs-1"><img src="{{ $user->avatar }}" class="avatar-img"></td>
            <td class="col-xs-2">{{ $user->name }}</td>
            <td class="col-xs-4">{{ $user->comment_count }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div aria-label="Page navigation example" class="text-center">
      {{ $commentRanking->links() }}
    </div>
  </div>
</div>

@endsection

@push('js')

<script src="{{ asset('js/ranking.js') }}"></script>

@endpush