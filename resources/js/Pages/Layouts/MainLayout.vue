<script setup>
import { ref } from "vue";

import HeadingComponent from "../Components/HeadingComponent.vue";
import NavigationComponent from "../Components/NavigationComponent.vue";
import SubHeadingComponent from "../Components/SubHeadingComponent.vue";

const isVisible = ref(false);

const toggleNavigation = () => {
    isVisible.value = !isVisible.value;

    document.body.classList.toggle("overflow-hidden");
};
</script>

<template>
    <header>
        <section class="fixed left-5 top-5 z-50">
            <Link class="inline-block outline-none" :href="route('home')">
                <img
                    alt="CSU Logo"
                    class="w-20"
                    :src="'/images/icons/logo.png'"
                />
            </Link>
        </section>

        <section class="fixed right-5 top-5 z-50">
            <div
                class="bg-black cursor-pointer inline-block p-4"
                :class="{ open: isVisible }"
                @click="toggleNavigation"
            >
                <div
                    class="bg-white duration-500 h-[0.180rem] relative w-8"
                    id="burgerTop"
                ></div>
                <div
                    class="bg-white duration-500 h-[0.180rem] my-1.5 w-8"
                    id="burgerMiddle"
                ></div>
                <div
                    class="bg-white duration-500 h-[0.180rem] relative w-8"
                    id="burgerBottom"
                ></div>
            </div>
        </section>
    </header>

    <NavigationComponent :is-visible="isVisible" />

    <main class="relative">
        <slot />

        <section
            class="bg-[url(/images/monument.jpg)] bg-center bg-cover bg-no-repeat text-white uppercase md:text-left"
            id="contact"
        >
            <article
                class="bg-black/90 font-black font-montserrat px-5 py-20 relative"
            >
                <div class="max-w-screen-2xl mx-auto">
                    <h2
                        class="font-black font-montserrat text-4xl uppercase md:text-6xl lg:text-7xl"
                    >
                        Contact Us
                    </h2>

                    <div class="gap-5 grid xl:grid-cols-2">
                        <div>
                            <h3 class="text-gray-200 lg:text-2xl">
                                Maura Aparri Cagayan
                            </h3>
                        </div>

                        <div>
                            <a
                                class="border-5 border-white duration-500 font-black font-montserrat hover:bg-white hover:text-black mr-5 px-7 py-3"
                                href="mailto:csuaparri@csu.edu.ph"
                            >
                                SEND US AN EMAIL
                                <span
                                    ><i class="fa-solid fa-paper-plane"></i
                                ></span>
                            </a>

                            <a
                                class="border-5 border-white duration-500 font-black font-montserrat hover:bg-white hover:text-black px-7 py-3"
                                href="tel:(078)8880786"
                            >
                                GIVE US A CALL
                                <span
                                    ><i class="fa-solid fa-phone-volume"></i
                                ></span>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        </section>

        <footer class="bg-black/90 text-white">
            <article class="max-w-screen-2xl mx-auto px-5 py-20">
                <HeadingComponent text="Socials" />

                <div class="gap-5 grid lg:grid-cols-2 lg:text-center">
                    <div>
                        <SubHeadingComponent text="Campus Student Council" />

                        <div
                            class="fb-page"
                            data-href="https://www.facebook.com/CSCAparri"
                            data-tabs="timeline"
                            data-width=""
                            data-height=""
                            data-small-header="false"
                            data-adapt-container-width="true"
                            data-hide-cover="false"
                            data-show-facepile="true"
                        >
                            <blockquote
                                cite="https://www.facebook.com/CSCAparri"
                                class="fb-xfbml-parse-ignore"
                            >
                                <a
                                    class="font-bold uppercase"
                                    href="https://www.facebook.com/CSCAparri"
                                    >Campus Student Council - CSU Aparri</a
                                >
                            </blockquote>
                        </div>
                    </div>

                    <div>
                        <SubHeadingComponent text="Aparri Campus" />

                        <div
                            class="fb-page"
                            data-href="https://www.facebook.com/profile.php?id=100092435460748"
                            data-tabs="timeline"
                            data-width=""
                            data-height=""
                            data-small-header="false"
                            data-adapt-container-width="true"
                            data-hide-cover="false"
                            data-show-facepile="true"
                        >
                            <blockquote
                                cite="https://www.facebook.com/profile.php?id=100092435460748"
                                class="fb-xfbml-parse-ignore"
                            >
                                <a
                                    class="font-bold uppercase"
                                    href="https://www.facebook.com/profile.php?id=100092435460748"
                                    >Cagayan State University - Aparri Campus</a
                                >
                            </blockquote>
                        </div>
                    </div>
                </div>
            </article>
        </footer>

        <footer class="bg-black font-thin p-3 text-center text-sm text-white">
            <p>&copy; Copyright 2026. All Rights Reserved</p>
        </footer>
    </main>
</template>

<style scoped>
#burgerTop,
#burgerMiddle,
#burgerBottom {
    transition: all 0.5s ease;
    transform-origin: center;
}

.open #burgerTop {
    transform: rotate(45deg) translateY(0.875rem);
}

.open #burgerMiddle {
    opacity: 0;
}

.open #burgerBottom {
    transform: rotate(-45deg) translateY(-0.8rem);
}
</style>
