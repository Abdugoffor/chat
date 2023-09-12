<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script>
            let userId = {{ auth()->user()->id }};
            // alert(userId);
        </script>
    @vite(['resources/js/app.js'])
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-6">
                <h1>User : {{ auth()->user()->name }}</h1>
                <form action="{{ route('store') }}" method="post">
                    @csrf
                    <input type="text" name="message" class="form-control" placeholder="Message" autofocus>
                    <select name="to_id" class="form-select mt-3 mb-5">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <input type="submit" class="btn btn-primary mt-1" name="ok">
                </form>
                <div id="message-list"></div>
                {{-- @foreach ($models as $model)
                    <li><b>
                        @if ($model->from_id != auth()->user()->id)
                            {{ $model->from->name }}
                        @endif 
                    </b> / <i>{{ $model->body }}</i></li>
                @endforeach --}}
            </div>
        </div>
    </div>
</body>

</html>
