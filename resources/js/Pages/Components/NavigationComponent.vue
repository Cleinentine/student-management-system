<script setup>
import { defineProps } from "vue";

const props = defineProps({
    isVisible: Boolean,
});

const mainLinks = [
    {
        name: "Home",
        route: "/",
        target: "_self",
    },
    {
        name: "#Colleges",
        route: "#colleges",
        target: "_blank",
    },
    {
        name: "#Programs",
        route: "#programs",
        target: "_blank",
    },
    {
        name: "#Contact",
        route: "#contact",
        target: "_blank",
    },
    {
        name: "Alumni",
        route: "https://pornhub.com/",
        target: "_blank",
    },
];

const authLinks = [
    {
        name: "My Profile",
        route: "student",
    },
    {
        name: "My Schedule",
        route: "home",
    },
    {
        name: "My Grades",
        route: "home",
    },
    {
        name: "My Attendance",
        route: "home",
    },
    {
        name: "My Account",
        route: "account",
    },
];

const guestLinks = [
    {
        name: "Login",
        route: "login",
    },
    {
        name: "Register",
        route: "register",
    },
    {
        name: "Forgot Password",
        route: "password.request",
    },
];

const miscLinks = [
    {
        name: "Send Feedback",
        route: "home",
    },
    {
        name: "Privacy Policy",
        route: "home",
    },
    {
        name: "Terms & Conditions",
        route: "home",
    },
];
</script>

<template>
    <Transition name="fade-slide">
        <nav
            class="bg-black fixed font-black font-montserrat h-screen overflow-y-scroll pt-30 text-white uppercase w-full z-40 md:text-5xl xl:text-9xl"
            id="navigation"
            v-if="props.isVisible"
        >
            <ul>
                <li v-for="mainLink in mainLinks" :key="mainLink.name">
                    <a
                        class="block duration-500 hover:text-maroon p-5 md:p-10 lg:p-20"
                        :href="mainLink.route"
                        :target="mainLink.target"
                    >
                        {{ mainLink.name }}
                    </a>
                </li>

                <hr
                    class="bg-maroon border-0 h-1 ml-5 w-1/2 md:ml-10 lg:ml-20"
                />

                <div v-if="$page.props.auth.user">
                    <li v-for="authLink in authLinks" :key="authLink.name">
                        <a
                            class="block duration-500 hover:text-maroon p-5 md:p-10 lg:p-20"
                            :href="route(authLink.route)"
                        >
                            {{ authLink.name }}
                        </a>
                    </li>
                </div>

                <div v-else>
                    <li v-for="guestLink in guestLinks" :key="guestLink.name">
                        <a
                            class="block duration-500 hover:text-maroon p-5 md:p-10 lg:p-20"
                            :href="route(guestLink.route)"
                        >
                            {{ guestLink.name }}
                        </a>
                    </li>
                </div>

                <hr
                    class="bg-maroon border-0 h-1 ml-5 w-1/2 md:ml-10 lg:ml-20"
                />

                <li v-for="miscLink in miscLinks" :key="miscLink.name">
                    <a
                        class="block duration-500 hover:text-maroon p-5 md:p-10 lg:p-20"
                        :href="route(miscLink.route)"
                    >
                        {{ miscLink.name }}
                    </a>
                </li>
            </ul>
        </nav>
    </Transition>
</template>

<style scoped>
.fade-slide-enter-active,
.fade-slide-leave-active {
    transition:
        opacity 0.3s ease,
        transform 0.3s ease;
}

.fade-slide-enter-from,
.fade-slide-leave-to {
    opacity: 0;
    transform: translateY(-20px);
}

.fade-slide-enter-to,
.fade-slide-leave-from {
    opacity: 1;
    transform: translateY(0);
}
</style>
