@extends('components.master')

@section('style')
<style>
  @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@600&display=swap');
   body{
       background-color: #dfdfdf;
       font-family: 'Nunito', sans-serif;
   }
  
</style>
@endsection
@section('title')
    Login    
@endsection

@section('body')
<div class="row align-items-center vh-100">
    <div class="mx-auto card p-2">
        <div class="card-title">
            <h1>
                Login
            </h1>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </strong>
            </div>
            @endif
            <form class="form" method="post" action="/login">
                @csrf
                <div class="form-group">

                    
                    <input class="form-control form-control-md" type="email" name="email" placeholder="Email" id="email">
                </div> 
                <div class="form-group ">
                    <input class="form-control form-control-md" type="password" name="password" placeholder="Password" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        
    </div>
</div>
    
@endsection