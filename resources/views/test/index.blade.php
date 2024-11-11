<!doctype html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Hello, world!</title>
    </head>
    <body>
    <div class="container mt-3">
        <table border="2px" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">country</th>
                    <th scope="col">email</th>
                    <th scope="col">created_at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                {{-- @dd($user->name); --}}
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    {{-- <td>{{$user->address->country_name}}</td> --}}
                    <td>{{ $user->address->pluck('country_name')->join(', ') }}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>