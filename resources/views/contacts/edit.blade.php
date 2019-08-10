@extends ('layout')

@section ('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Personal information</h1>
    <div class="mb-4">
        <form action="{{ route('contacts.update', ['id' => $contact->getKey()]) }}" method="POST">
            @csrf
            {{ method_field('put') }}

            <div class="m-1">
                <label for="name">First name:</label>
                <input type="text" name="name" class="p-1 border-gray-300 border rounded shadow"
                       value="{{ $contact->name }}">
            </div>

            <div class="m-1">
                <label for="surname">Last name:</label>
                <input type="text" name="surname" class="p-1 border-gray-300 border rounded"
                       value="{{ $contact->surname }}">
            </div>

            <input type="submit" value="Update" class="p-2 bg-purple-600 text-white rounded">
        </form>

        <form action="{{ route('contacts.delete', ['id' => $contact->getKey()]) }}" method="POST">
            @csrf
            {{ method_field('delete') }}

            <input type="submit" class="p-2 bg-red-600 text-white rounded" value="Delete">
        </form>
    </div>

    <h1>Addresses</h1>

    <div class="m-2">
        <addresses-list />

{{--        @foreach ($contact->addresses->where('primary', 1) as $address)--}}
{{--            <div class="mb-2 p-2">--}}
{{--                <p>{{ $address->street }} {{ $address->street_number }}</p>--}}
{{--                <p>{{ $address->zip }} {{ $address->city }}</p>--}}
{{--                <p>{{ $address->region ?? '' }}</p>--}}
{{--            </div>--}}
{{--        @endforeach--}}


{{--        @if ($contact->addresses->where('primary', 0)->isNotEmpty())--}}
{{--            <p class="font-bold">Secondary:</p>--}}

{{--            @foreach ($contact->addresses->where('primary', 1) as $address)--}}
{{--                <div class="mb-2 p-2">--}}
{{--                    <p>{{ $address->street }} {{ $address->street_number }}</p>--}}
{{--                    <p>{{ $address->zip }} {{ $address->city }}</p>--}}
{{--                    <p>{{ $address->region ?? '' }}</p>--}}
{{--                </div>--}}
{{--            @endforeach--}}

{{--        @endif--}}
    </div>

    <h2>Phone numbers</h2>
    <div class="m-2">
        @foreach ($contact->phoneNumbers as $phone)
            <p>{{ $phone->phone_number }} ({{ $phone->primary ? 'primary' : 'secondary' }})</p>
        @endforeach
    </div>

    <h2>Emails</h2>
    <div class="m-2">
        @foreach ($contact->emails as $email)
            <p>{{ $email->email }} ({{ $email->primary ? 'primary' : 'secondary' }})</p>
        @endforeach
    </div>
@stop

<script>
    let storage = {
        addresses: {!! $contact->addresses->toJson() !!},
    }
</script>
