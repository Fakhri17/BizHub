@extends('layouts.app')

@section('title', 'Home')

@section('content')
{{-- starter kits --}}

<h1>Welcom to homepage</h1>
<h2 x-data="{ message: 'I ❤️ Alpine' }" x-text="message"></h2>

@endsection