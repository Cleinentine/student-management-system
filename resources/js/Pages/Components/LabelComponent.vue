<script setup>
defineProps({
    text: String,
    towards: String,
});
</script>

<template>
    <label :for="towards" class="cursor-text text-lg">{{ text }}:</label>
</template>
