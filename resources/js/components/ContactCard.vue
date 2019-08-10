<template>
    <div class="">
        <a :href="'contacts/' + contact.id">
            <div class="m-1 p-4 bg-white rounded shadow flex justify-between hover:border hover:border-blue-500 hover:bg-blue-100">
                <div class="flex w-1/2">
                    <div style="width: 60px;">
                        <img src="https://picsum.photos/50/50" alt="avatar" class="rounded-full">
                    </div>
                    <div class="flex flex-col justify-center text-left mx-2">
                        <div class="font-bold">{{ contact.name}} {{ contact.surname }}</div>
                        <div class="text-gray-600 text-sm">{{ note }}</div>
                    </div>
                </div>

                <div class="flex flex-col justify-center text-left text-sm w-1/4 mx-2 text-left">
                    <div>{{ street }}</div>
                    <div>{{ city }}</div>
                </div>

                <div class="flex flex-col justify-center text-left text-sm w-1/4 mx-2 text-right">
                    <div v-html="phone"></div>
                    <div v-html="email"></div>
                </div>

            </div>
        </a>
    </div>
</template>

<script>
    export default {
        name: 'ContactCard',

        props: ['contact'],

        computed: {
            note() {
                return !this.contact.note
                    ? ''
                    : (String(this.contact.note).length > 40 ? String(this.contact.note).substr(0, 40) + '...' : this.contact.note)
            },

            street() {
                return this.contact.address
                    ? this.contact.address.street + ' ' + this.contact.address.street_number
                    : '';
            },

            city() {
                return this.contact.address
                    ? this.contact.address.postcode + ' ' + this.contact.address.city + ', ' + this.contact.address.country
                    : '';
            },

            phone() {
                return this.contact.phone_number
                    ? this.contact.phone_number.phone_number
                    : '-';
            },

            email() {
                return this.contact.email
                    ? this.contact.email.email
                    : '-';
            },
        },
    }
</script>

<style scoped>

</style>
