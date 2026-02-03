<script setup>
defineProps({
    icon: String,
    processing: {
        default: false,
        type: Boolean,
    },
    text: String,
});
</script>

<template>
    <div class="mt-10 text-center">
        <button
            :disabled="processing"
            class="bg-slate-800 cursor-pointer disabled:bg-slate-500 duration-500 font-bold hover:bg-slate-900 hover:rounded-lg px-7 py-4 text-white text-xl uppercase"
            type="submit"
        >
            {{ processing ? "Please wait" : text }}

            <span>
                <i :class="`fa-solid ${icon}`"></i>
            </span>
        </button>
    </div>
</template>
