<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <style>
        .foucs-0:focus {
            outline: none;
            box-shadow: none;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>

    <script>
        function handleCheckboxClick(event) {
            event.target.parentNode.submit();
        }
    </script>
</head>

<body>

    <div class="row" style="height: 10vh; width: 100vw;">
        <div class="col-lg-12">
            @if(session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
            @endif
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                {{$err}}
                @endforeach
            </div>
            @endif
        </div>
    </div>
    <div class="d-lg-flex justify-content-lg-center align-items-lg-center" style="width: 100vw;height: 90vh;">
        <div class="m-auto">
            <form method="POST" action="{{route('todos.store')}}" class="mb-5">
                <h2 class="sr-only">Todo</h2>
                @csrf
                <div class="input-group">
                    <input type="text" name="title" placeholder="Add todo" class="form-control rounded-0 border-right-0 border-secondary foucs-0">
                    <div class="input-group-append">
                        <input class="btn rounded-0 border-left-0 bg-light border-secondary foucs-0" type="submit" value="Add" />
                    </div>
                </div>
            </form>
            <div class="table-responsive" style="width: 500px; height: 70vh;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Todo</th>
                        </tr>
                    </thead>
                    <tbody style="width: 500px; height: 60vh; overflow-y: scroll; position: absolute;">
                        @foreach($todos as $todo)
                        <tr>
                            <td style="width: 500px;">
                                <div class="form-check">
                                    <form method="POST" action="{{route('todos.update')}}" class="mb-5">
                                        @method('PUT')
                                        @csrf
                                        <input name="id" value="{{$todo->id}}" hidden />
                                        <input type="checkbox" name="done" class="form-check-input" onchange="handleCheckboxClick(event)" {{$todo->done?'checked':''}} />{{$todo->title}}
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>