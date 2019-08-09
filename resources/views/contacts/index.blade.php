@extends ('layout')

@section ('content')
    <h1>My contacts</h1>
    @foreach ($contacts as $contact)
        <p>{{ $contact->fullName }}</p>
    @endforeach
@stop
