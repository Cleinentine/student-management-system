<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <p
        class="bg-emerald-400 font-bold mt-5 p-5 rounded-md text-center text-lg text-white uppercase"
    >
        <span><i class="fa-solid fa-check-circle"></i></span>
        {{ message }}
    </p>
</template>
