@extends('todos.layout')

@section('content')

    <div class="container d-flex">
        <div class="col-md-6"><h1 class="text-center d-flex">ToDo List</h1></div>
        <div class="col-md-6 text-right"><a href="/todos/create" class="btn btn-outline-primary">Create New</a></div>
    </div>
    <x-alert />
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>TITLE</th>
                <th colspan="2">ACTION</th>
                <th>DONE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($todos as $todo)
                <tr>
                    @if($todo->completed)
                        <td id="mark-{{ $todo->id }}"><del>{{ $todo->title }}</del></td>
                    @else
                        <td id="mark-{{ $todo->id }}">{{ $todo->title }}</td>
                    @endif

                    <td><a href="{{'/todos/'.$todo->id.'/edit'}}" class="btn btn-outline-success">Edit</a></td>
                    
                    <td><a href="/todos/delete" class="btn btn-outline-danger">Delete</a></td>
                    
                    @if($todo->completed)
                        <td><span id="{{ $todo->id }}" class="fa fa-check d-flex justify-content-center form-incomplete completed"></span></td>
                    @else
                        <td><span id="{{ $todo->id }}" class="fa fa-check d-flex justify-content-center form-complete incompleted"></span></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination link --}}
    {{ $todos->links() }}

    <style>
        .completed{
            color:rgb(7, 156, 57); 
            cursor:pointer;
        }

        .incompleted{
            color:rgb(177, 177, 177); 
            cursor:pointer;
        }

        .markCom{
            text-decoration: line-through;
        }
    </style>

    <script>
        $(document).ready(function(){
            var result = "";
            $(".form-complete").click(function(){
                markComplete($(this).attr('id'));
            });
            
            function markComplete(dataObj) {
                $.ajax({
                    url: '/todos/'+dataObj+'/complete',
                    headers: {
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content'),
                        'Content-Type':'application/json'
                    },
                    method: 'POST',
                    dataType: 'json',
                    success: function(data){
                        //console.log(JSON.stringify(data));
                        $("#" + dataObj).removeClass("form-complete incompleted").addClass("form-incomplete completed");
                        $("#mark-" + dataObj).addClass("markCom");
                    }
                });
            }

            $(".form-incomplete").click(function(){
                markIncomplete($(this).attr('id'));
            });

            function markIncomplete(dataObj) {
                $.ajax({
                    url: '/todos/'+dataObj+'/incomplete',
                    headers: {
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content'),
                        'Content-Type':'application/json'
                    },
                    method: 'POST',
                    dataType: 'json',
                    success: function(data){
                        $("#" + dataObj).removeClass("form-incomplete completed").addClass("form-complete incompleted");
                        $("#mark-" + dataObj).removeClass("markCom");
                    }
                });
            }
        });
    </script>  

@endsection