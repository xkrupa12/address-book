<template>
    <div class="mx-2 my-6">
        <h2 class="text-bold text-xl">Address</h2>
        <div v-if="addresses.length === 0">
            <p class="font-bold italic text-red-500">There are no addresses associated with this contact</p>
        </div>
        <div v-else>
            <address-card v-model="primary" v-for="address in addresses" :key="address.id" :address="address"/>
        </div>

        <button v-if="! createMode" @click="createMode = true"
                class="p-2 bg-spiro hover:bg-spiro-darker rounded shadow text-white block shadow">
            Add new contact
        </button>

        <div v-if="createMode">
            <div class="my-2">
                <input type="text" name="title" placeholder="Title" class="mr-2 p-2 bg-white border border-gray-300" v-model="title">
            </div>

            <div class="my-2">
            <input type="text" name="street" placeholder="Street" class="mr-2 p-2 bg-white border border-gray-300" v-model="street">
            <input type="text" name="street_number" placeholder="Street number" class="mr-2 p-2 bg-white border border-gray-300" v-model="street_number">
            </div>

            <div class="my-2">
            <input type="text" name="city" placeholder="City" class="mr-2 p-2 bg-white border border-gray-300" v-model="city">
            <input type="text" name="postcode" placeholder="Zip" class="mr-2 p-2 bg-white border border-gray-300" v-model="postcode">
            <input type="text" name="country" placeholder="Country" class="mr-2 p-2 bg-white border border-gray-300" v-model="country">
            </div>

            <button @click="storeAddress" class="p-2 bg-spiro hover:bg-spiro-darker rounded shadow text-white shadow">Save</button>
            <button @click="createMode = false" class="p-2 bg-white hover:bg-gray-300 rounded shadow text-spiro shadow">Cancel</button>
        </div>

    </div>
</template>

<script>
    import AddressCard from "./AddressCard";

    export default {
        name: 'AddressesList',

        components: {AddressCard},

        // props: ['addresses'],

        data() {
            return {
                primary: null,
                addresses: storage.addresses,
                contact: storage.contact,

                title: '',
                street: '',
                street_number: '',
                city: '',
                postcode: '',
                country: '',
                createMode: false,
            }
        },

        mounted() {
            let primaryAddresses = this.addresses.filter(a => a.primary);

            if (primaryAddresses.length > 0) {
                this.primary = primaryAddresses[0].id;
            }
        },

        methods: {
            storeAddress() {
                axios.post('/contacts/' + this.contact.id + '/addresses/create', {
                    title: this.title,
                    street: this.street,
                    street_number: this.street_number,
                    city: this.city,
                    postcode: this.postcode,
                    country: this.country,
                }).then(r => {
                    this.addresses.push(r.data);
                    this.street = '';
                    this.street_number = '';
                    this.city = '';
                    this.postcode = '';
                    this.country = '';
                    this.createMode = false;
                }).catch(error => {
                    console.log(error);
                });
            }
        },

        watch: {
            primary() {

                if (!this.addresses) {
                    return;
                }

                let address = this.addresses.filter(a => a.id === this.primary)[0];
                if (!address || address.primary) {
                    return;
                }

                axios.post('/contacts/' + address.contact_id + '/addresses/' + address.id + '/set-primary').then(r => {
                    this.addresses.forEach(a => {
                        a.primary = a.id === this.primary;
                    });
                }).catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>

<style scoped>

</style>
