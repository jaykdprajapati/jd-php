@extends('includes.app')

@section('content')
<div class="row justify-content-center mt-5">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Create Todo</h1>
                </div>
                <div class="card-body">
                    @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                    @endif
                    <form action="{{ route('todo.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Todo name" value="{{old('name',$todo->name ?? '')}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="employee" class="form-label">Select User</label>
                            <select class="form-control" name="user_id">
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" {{$todo->user_id ?? '' ==$user->id ? 'selected' : '' }} >{{$user->name}}</option>
                                @endforeach    
                            </select>    
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Select Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select Status</option>
                                <option value="1" {{$todo?->status ?? '' ==1 ? 'selected' : '' }} >Open</option>
                                <option value="2" {{$todo?->status ?? '' ==2 ? 'selected' : '' }} >In Progress</option>
                                <option value="3" {{$todo?->status ?? '' ==3 ? 'selected' : '' }} >Complete</option>
                            </select>    
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <input type="hidden" name="todo_id" value="{{$todo?->id ?? ''}}">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection