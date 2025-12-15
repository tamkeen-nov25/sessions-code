<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
          <tr>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>
        <a href="{{ route('users.edit',$user) }}">edit</a>
        <form action="{{ route('users.destroy', $user) }}" method="post">
          @csrf
          @method('DELETE')
          <button type="submit">delete</button>
        </form>

      </td>

    </tr>
    @endforeach

  </tbody>
</table>
<a href={{ route('users.create') }}>create</a>
</body>
</html>
