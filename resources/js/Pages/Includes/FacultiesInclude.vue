<script setup>
import { Link } from "@inertiajs/vue3";

import SubHeadingComponent from "../Components/SubHeadingComponent.vue";

defineProps({
    faculties: Array,
});
</script>

<template>
    <section class="mt-20">
        <SubHeadingComponent
            :text="`List of Faculties (` + faculties.length + `)`"
        />

        <article class="overflow-x-auto w-full">
            <table class="table-auto border-collapse min-w-full text-left">
                <thead>
                    <tr class="border-b border-b-maroon">
                        <th class="p-3">Name</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>

                <tbody v-for="faculty in faculties" :key="faculty.id">
                    <tr>
                        <td class="border-b border-b-slate-200 p-3">
                            {{ faculty.name }}
                        </td>

                        <td class="border-b border-b-slate-200 p-3">
                            <div class="flex space-x-2">
                                <Link
                                    class="cursor-pointer px-3 text-sky-400"
                                    method="put"
                                >
                                    <span>
                                        <i class="fa-solid fa-edit"></i>
                                    </span>
                                </Link>

                                <Link
                                    :data="{ user_id: faculty.id }"
                                    :href="route('faculties')"
                                    as="button"
                                    class="cursor-pointer px-3 text-rose-400"
                                    method="delete"
                                    preserve-scroll
                                >
                                    <span>
                                        <i class="fa-solid fa-trash-can"></i>
                                    </span>
                                </Link>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </article>
    </section>
</template>
