<script setup>
defineProps({
    icon: String,
    name: String,
    placeholder: String,
    type: String,
});
</script>

<template>
    <div class="relative">
        <input
            autocomplete="on"
            class="bg-slate-900 border-4 border-slate-600 outline-none pl-11.25 placeholder:italic px-7 py-4 rounded-lg text-white w-full"
            :id="name"
            :name="name"
            :placeholder="placeholder"
            :type="type"
        />

        <span
            class="absolute left-5 pointer-events-none text-slate-600 top-5.5"
        >
            <i :class="`fa-solid ${icon}`"></i>
        </span>
    </div>
</template>
