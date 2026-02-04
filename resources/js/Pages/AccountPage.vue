<script setup>
import { computed } from "vue";

import { Form, usePage } from "@inertiajs/vue3";

import ButtonComponent from "./Components/ButtonComponent.vue";
import ErrorComponent from "./Components/ErrorComponent.vue";
import HeadingComponent from "./Components/HeadingComponent.vue";
import InfoComponent from "./Components/InfoComponent.vue";
import InputComponent from "./Components/InputComponent.vue";
import LabelComponent from "./Components/LabelComponent.vue";
import SuccessComponent from "./Components/SuccessComponent.vue";

import MainTemplate from "./Layouts/MainLayout.vue";

const page = usePage();

const fields = [
    {
        icon: "fa-at",
        label: "Email",
        name: "email",
        placeholder: "e.g. johndoe@email.com",
        type: "email",
    },
    {
        icon: "fa-mobile",
        label: "Mobile Number",
        name: "mobile_number",
        placeholder: "e.g. 9123456789",
        type: "text",
    },
];

const fields2 = [
    {
        icon: "fa-key",
        label: "New Password",
        name: "password",
        placeholder: "e.g. secret12345!",
        type: "password",
    },
    {
        icon: "fa-redo",
        label: "Repeat New Password",
        name: "password_confirmation",
        placeholder: "e.g. 9123456789",
        type: "password",
    },
];

/**
 *
 */
const created_at = computed(() => {
    const date = new Date(page.props.auth.user.created_at);

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
    const date = new Date(page.props.auth.user.updated_at);

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
    <Head title="My Account" />

    <MainTemplate>
        <section class="max-w-screen-2xl mx-auto px-5 py-20">
            <HeadingComponent class="text-center" text="My Account" />

            <InfoComponent>
                <ul class="list-disc list-inside">
                    <li>Mobile number should start with 9.</li>
                </ul>

                <div
                    class="bg-slate-800 grid grid-cols-2 mt-5 px-5 py-3 rounded-md"
                >
                    <h2><b>Created:</b> {{ created_at }}</h2>
                    <h2><b>Updated:</b> {{ updated_at }}</h2>
                </div>
            </InfoComponent>

            <Form
                :action="route('account')"
                :options="{
                    preserveScroll: true,
                }"
                #default="{ errors, processing }"
                class="mx-auto md:w-[80%] lg:w-1/2 xl:w-1/3"
                disableWhileProcessing
                method="post"
                preserve
            >
                <div class="mt-5" v-for="field in fields" :key="field.name">
                    <LabelComponent :text="field.label" :towards="field.name" />

                    <InputComponent
                        :icon="field.icon"
                        :id="field.name"
                        :name="field.name"
                        :placeholder="field.placeholder"
                        :type="field.type"
                        :value="page.props.auth.user[field.name]"
                    />

                    <ErrorComponent
                        v-if="errors[field.name]"
                        :message="errors[field.name]"
                    />
                </div>

                <ButtonComponent
                    :processing="processing"
                    icon="fa-user-edit"
                    text="Update Account"
                />

                <SuccessComponent
                    :message="page.flash.successAccount"
                    v-if="page.flash.successAccount"
                />
            </Form>

            <InfoComponent class="mt-20">
                <ul class="list-disc list-inside">
                    <li>Password minimum length is 9 characters.</li>
                    <li class="mt-3 md:mt-0">
                        Password should have atleast 1 uppercase, 1 lowercase, 1
                        number, and 1 special character.
                    </li>
                </ul>
            </InfoComponent>

            <Form
                :action="route('account')"
                :options="{
                    preserveScroll: true,
                }"
                :resetOnError="['password', 'password_confirmation']"
                #default="{ errors, processing }"
                class="mx-auto md:w-[80%] lg:w-1/2 xl:w-1/3"
                disableWhileProcessing
                method="put"
                preserve
                resetOnSuccess
            >
                <div class="mt-5" v-for="field2 in fields2" :key="field2.name">
                    <LabelComponent
                        :text="field2.label"
                        :towards="field2.name"
                    />

                    <InputComponent
                        :icon="field2.icon"
                        :id="field2.name"
                        :name="field2.name"
                        :placeholder="field2.placeholder"
                        :type="field2.type"
                        :value="page.props.auth.user[field2.name]"
                    />

                    <ErrorComponent
                        v-if="errors[field2.name]"
                        :message="errors[field2.name]"
                    />
                </div>

                <ButtonComponent
                    :processing="processing"
                    icon="fa-pen-to-square"
                    text="Update Password"
                />

                <SuccessComponent
                    :message="page.flash.successPassword"
                    v-if="page.flash.successPassword"
                />
            </Form>
        </section>
    </MainTemplate>
</template>
