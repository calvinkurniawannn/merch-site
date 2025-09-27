@extends('layouts.main')

@section('title', 'User Dashboard')

@section('content')
    <h1>Welcome Users, {{ $user->name }}</h1>
    <p>Ini halaman dashboard khusus user kamu.</p>
@endsection
