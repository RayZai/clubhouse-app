@extends('components.master')


@section('title')
Add Member
@endsection

@section('style')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@600&display=swap');
      body{
          background-color: #dfdfdf;
          font-family: 'Nunito', sans-serif;
      }
     
  </style>
@endsection

@section('body')
@include('components.header')
<div class="card m-3">
    <div class="card title p-2">
        <h3>Add New Member</h3>
    </div>
    <div class='card-body'>
        <form action="/add" method="post">
            @csrf
            <div class="row my-2">
                <div class="col-6">
                    <label for="txtName" class="form-label required">Full Name <span class="text text-danger">*</span></label>
                    <input type="text" class="form-control" id="txtName" name="name" value="{{ old('name') }}" required>
                    
                </div>
                <div class="col-6">
                    <label for="txtName" class="form-label required">Email <span class="text text-danger">*</span></label>
                    <input type="text" class="form-control" id="txtName" name="email" value="{{ old('email') }}" required>
                    
                </div>
            </div>
            <div class="row my-2">
                <div class="col-6">
                    <label for="txtName" class="form-label required">Phone Number <span class="text text-danger">*</span></label>
                    <input type="text" class="form-control" id="txtName" name="phoneNumber" value="{{ old('phoneNumber') }}" required>
                    
                </div>
            </div>
                <div class="float-right">
                    <button type="submit" id="checkDup" class="btn btn-primary">Submit</button>
                </div>




        </form>
    </div>
    
</div>
    
@endsection