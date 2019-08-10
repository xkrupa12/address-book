<template>
    <div class="w-full">
        <contact-search v-model="term" />
        <contact-card v-for="contact in filteredContacts" :contact="contact" :key="contact.id" />
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
            }
        },
    }
</script>
