@extends ('common.user')
@section ('content')

<h2 class="brand-header">勤怠登録</h2>

<div class="main-wrap">

  <div id="clock" class="light">
    <div class="display">
      <div class="weekdays"></div>
      <div class="today"></div>
      <div class="digits"></div>
    </div>
  </div>
  <div class="button-holder">
    <a class="button start-btn" id="register-attendance" href=#openModal>出社時間登録</a>
  </div>
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="text-center">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <ul class="button-wrap">
    <li>
      <a class="at-btn absence" href="{{ route('attendance.show.absence') }}">欠席登録</a>
    </li>
    <li>
      <a class="at-btn modify" href="{{ route('attendance.show.modify') }}">修正申請</a>
    </li>
    <li>
      <a class="at-btn my-list" href="{{ route('attendance.show.mypage') }}">マイページ</a>
    </li>
  </ul>
</div>

<div id="openModal" class="modalDialog">
  <div>
    <div class="register-text-wrap"></div>
    <div class="register-btn-wrap">
      {!! Form::open(['route' => 'attendance.store.start_time']) !!}
        {!! Form::hidden('start_time', null, ['id' => 'time-target']) !!}
        {!! Form::hidden('date', null, ['id' => 'date-target']) !!}
        <a href="#close" class="cancel-btn">Cancel</a>
        {!! Form::submit('Yes', ['class' => 'yes-btn']) !!}
      {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection

