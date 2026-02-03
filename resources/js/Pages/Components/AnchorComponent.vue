<script setup>
defineProps({
    link: String,
    text: String,
});
</script>

<template>
    <a :href="link" class="font-bold hover:underline text-maroon">{{ text }}</a>
</template>
