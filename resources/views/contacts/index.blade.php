@extends ('layout')

@section ('content')

    <h1 class="text-2xl">Contacts</h1>

    <contact-list :contacts="{{ $contacts->toJson() }}" />
    <div>
        <a href="{{ route('contacts.create') }}" class="p-2 bg-purple-600 text-white rounded">Add new</a>
    </div>
@stop
