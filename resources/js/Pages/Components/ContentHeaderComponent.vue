<script setup>
import HeadingComponent from "./HeadingComponent.vue";

defineProps({
    text: String,
});
</script>

<template>
    <article
        class="bg-[url(/images/marble.jpg)] bg-center bg-cover bg-no-repeat px-5 py-20 text-center text-white md:text-left"
    >
        <div class="max-w-screen-2xl mx-auto">
            <HeadingComponent :text="text" />
        </div>
    </article>
</template>
