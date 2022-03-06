@extends('master')

@section('content')
    {{ $user->name }}

    <a href="/logout/">logout</a>
@endsection
