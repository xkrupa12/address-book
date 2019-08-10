<template>
    <div @click="togglePrimary" :class="{ 'border rounded shadow bg-white p-4 m-2 w-1/3 hover:bg-blue-100': true, 'border-spiro': address.primary, 'border-gray-300': ! address.primary }">
        <div>
            <div class="title uppercase font-bold mb-2">
                <p>{{ address.title }} <span class="text-sm text-gray-500">{{ address.primary ? '(primary)' : '' }}</span></p>
            </div>

            <div>
                <p>{{ address.street }} {{ address.street_number }}</p>
                <p>{{ address.postcode }} {{ address.city }}</p>
                <p>{{ address.country }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'AddressCard',

        props: ['address'],

        methods: {
            togglePrimary() {
                this.$emit('input', this.address.id);
            }
        }
    }
</script>

<style scoped>

</style>
