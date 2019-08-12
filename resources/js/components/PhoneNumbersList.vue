<template>
    <div class="mx-2 my-6">
        <h2 class="text-bold text-xl">Phone numbers</h2>
        <ul>
            <li class="m-2" v-for="phone in phones" :key="phone.id">
                {{ phone.phone_number }} ({{ phone.title }})
                <span @click="remove(phone.id)" class="p-1 bg-red-500 text-white rounded cursor-pointer hover:bg-red-600">Remove</span>
            </li>
        </ul>

        <button @click="createMode = true" v-if="! createMode"  class="p-2 bg-spiro text-white rounded shadow hover:bg-spiro-darker">
            Add new phone number
        </button>

        <div v-if="createMode">
            <h3 class="m-2 font-bold">Add new phone number:</h3>
            <div class="m-2">
                <label for="title">Title: </label>
                <input class="p-1 border border-gray-300" type="text" name="title" id="title" v-model="title">
            </div>
            <div class="m-2">
                <label for="phone_number">Phone number: </label>
                <input class="p-1 border border-gray-300" type="text" name="phone_number" id="phone_number" v-model="phone_number">
            </div>
            <button @click="addNew" class="p-2 bg-spiro text-white rounded shadow hover:bg-spiro-darker">Add</button>
            <button @click="createMode = false" class="p-2 bg-white hover:bg-gray-300 rounded shadow text-spiro">Cancel</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'PhoneNumbersList',

        data() {
            return {
                contact: storage.contact,
                phones: storage.phones,
                title: '',
                phone_number: '',
                createMode: false,
            }
        },

        methods: {
            remove(phoneId) {
                axios.delete('/contacts/' + this.contact.id + '/phones/' + phoneId)
                    .then(r => {
                        this.phones = this.phones.filter(e => e.id !== phoneId);
                    });
            },

            addNew() {
                axios.post('/contacts/' + this.contact.id + '/phones', {
                    phone_number: this.phone_number,
                    title: this.title,
                    contact_id: this.contact.id
                }).then(response => {
                    this.phones.push(response.data);
                }).catch(e => {
                    console.log(e);
                })

                this.createMode = false;
            },
        }
    }
</script>

<style scoped>

</style>
