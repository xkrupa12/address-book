<template>
    <div class="mx-2 my-6">
        <h2 class="text-bold text-xl">Emails</h2>
        <ul>
            <li class="m-2" v-for="email in emails" :key="email.id">
                {{ email.email }} ({{ email.title }})
                <span @click="remove(email.id)"
                      class="p-1 bg-red-500 text-white rounded cursor-pointer hover:bg-red-600">Remove</span>
            </li>
        </ul>

        <button @click="createMode = true" v-if="! createMode"
                class="p-2 bg-spiro text-white rounded shadow hover:bg-spiro-darker">
            Add new email address
        </button>

        <div v-if="createMode">
            <h3 class="m-2 font-bold">Add new email:</h3>
            <div class="m-2">
                <label for="title">Title: </label>
                <input class="p-1 border border-gray-300" type="text" name="title" id="title" v-model="title">
            </div>
            <div class="m-2">
                <label for="email">Email: </label>
                <input class="p-1 border border-gray-300" type="text" name="email" id="email" v-model="email">
            </div>
            <button @click="addNew" class="p-2 bg-spiro text-white rounded shadow hover:bg-spiro-darker">Add</button>
            <button @click="createMode = false" class="p-2 bg-white hover:bg-gray-300 rounded shadow text-spiro">Cancel</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'EmailsList',

        data() {
            return {
                contact: storage.contact,
                emails: storage.emails,
                title: '',
                email: '',
                createMode: false,
            }
        },

        methods: {
            remove(emailId) {
                axios.delete('/contacts/' + this.contact.id + '/emails/' + emailId)
                    .then(r => {
                        this.emails = this.emails.filter(e => e.id !== emailId);
                    });
            },

            addNew() {
                axios.post('/contacts/' + this.contact.id + '/emails', {
                    email: this.email,
                    title: this.title,
                    contact_id: this.contact.id
                }).then(response => {
                    this.emails.push(response.data);
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
