<script setup>
import { computed, onMounted, ref } from "vue";

import { Form, usePage } from "@inertiajs/vue3";

import ButtonComponent from "./Components/ButtonComponent.vue";
import ContentHeaderComponent from "./Components/ContentHeaderComponent.vue";
import ContentContainerComponent from "./Components/ContentContainerComponent.vue";
import ErrorComponent from "./Components/ErrorComponent.vue";
import FileComponent from "./Components/FileComponent.vue";
import InfoComponent from "./Components/InfoComponent.vue";
import InputComponent from "./Components/InputComponent.vue";
import LabelComponent from "./Components/LabelComponent.vue";
import SelectComponent from "./Components/SelectComponent.vue";
import SuccessComponent from "./Components/SuccessComponent.vue";

import MainLayout from "./Layouts/MainLayout.vue";

const page = usePage();

defineProps({
    genders: {
        type: Array,
        default: () => [
            {
                id: "Male",
                name: "Male",
            },
            {
                id: "Female",
                name: "Female",
            },
        ],
    },
    programs: Array,
    student: Object,
});

const textFields = computed(() => [
    {
        icon: "fa-id-badge",
        label: "Student Number (Required)",
        name: "student_number",
        placeholder: "e.g. 26-12345",
        type: "text",
        value: page.props.student ? page.props.student.student_number : "",
    },
    {
        icon: "fa-tag",
        label: "First Name (Required)",
        name: "first_name",
        placeholder: "e.g. John",
        type: "text",
        value: page.props.student ? page.props.student.first_name : "",
    },
    {
        icon: "fa-tag",
        label: "Middle Name (Required)",
        name: "middle_name",
        placeholder: "e.g. Jane",
        type: "text",
        value: page.props.student ? page.props.student.middle_name : "",
    },
    {
        icon: "fa-tag",
        label: "Last Name (Required)",
        name: "last_name",
        placeholder: "e.g. Doe",
        type: "text",
        value: page.props.student ? page.props.student.last_name : "",
    },
    {
        icon: "fa-cake-candles",
        label: "Date of Birth (Required)",
        name: "date_of_birth",
        placeholder: "",
        type: "date",
        value: page.props.student ? page.props.student.date_of_birth : "",
    },
    {
        icon: "fa-home",
        label: "Home Address (Required)",
        name: "home_address",
        placeholder: "e.g. Maura Aparri Cagayan",
        type: "text",
        value: page.props.student ? page.props.student.home_address : "",
    },
]);

/**
 * Select options
 */
const selectFields = computed(() => [
    {
        icon: "fa-building-columns",
        label: "Program (Required)",
        model: page.props.student ? page.props.student.program_id : "",
        name: "program_id",
        options: page.props.programs,
        value: page.props.student ? page.props.student.program_id : "",
    },
    {
        icon: "fa-mars-and-venus",
        label: "Gender (Required)",
        model: page.props.student ? page.props.student.gender : "",
        name: "gender",
        options: [
            { id: "Male", name: "Male" },
            { id: "Female", name: "Female" },
        ],
        value: page.props.student ? page.props.student.gender : "",
    },
]);

/**
 * Avatar image preview.
 */
const imageFile = ref(null);
const imagePreview = ref(page.props.student?.avatar || null);

onMounted(() => {
    if (page.props.student && page.props.student.avatar) {
        imagePreview.value = "storage/" + page.props.student.avatar;
    } else {
        imagePreview.value = null;
    }
});

function handleImagePreview(event) {
    const file = event.target.files[0];

    if (!file) {
        imageFile.value = null;
        imagePreview.value = "storage/" + page.props.student.avatar || null;

        return;
    }

    imageFile.value = file;

    const reader = new FileReader();

    reader.onload = (e) => {
        imagePreview.value = e.target.result;
    };

    reader.readAsDataURL(file);
}

/**
 * Created at and Updated at formatting.
 */
const created_at = computed(() => {
    if (!page.props.student.created_at) return "No created date set";

    const date = new Date(page.props.student.created_at);

    if (isNaN(date)) return null;

    return date.toLocaleString("en-US", {
        day: "2-digit",
        month: "long",
        year: "numeric",
        hour: "numeric",
        minute: "2-digit",
        hour12: true,
    });
});

const updated_at = computed(() => {
    if (!page.props.student.updated_at) return "No updated date set";

    const date = new Date(page.props.student.updated_at);

    if (isNaN(date)) return null;

    return date.toLocaleString("en-US", {
        day: "2-digit",
        month: "long",
        year: "numeric",
        hour: "numeric",
        minute: "2-digit",
        hour12: true,
    });
});
</script>

<template>
    <Head title="My Profile" />

    <MainLayout>
        <ContentHeaderComponent text="My Profile" />

        <ContentContainerComponent>
            <InfoComponent>
                <li>
                    Student Number should only be numbers with a dash (-). Refer
                    to your School ID.
                </li>

                <li class="mt-3 md:mt-0">
                    Name shouldn't have any numbers or special characters
                    excluding <b>dot (.)</b>, <b>comma (,)</b>, <b>dash (-)</b>,
                    and <b>apostrophe (')</b>.
                </li>

                <li class="mt-3 md:mt-0">
                    Age should be atleast 16 years old and above.
                </li>

                <li class="mt-3 md:mt-0">
                    Recommended to use your face for the image.
                </li>

                <li class="mt-3 md:mt-0">Image maximum size is 512kb.</li>

                <li class="mt-3 md:mt-0">
                    Acceptable image formats are <b>.jpg</b>, <b>.jpeg</b>, and
                    <b>.png</b>.
                </li>

                <div
                    class="bg-slate-800 grid grid-cols-2 mt-5 px-5 py-3 rounded-md"
                    v-if="page.props.student"
                >
                    <h2><b>Created:</b> {{ created_at }}</h2>
                    <h2><b>Updated:</b> {{ updated_at }}</h2>
                </div>
            </InfoComponent>

            <div class="my-10 text-center" v-if="imagePreview">
                <img
                    :src="imagePreview"
                    class="h-32 inline-block object-cover rounded-full w-32"
                />
            </div>

            <Form
                :action="route('student')"
                :options="{
                    preserveScroll: true,
                }"
                #default="{ errors, processing }"
                disableWhileProcessing
                method="post"
            >
                <div class="gap-5 grid md:grid-cols-2 xl:grid-cols-3">
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

                    <div :key="textField.name" v-for="textField in textFields">
                        <LabelComponent
                            :text="textField.label"
                            :towards="textField.name"
                        />

                        <InputComponent
                            :icon="textField.icon"
                            :name="textField.name"
                            :placeholder="textField.placeholder"
                            :type="textField.type"
                            :value="textField.value"
                        />

                        <ErrorComponent
                            :message="errors[textField.name]"
                            v-if="errors[textField.name]"
                        />
                    </div>

                    <div
                        v-for="selectField in selectFields"
                        :key="selectField.name"
                    >
                        <LabelComponent
                            :text="selectField.label"
                            :towards="selectField.name"
                        />

                        <SelectComponent
                            :icon="selectField.icon"
                            :name="selectField.name"
                            v-model="selectField.model"
                        >
                            <option value="">-- Select --</option>

                            <option
                                :key="option.id"
                                :value="option.id"
                                v-for="option in selectField.options"
                            >
                                {{ option.name }}
                            </option>
                        </SelectComponent>

                        <ErrorComponent
                            :message="errors[selectField.name]"
                            v-if="errors[selectField.name]"
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
