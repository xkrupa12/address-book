<template>
    <div class="w-full p-1">
        <input type="text" :value="term" @input="$emit('input', $event.target.value)" placeholder="Type to search..."
               class="hover:border-none p-2 w-full bg-gray-100 border-b border-gray-300">
    </div>
</template>

<script>
    export default {
        name: "ContactSearch",

        props: ['term'],
    }
</script>
