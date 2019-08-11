@extends ('layout')

@section ('content')

    <div>
        <personal-card></personal-card>

        <addresses-list></addresses-list>

        <h2 class="text-bold text-xl m-2">Phone numbers</h2>
        <phone-numbers-list></phone-numbers-list>

        <h2 class="text-bold text-xl m-2">Emails</h2>
        <emails-list></emails-list>
    </div>
@stop

<script>
    let storage = {
        contact: {!! $contact->toJson() !!},
        addresses: {!! $contact->addresses->toJson() !!},
        emails: {!! $contact->emails->toJson() !!},
        phones: {!! $contact->phoneNumbers->toJson() !!},
    }
</script>
