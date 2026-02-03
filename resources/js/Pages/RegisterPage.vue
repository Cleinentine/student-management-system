<script setup>
import { Form } from "@inertiajs/vue3";

import { useRegisterStore } from "@/Stores/RegisterStore";

import AnchorComponent from "./Components/AnchorComponent.vue";
import ButtonComponent from "./Components/ButtonComponent.vue";
import ErrorComponent from "./Components/ErrorComponent.vue";
import HeadingComponent from "./Components/HeadingComponent.vue";
import InfoComponent from "./Components/InfoComponent.vue";
import InputComponent from "./Components/InputComponent.vue";
import LabelComponent from "./Components/LabelComponent.vue";

import MainLayout from "./Layouts/MainLayout.vue";

const registerStore = useRegisterStore();

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
    {
        icon: "fa-key",
        label: "Password",
        name: "password",
        placeholder: "e.g. secret12345!",
        type: "password",
    },
    {
        icon: "fa-redo",
        label: "Repeat Password",
        name: "password_confirmation",
        placeholder: "e.g. secret12345!",
        type: "password",
    },
];
</script>

<template>
    <Head :title="registerStore.title" />

    <MainLayout>
        <section>
            <article
                class="bg-[url(/images/marble.jpg)] bg-center bg-cover bg-no-repeat px-5 py-20 text-center text-white md:text-left"
            >
                <div class="max-w-screen-2xl mx-auto">
                    <HeadingComponent text="Sign-Up" />
                </div>
            </article>

            <article class="max-w-screen-2xl mx-auto px-5 py-20">
                <InfoComponent>
                    <ul class="list-disc list-inside">
                        <li><b>All fields are required.</b></li>
                        <li>Mobile number should start with 9.</li>
                        <li>Password minimum length is 9 characters.</li>
                        <li>
                            Password should have atleast 1 uppercase, 1
                            lowercase, 1 number, and 1 special character.
                        </li>
                    </ul>
                </InfoComponent>

                <Form
                    :action="route('register')"
                    :options="{
                        preserveScroll: true,
                    }"
                    :resetOnError="['password', 'password_confirmation']"
                    #default="{ errors, processing }"
                    class="mx-auto md:w-[80%] lg:w-1/2 xl:w-1/3"
                    disableWhileProcessing
                    method="post"
                    preserve
                    resetOnSuccess
                >
                    <div class="mt-5" v-for="field in fields" :key="field.name">
                        <LabelComponent
                            :text="field.label"
                            :towards="field.name"
                        />

                        <InputComponent
                            :icon="field.icon"
                            :id="field.name"
                            :name="field.name"
                            :placeholder="field.placeholder"
                            :type="field.type"
                        />

                        <ErrorComponent
                            v-if="errors[field.name]"
                            :message="errors[field.name]"
                        />
                    </div>

                    <ButtonComponent
                        :processing="processing"
                        icon="fa-user-plus"
                        text="Sign-Up"
                    />
                </Form>

                <hr class="border-maroon mx-auto my-10 md:w-1/2 lg:w-1/4" />

                <p class="text-center">
                    Already registered an account?
                    <AnchorComponent :link="route('login')" text="Login" />
                </p>
            </article>
        </section>
    </MainLayout>
</template>
