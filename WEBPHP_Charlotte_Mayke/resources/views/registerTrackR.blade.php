@extends('layouts.app')

@section('content')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" style="width: 500px; margin:auto; margin-bottom: 10px;">{{ $error }}</div>
        @endforeach
    @endif
    <div style="margin: auto; background-color: white; border: solid; border-color: black; padding: 20px; border-width: 2px; width: 500px; text-align: center;">
        <form action="{{ route('createWebshop') }}" method="post">
            @csrf
            <h3 style="text-align: center;">Registreer een webshop</h3>
            <input type="text" class="form-control" name="name" placeholder="username" style="width: 300px; text-align: center; margin: auto; margin-top: 10px; margin-bottom: 10px;">
            <input type="text" class="form-control" name="email" placeholder="email" style="width: 300px; text-align: center; margin: auto;">
            <input type="password" class="form-control" name="password" placeholder="password" style="width: 300px; text-align: center; margin: auto; margin-top: 10px; margin-bottom: 10px;">
            <input type="password" class="form-control" name="password_confirmation" placeholder="confirm password" style="width: 300px; text-align: center; margin: auto; margin-top: 10px; margin-bottom: 10px;">

            <button type="submit" class="btn btn-dark" name="submit" style="margin-top: 10px; width: 300px;">Submit</button>
        </form>
    </div>
@endsection
