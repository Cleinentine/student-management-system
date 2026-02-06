<script setup>
import { ref } from "vue";

import { Form, usePage } from "@inertiajs/vue3";

import ButtonComponent from "./Components/ButtonComponent.vue";
import ContentHeaderComponent from "./Components/ContentHeaderComponent.vue";
import ErrorComponent from "./Components/ErrorComponent.vue";
import FacultiesInclude from "./Includes/FacultiesInclude.vue";
import FileComponent from "./Components/FileComponent.vue";
import InputComponent from "./Components/InputComponent.vue";
import LabelComponent from "./Components/LabelComponent.vue";
import SubHeadingComponent from "./Components/SubHeadingComponent.vue";
import SuccessComponent from "./Components/SuccessComponent.vue";

import MainLayout from "./Layouts/MainLayout.vue";

const page = usePage();

defineProps({
    colleges: Array,
    dean: Object,
    faculties: Array,
});

/**
 * Avatar image preview.
 */
const imageFile = ref(null);
const imagePreview = ref(null);

const fields = [
    {
        icon: "fa-tag",
        label: "Full Name (Required)",
        name: "name",
        placeholder: "e.g. John Doe",
        type: "text",
        value: null,
    },
    {
        icon: "fa-at",
        label: "Email (Required)",
        name: "email",
        placeholder: "e.g. johndoe@email.com",
        type: "email",
        value: null,
    },
    {
        icon: "fa-mobile",
        label: "Mobile Number (Required)",
        name: "mobile_number",
        placeholder: "e.g. 9123456789",
        type: "text",
        value: null,
    },
];

function handleImagePreview(event) {
    const file = event.target.files[0];

    if (!file) {
        imageFile.value = null;
        imagePreview.value = null;

        return;
    }

    imageFile.value = file;

    const reader = new FileReader();

    reader.onload = (e) => {
        imagePreview.value = e.target.result;
    };

    reader.readAsDataURL(file);
}
</script>

<template>
    <Head title="Faculties" />

    <MainLayout>
        <ContentHeaderComponent text="Faculties" />

        <section class="max-w-screen-2xl mx-auto px-5 py-20">
            <SubHeadingComponent text="Add a Faculty Member" />

            <div class="my-10 text-center" v-if="imagePreview">
                <img
                    :src="imagePreview"
                    class="h-32 inline-block object-cover rounded-full w-32"
                />
            </div>

            <Form
                :action="route('faculties')"
                :options="{
                    preserveScroll: true,
                }"
                :resetOnError="['password', 'password_confirmation']"
                #default="{ errors, processing }"
                disableWhileProcessing
                method="post"
                preserve
                resetOnSuccess
            >
                <div class="gap-5 grid md:grid-cols-2">
                    <div>
                        <LabelComponent text="Avatar" towards="avatar" />

                        <FileComponent
                            @change="handleImagePreview"
                            id="avatar"
                            name="avatar"
                        />

                        <ErrorComponent
                            :message="errors.avatar"
                            v-if="errors.avatar"
                        />
                    </div>

                    <div v-for="field in fields" :key="field.name">
                        <LabelComponent
                            :text="field.label"
                            :towards="field.name"
                        />

                        <InputComponent
                            :icon="field.icon"
                            :name="field.name"
                            :placeholder="field.placeholder"
                            :type="field.type"
                            :value="field.value"
                        />

                        <ErrorComponent
                            v-if="errors[field.name]"
                            :message="errors[field.name]"
                        />
                    </div>
                </div>

                <ButtonComponent
                    :processing="processing"
                    icon="fa-plus-square"
                    text="Add Member"
                />

                <SuccessComponent
                    :message="page.flash.success"
                    v-if="page.flash.success"
                />
            </Form>

            <FacultiesInclude
                v-if="faculties && faculties.length > 0"
                :faculties="faculties"
            />
        </section>
    </MainLayout>
</template>
