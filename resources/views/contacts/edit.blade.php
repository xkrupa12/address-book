@extends ('layout')

@section ('content')

    <div>
        <personal-card></personal-card>
        <addresses-list></addresses-list>
        <phone-numbers-list></phone-numbers-list>
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
