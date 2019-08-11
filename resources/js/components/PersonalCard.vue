<template>
    <div class="m-2">
        <div v-if="! edit" class="flex justify-between">
            <div class="flex-1">
                <p class="text-2xl font-bold w-full">{{ fullName }}</p>
            </div>
            <div>
                <span class="ml-32 text-right text-sm text-gray-600 p-1 rounded bg-white cursor-pointer hover:bg-blue-100" @click="edit = true">edit</span>
            </div>
        </div>
        <div v-else>
            <input class="p-2" type="text" name="name" v-model="contact.name">
            <input class="p-2" type="text" name="surname" v-model="contact.surname">

            <button @click="updateName" class="p-2 bg-spiro text-white rounded hover:bg-spiro-darker">Update</button>
            <button @click="edit = false" class="p-2 bg-white rounded hover:bg-gray-400">Cancel</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'PersonalCard',

        data() {
            return {
                contact: storage.contact,
                edit: false,
                name: '',
                surname: '',
            }
        },

        computed: {
            fullName() {
                return this.contact.name + ' ' + this.contact.surname;
            }
        },

        methods: {
            updateName() {
                console.log('/contacts/' + this.contact.id);
                axios.put('/contacts/' + this.contact.id, {
                    name: this.contact.name,
                    surname: this.contact.surname
                }).then(r => {
                    console.log('it is done!');

                    this.edit = false;
                }).catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>
