<template>
    <div class="flex">
        <address-card v-model="primary" v-for="address in addresses" :key="address.id" :address="address" />
    </div>
</template>

<script>
    import AddressCard from "./AddressCard";

    export default {
        name: 'AddressesList',

        components: { AddressCard },

        // props: ['addresses'],

        data() {
            return {
                primary: null,
                addresses: storage.addresses,
            }
        },

        mounted() {
            let primaryAddresses = this.addresses.filter(a => a.primary);

            if (primaryAddresses.length > 0) {
                this.primary = primaryAddresses[0].id;
            }
        },

        watch: {
            primary() {

                if (! this.addresses) {
                    return;
                }

                let address = this.addresses.filter(a => a.id === this.primary)[0];
                if (! address || address.primary) {
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
