@extends ('common.admin')
@section ('content')

<h2 class="brand-header">書籍購入情報一覧</h2>
<div class="main-wrap">
  <div class="btn-wrapper">
    {!! Form::open(['route' => 'admin.book.csv', 'enctype' => 'multipart/form-data']) !!}
      <div class="form-group has-error">
        {!! Form::file('file', ['class' => 'form-control']) !!}
        <span class="help-block"></span>
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
        <tr class="row">
          <td class="col-xs-1"><img src="" alt="" class="avatar-img"></td>
          <td class="col-xs-4"></td>
          <td class="col-xs-2"></td>
          <td class="col-xs-2"></td>
          <td class="col-xs-1"></td>
          <td class="col-xs-2"></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

@endsection
