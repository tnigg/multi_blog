@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="jumbotron">
        <h1>Users</h1>
    </div>    
    <table>    
    @foreach($users as $user)    
    <tr>
    <td>{{$user->name}}</td>
    <td>{{$user->email}}</td>
    <td>{{$user->role->name}}</td>
    <td>{{$user->created_at}}</td> 
    <td>
    <form action="{{route('admin.promote', $user->id)}}">
    <button type="submit">Promote</button>    
    </form>    
    </td>
    <td>
    <form action="{{route('admin.demote', $user->id)}}">
    <button type="submit">Demote</button>    
    </form>    
    </td>      
    </tr>    
    @endforeach 
    </table> 
</div>

@endsection