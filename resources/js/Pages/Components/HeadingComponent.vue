<script setup>
defineProps({
    text: String,
});
</script>

<template>
    <h2
        class="font-black font-montserrat mb-10 text-4xl uppercase md:text-6xl lg:text-7xl"
    >
        {{ text }}
    </h2>
</template>
