@extends('todos.layout')

@section('content')

    <div class="border pb-5">
        <h1 class="text-center mt-5">Update your ToDo</h1>
        <x-alert />
        <form method="POST" action="{{ route('todo.update', $todo->id)}}" class="ml-5 mt-5">
            @csrf
            @method('patch')
            <input type="text" name="title" value="{{ $todo->title }}" class="border rounded p-2">
            <input type="submit" value="Update" class="btn btn-outline-primary">
            <a href="/todos" class="btn btn-outline-secondary">Back</a>
        </form>
    </div>

@endsection