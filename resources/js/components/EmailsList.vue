<template>
    <div>
        <ul>
            <li class="m-2" v-for="email in emails" :key="email.id">
                {{ email.email }} ({{ email.title }})
                <span @click="remove(email.id)"
                      class="p-1 bg-red-500 text-white rounded cursor-pointer hover:bg-red-600">Remove</span>
            </li>
        </ul>

        <button @click="createForm = true" v-if="! createForm"
                class="p-2 bg-spiro text-white rounded shadow hover:bg-spiro-darker">
            Add new email address
        </button>

        <div v-if="createForm">
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
        </div>
    </div>
</template>

<script>
    export default {
        name: 'EmailsList',

        data() {
            return {
                emails: storage.emails,
                title: '',
                email: '',
                createForm: false,
            }
        },

        methods: {
            remove(emailId) {
                axios.delete('/contacts/' + this.emails[0].contact_id + '/emails/' + emailId)
                    .then(r => {
                        this.emails = this.emails.filter(e => e.id !== emailId);
                    });
            },

            addNew() {
                axios.post('/contacts/' + this.emails[0].contact_id + '/emails', {
                    email: this.email,
                    title: this.title,
                    contact_id: this.emails[0].contact_id
                }).then(response => {
                    this.emails.push(response.data);
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
