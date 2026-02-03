<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <p class="mt-1 text-rose-400">
        <span><i class="fa-solid fa-times-circle"></i></span>
        {{ message }}
    </p>
</template>
