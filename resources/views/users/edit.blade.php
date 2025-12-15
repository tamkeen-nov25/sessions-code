<form method='POST' action="{{ route('users.update',$user->id) }}">

    @csrf
    @method('PUT')
    
    <label for="name">name</label>
    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}">

        <label for="email">email</label>
    <input id="email" type="email" name="email">   

     <label for="password">password</label>
    <input id="password" type="password" name="password">


    <button type="submit">submit</button>
</form>