@extends('layouts.template')
@section('content')
    @if(Session::has('message'))
        <div class="alert alert-info">
            {{Session::get('message')}}
      </div>
    @endif
    <form method="get" action="{{ route('sessions.destroy') }}">
        <button type="submit">로그아웃</button>
    </form>
@endsection