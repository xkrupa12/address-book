@extends ('layout')

@section ('content')
    <form action="{{ route('contacts.create') }}" method="POST">
        @csrf

        <div class="m-1">
            <label for="name">First name:</label>
            <input type="text" name="name" class="p-1 border-gray-300 border rounded shadow">
        </div>

        <div class="m-1">
            <label for="surname">Last name:</label>
            <input type="text" name="surname" class="p-1 border-gray-300 border rounded">
        </div>

        <input type="submit" value="Create" class="p-2 bg-purple-600 text-white rounded">
    </form>
@stop
