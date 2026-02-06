<script setup>
import { computed, onMounted, ref } from "vue";

import { Form, usePage } from "@inertiajs/vue3";

import ButtonComponent from "./Components/ButtonComponent.vue";
import ContentHeaderComponent from "./Components/ContentHeaderComponent.vue";
import ContentContainerComponent from "./Components/ContentContainerComponent.vue";
import ErrorComponent from "./Components/ErrorComponent.vue";
import FileComponent from "./Components/FileComponent.vue";
import InputComponent from "./Components/InputComponent.vue";
import LabelComponent from "./Components/LabelComponent.vue";
import SelectComponent from "./Components/SelectComponent.vue";
import SuccessComponent from "./Components/SuccessComponent.vue";

import MainLayout from "./Layouts/MainLayout.vue";

const page = usePage();

defineProps({
    colleges: Array,
    dean: Object,
});

const selectModel = computed(() => {
    return {
        id: page.props.dean?.college_id || null,
        name: page.props.dean?.college?.name || "",
    };
});

/**
 * Avatar image preview.
 */
const imageFile = ref(null);
const imagePreview = ref(page.props.dean?.avatar || null);

onMounted(() => {
    if (page.props.dean && page.props.dean.avatar) {
        imagePreview.value = "storage/" + page.props.dean.avatar;
    } else {
        imagePreview.value = null;
    }
});

function handleImagePreview(event) {
    const file = event.target.files[0];

    if (!file) {
        imageFile.value = null;
        imagePreview.value = "storage/" + page.props.dean.avatar || null;

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
    <Head title="Dean" />

    <MainLayout>
        <ContentHeaderComponent text="My Profile" />

        <ContentContainerComponent>
            <div class="my-10 text-center" v-if="imagePreview">
                <img
                    :src="imagePreview"
                    class="h-32 inline-block object-cover rounded-full w-32"
                />
            </div>

            <Form
                :action="route('dean')"
                :options="{
                    preserveScroll: true,
                }"
                #default="{ errors, processing }"
                disableWhileProcessing
                method="post"
            >
                <div class="gap-5 grid lg:grid-cols-3">
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

                    <div>
                        <LabelComponent text="Name (Required)" towards="name" />

                        <InputComponent
                            :value="page.props.dean ? page.props.dean.name : ''"
                            icon="fa-tag"
                            name="name"
                            placeholder="e.g. John Doe"
                            type="text"
                        />

                        <ErrorComponent
                            :message="errors.name"
                            v-if="errors.name"
                        />
                    </div>

                    <div>
                        <LabelComponent
                            text="College (Required)"
                            towards="college"
                        />

                        <SelectComponent
                            icon="fa-building-columns"
                            name="college_id"
                            v-model="selectModel.id"
                        >
                            <option value="">-- Select --</option>

                            <option
                                :key="option.id"
                                :value="option.id"
                                v-for="option in page.props.colleges"
                            >
                                {{ option.name }}
                            </option>
                        </SelectComponent>

                        <ErrorComponent
                            :message="errors.college_id"
                            v-if="errors.college_id"
                        />
                    </div>
                </div>

                <ButtonComponent
                    :processing="processing"
                    icon="fa-user-edit"
                    text="Update Profile"
                />

                <SuccessComponent
                    :message="page.flash.success"
                    v-if="page.flash.success"
                />
            </Form>
        </ContentContainerComponent>
    </MainLayout>
</template>
