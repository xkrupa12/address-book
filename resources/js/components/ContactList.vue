<template>
    <div class="w-full">
        <contact-search v-model="term" />
        <contact-card v-for="contact in filteredContacts" :contact="contact" :key="contact.id" />

        <div class="mx-1 my-4">
            <button v-if="! createMode" @click="createMode = true" class="p-2 bg-spiro hover:bg-spiro-darker rounded shadow text-white">
                Add new contact
            </button>

            <div class="" v-if="createMode">
                <input type="text" name="name" placeholder="First name" class="mr-2 p-2 bg-white border border-gray-300" v-model="name">
                <input type="text" name="surname" placeholder="Last name" class="mr-2 p-2" v-model="surname">
                <input type="text" name="note" placeholder="Short note" class="mr-2 p-2" v-model="note">
                <button @click="storeContact" class="p-2 bg-spiro hover:bg-spiro-darker rounded shadow text-white">Save</button>
                <button @click="createMode = false" class="p-2 bg-white hover:bg-gray-300 rounded shadow text-spiro">Cancel</button>
            </div>
        </div>

    </div>
</template>

<script>
    import ContactCard from './ContactCard.vue';
    import ContactSearch from './ContactSearch.vue';

    export default {
        name: 'ContactList',

        components: { ContactCard, ContactSearch },

        data() {
            return {
                term: '',
                createMode: false,
                name: '',
                surname: '',
                note: '',
            }
        },

        props: ['contacts'],

        computed: {
            filteredContacts() {
                console.log('computing!');
                return this.term.length === 0
                    ? this.contacts
                    : this.contacts.filter(c => {
                        return String(c.name + ' ' + c.surname).includes(this.term);
                    });
            }
        },

        methods: {
            updateTerm (event) {
                this.term = event;
            },

            storeContact() {
                axios.post('/contacts/create', {
                    name: this.name,
                    surname: this.surname,
                    note: this.note,
                }).then(r => {
                    this.contacts.push(r.data);

                    this.name = '';
                    this.surname = '';
                    this.note = '';

                    this.createMode = false;
                }).catch(error => {
                    console.log(error);
                });
            }
        },
    }
</script>
