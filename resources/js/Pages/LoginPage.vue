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
    <Head title="Login" />

    <MainLayout>
        <ContentHeaderComponent text="Sign-In" />

        <ContentContainerComponent>
            <Form
                :action="route('login')"
                :resetOnError="['password']"
                #default="{ errors, processing }"
                class="mx-auto md:w-[80%] lg:w-1/2 xl:w-1/3"
                disableWhileProcessing
                method="post"
                resetOnSuccess
            >
                <div>
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
                </div>

                <div class="mt-5">
                    <LabelComponent text="Password" towards="password" />

                    <InputComponent
                        icon="fa-lock"
                        name="password"
                        placeholder="e.g. secret12345!"
                        type="password"
                    />

                    <ErrorComponent
                        :message="errors.password"
                        v-if="errors.password"
                    />
                </div>

                <div class="grid grid-cols-2 mt-3">
                    <div class="ml-1">
                        <input
                            class="cursor-pointer scale-150 transform"
                            id="remember"
                            name="remember"
                            type="checkbox"
                        />

                        <label
                            class="cursor-text inline-block ml-2"
                            for="remember"
                            >Remember Me</label
                        >
                    </div>

                    <div class="text-right">
                        <AnchorComponent
                            :link="route('password.request')"
                            text="Forgot Password?"
                        />
                    </div>
                </div>

                <ButtonComponent
                    :processing="processing"
                    icon="fa-right-to-bracket"
                    text="Sign-In"
                />

                <SuccessComponent
                    :message="page.flash.success"
                    v-if="page.flash.success"
                />
            </Form>

            <hr class="border-maroon mx-auto my-10 md:w-1/2 lg:w-1/4" />

            <p class="text-center">
                Don't have an account yet?
                <AnchorComponent :link="route('register')" text="Register" />
            </p>
        </ContentContainerComponent>
    </MainLayout>
</template>
