@extends('layouts.main')

@section('title', 'Seller Dashboard')

@section('content')
    <h1>Welcome Seller, {{ $user->name }}</h1>
    <p>Ini halaman dashboard khusus seller.</p>
@endsection
