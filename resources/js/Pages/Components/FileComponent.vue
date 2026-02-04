<script setup>
defineProps({
    id: String,
    name: String,
});
</script>

<template>
    <div class="relative">
        <input
            accept="image/*"
            class="bg-slate-900 border-4 border-slate-600 cursor-pointer outline-none pl-11.25 placeholder:italic px-7 py-4 rounded-lg text-white w-full"
            type="file"
            :id="name"
            :name="name"
        />

        <span
            class="absolute left-5 pointer-events-none text-slate-600 top-5.5"
        >
            <i class="fa-solid fa-image"></i>
        </span>
    </div>
</template>
