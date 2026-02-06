<script setup>
import { Form, usePage } from "@inertiajs/vue3";

import ButtonComponent from "./Components/ButtonComponent.vue";
import ContentContainerComponent from "./Components/ContentContainerComponent.vue";
import ContentHeaderComponent from "./Components/ContentHeaderComponent.vue";
import ErrorComponent from "./Components/ErrorComponent.vue";
import InputComponent from "./Components/InputComponent.vue";
import LabelComponent from "./Components/LabelComponent.vue";
import SuccessComponent from "./Components/SuccessComponent.vue";

import MainLayout from "./Layouts/MainLayout.vue";

const page = usePage();

const fields = [
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
        placeholder: "e.g. secret12345!",
        type: "password",
    },
];

defineProps({
    email: String,
    token: String,
});
</script>

<template>
    <Head title="Change Password" />

    <MainLayout>
        <section>
            <ContentHeaderComponent text="Change Password" />

            <ContentContainerComponent>
                <Form
                    :action="route('password.update')"
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
                    <input :value="token" name="token" type="hidden" />
                    <input :value="email" name="email" type="hidden" />

                    <div class="mt-5" v-for="field in fields" :key="field.name">
                        <LabelComponent
                            :text="field.label"
                            :towards="field.name"
                        />

                        <InputComponent
                            :icon="field.icon"
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
                        icon="fa-edit"
                        text="Update Password"
                    />

                    <SuccessComponent
                        :message="page.flash.success"
                        v-if="page.flash.success"
                    />
                </Form>
            </ContentContainerComponent>
        </section>
    </MainLayout>
</template>
