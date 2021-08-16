@extends ('common.admin')
@section ('content')

<h2 class="brand-header">書籍購入情報一覧</h2>
<div class="main-wrap">
  <div class="btn-wrapper">
    {!! Form::open(['route' => 'admin.book.csv', 'enctype' => 'multipart/form-data']) !!}
      <div class="form-group @if ($errors->has('file')) has-error @endif">
        {!! Form::file('file') !!}
        @if ($errors->has('file'))
        @foreach ($errors->get('file') as $error)
        <span class="help-block">{{ $error }}</span>
        @endforeach
        @endif

        @if (session('flash_message'))
        <span class="help-block">{{ session('flash_message') }}</span>
        @endif
        {!! Form::button('<i class="fa fa-file"></i>', ['type' => 'submit', 'class' => 'btn btn-icon']) !!}
      </div>
    {!! Form::close() !!}
  </div>
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-1">購入者</th>
          <th class="col-xs-4">書籍タイトル</th>
          <th class="col-xs-2">著者</th>
          <th class="col-xs-2">出版社</th>
          <th class="col-xs-1">価格</th>
          <th class="col-xs-2">購入日</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($books as $book)
        <tr class="row">
          <td class="col-xs-1"><img src="{{ $book->user->avatar }}" alt="" class="avatar-img"></td>
          <td class="col-xs-4">{{ $book->title }}</td>
          <td class="col-xs-2">{{ $book->author }}</td>
          <td class="col-xs-2">{{ $book->publisher }}</td>
          <td class="col-xs-1">{{ $book->price }}</td>
          <td class="col-xs-2">{{ $book->purchase_date }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="text-center">{{ $books->links() }}</div>
  </div>
</div>

@endsection
