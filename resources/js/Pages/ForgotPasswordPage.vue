<script setup>
import { Form, usePage } from "@inertiajs/vue3";

import AnchorComponent from "./Components/AnchorComponent.vue";
import ButtonComponent from "./Components/ButtonComponent.vue";
import ContentContainerComponent from "./Components/ContentContainerComponent.vue";
import ContentHeaderComponent from "./Components/ContentHeaderComponent.vue";
import ErrorComponent from "./Components/ErrorComponent.vue";
import InputComponent from "./Components/InputComponent.vue";
import LabelComponent from "./Components/LabelComponent.vue";
import SuccessComponent from "./Components/SuccessComponent.vue";

import MainLayout from "./Layouts/MainLayout.vue";

const page = usePage();
</script>

<template>
    <Head title="Forgot Password" />

    <MainLayout>
        <section>
            <ContentHeaderComponent text="Forgot Password" />

            <ContentContainerComponent>
                <Form
                    :action="route('password.email')"
                    :options="{
                        preserveScroll: true,
                    }"
                    #default="{ errors, processing }"
                    class="mx-auto md:w-[80%] lg:w-1/2 xl:w-1/3"
                    disableWhileProcessing
                    method="post"
                    preserve
                    resetOnSuccess
                >
                    <LabelComponent text="Email" towards="email" />

                    <InputComponent
                        icon="fa-at"
                        name="email"
                        placeholder="e.g. johndoe@email.com"
                        type="email"
                    />

                    <ErrorComponent
                        v-if="errors.email"
                        :message="errors.email"
                    />

                    <ButtonComponent
                        :processing="processing"
                        icon="fa-paper-plane"
                        text="Reset Password"
                    />

                    <SuccessComponent
                        :message="page.flash.success"
                        v-if="page.flash.success"
                    />
                </Form>

                <hr class="border-maroon mx-auto my-10 md:w-1/2 lg:w-1/4" />

                <p class="text-center">
                    Remembered your password?
                    <AnchorComponent :link="route('login')" text="Login" />
                </p>
            </ContentContainerComponent>
        </section>
    </MainLayout>
</template>
