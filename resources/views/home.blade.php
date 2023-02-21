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
@section('body')
    @include('components.header')

    <div class='card m-3  p-2'>
        <div class="card-title"> 
             <h3>Member Listings</h3>
        </div>
        <div class="card-body">
            <table  class='display nowrap' id='memberTable'>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Status</th>
                        <th>Date Deactivated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $row)
                    <tr>
                        <td>
                            {{ $row->name }}
                        </td>
    
                        <td>
                            {{ $row->email }}
                        </td>
                        <td>
                            {{ $row->phoneNumber }}
                        </td>
    
                        <td>
                             
                            {{  $row->active?'Active':'Deactivated' }}
                        </td>
                        <td>
                            {{  $row->dateDeactivated ?  \Carbon\Carbon::parse($row->dateDeactivated)->format('d/m/Y') : "-" }}
                        </td>
    
                        <td>
                            
                            <a href="{{ $row->id }}/edit" class="btn btn-primary col-4">Edit</a>
                            <a class="btn {{ $row->active? "btn-danger":"btn-success" }} col-8" href="{{ $row->id }}/deactivate"
                            onclick="event.preventDefault();
                                            document.getElementById('deactivate-form-{{ $row->id }}').submit();">
                                {{ $row->active? "Deactivate":"Activate" }}
                            </a>
    
                            <form id="deactivate-form-{{ $row->id }}" action="{{ $row->id }}/deactivate" method="POST" value="" class="d-none">
                                @csrf
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>

@endsection

@section('js')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
<script type="text/javascript">

        $(document).ready( function () {
            $('#memberTable').dataTable( {
            } );

    } );
</script>
    
@endsection