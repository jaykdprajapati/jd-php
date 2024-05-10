@extends('includes.app')

@section('content')
<div class="container">
        @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
        @endif


        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
        @endif

        <a class="pull-right btn btn-success" aria-current="page" href="{{route('todo.create')}}">Create Todo</a>
        <table class="table mt-5">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Employee</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($todos))
                    @foreach($todos as $key => $todo)
                        <tr>
                            <th scope="row">{{$loop->index+1}}</th>
                            <td>{{$todo->name}}</td>
                            <td>{{$todo->user->name}}</td>
                            <td>
                                @if($todo->status==1)
                                    <span class="badge bg-warning">Open</span>
                                @elseif($todo->status==2) 
                                    <span class="badge bg-info">In progress</span>
                                @else
                                <span class="badge bg-success">Complete</span>
                                @endif
                            </td>
                            <td>
                        
                                <a class="nav-link active" aria-current="page" href="{{route('todo.edit',$todo->id)}}">Edit</a>
                                <a class="nav-link active" aria-current="page" onclick="return confirm('Are you sure you want to delete?')" href="{{route('todo.destroy',$todo->id)}}">Delete</a>
                        
                            </td>
                        </tr>
                    @endforeach    
                @endif    
            </tbody>
        </table>
    </div>
@endsection