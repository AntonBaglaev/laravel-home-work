<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Form</title>
</head>
<body>
<form action="{{route('post')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">Name: </label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="surname">Surname: </label>
        <input type="text" name="surname" id="surname" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email: </label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <button type="submit">Submit</button>
</form>
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li style="color: red">{{$error}}</li>
        @endforeach
    </ul>
@endif
</body>
</html>
