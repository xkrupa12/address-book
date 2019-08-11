<template>
    <div>
        <ul>
            <li class="m-2" v-for="phone in phones" :key="phone.id">
                {{ phone.phone_number }} ({{ phone.title }})
                <span @click="remove(phone.id)" class="p-1 bg-red-500 text-white rounded cursor-pointer hover:bg-red-600">Remove</span>
            </li>
        </ul>

        <button @click="createForm = true" v-if="! createForm"  class="p-2 bg-spiro text-white rounded shadow hover:bg-spiro-darker">
            Add new phone number
        </button>

        <div v-if="createForm">
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
        </div>
    </div>
</template>

<script>
    export default {
        name: 'PhoneNumbersList',

        data() {
            return {
                phones: storage.phones,
                title: '',
                phone_number: '',
                createForm: false,
            }
        },

        methods: {
            remove(phoneId) {
                axios.delete('/contacts/' + this.phones[0].contact_id + '/phones/' + phoneId)
                    .then(r => {
                        this.phones = this.phones.filter(e => e.id !== phoneId);
                    });
            },

            addNew() {
                axios.post('/contacts/' + this.phones[0].contact_id + '/phones', {
                    phone_number: this.phone_number,
                    title: this.title,
                    contact_id: this.phones[0].contact_id
                }).then(response => {
                    this.phones.push(response.data);
                }).catch(e => {
                    console.log(e);
                })

                this.createForm = false;
            },
        }
    }
</script>

<style scoped>

</style>
