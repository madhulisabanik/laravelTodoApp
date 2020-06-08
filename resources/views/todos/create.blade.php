@extends('todos.layout')

@section('content')
    
    <div class="border pb-5">
        <h1 class="text-center mt-5">What next ToDo</h1>
        <x-alert />
        <form method="POST" action="/todos/store" class="ml-5 mt-5">
            @csrf
            <input type="text" name="title" class="border rounded p-2">
            <input type="submit" value="Create" class="btn btn-outline-primary">
            <a href="/todos" class="btn btn-outline-secondary">Back</a>
        </form>
    </div>
    
@endsection