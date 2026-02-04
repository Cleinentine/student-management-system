<script setup>
defineProps({
    icon: String,
    modelValue: [String, Number],
    name: String,
});

const emit = defineEmits(["update:modelValue"]);
</script>

<template>
    <div class="relative">
        <select
            class="bg-slate-900 border-4 border-slate-600 cursor-pointer outline-none pl-11.25 placeholder:italic px-7 py-4 rounded-lg text-white w-full"
            :id="name"
            :name="name"
            :value="modelValue"
            @change="emit('update:modelValue', $event.target.value)"
        >
            <slot />
        </select>

        <span
            class="absolute left-5 pointer-events-none text-slate-600 top-5.5"
        >
            <i :class="`fa-solid ${icon}`"></i>
        </span>
    </div>
</template>
