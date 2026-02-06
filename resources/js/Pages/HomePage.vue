<script setup>
import { onMounted, ref } from "vue";

import { useHomeStore } from "@/Stores/HomeStore";

import HeadingComponent from "./Components/HeadingComponent.vue";
import SubHeadingComponent from "./Components/SubHeadingComponent.vue";

import MainLayout from "./Layouts/MainLayout.vue";

const homeStore = useHomeStore();

const play = ref(true);
const video = ref(null);

const toggleVideo = () => {
    if (!video.value) return;

    if (play.value) {
        video.value.pause();
    } else {
        video.value.play();
    }

    play.value = !play.value;
};

const props = defineProps({
    colleges: Array,
    postGraduates: Array,
    underGraduates: Array,
});

onMounted(() => {
    homeStore.setColleges(props.colleges);
    homeStore.setPostGraduates(props.postGraduates);
    homeStore.setUnderGraduates(props.underGraduates);
});
</script>

<template>
    <Head :title="homeStore.title" />

    <MainLayout>
        <section class="h-screen relative">
            <article
                class="-translate-x-1/2 -translate-y-1/2 absolute font-black font-montserrat left-1/2 text-center text-white top-1/2 w-full z-10"
            >
                <h1 class="text-[2.5rem] md:text-8xl lg:text-9xl">
                    <span class="text-maroon">CSU</span>-APARRI
                </h1>
                <h2 class="font-bold text-sm md:text-3xl lg:text-4xl">
                    STUDENT MANAGEMENT PORTAL
                </h2>
            </article>

            <video
                autoPlay
                class="absolute top-0 left-0 h-screen w-full object-cover"
                loop
                muted
                ref="video"
            >
                <source :src="'/videos/csua-tour.mp4'" type="video/mp4" />
                Your browser does not support the video tag.
            </video>

            <button
                class="absolute border-5 border-white bottom-5 cursor-pointer duration-500 hover:bg-white hover:text-black px-4 py-3 right-5 text-white"
                @click="toggleVideo"
            >
                <span v-if="play"><i class="fa-solid fa-pause"></i></span>
                <span v-else><i class="fa-solid fa-play"></i></span>
            </button>
        </section>

        <section
            class="bg-[url(/images/marble.jpg)] bg-center bg-cover bg-no-repeat px-5 py-20 text-center text-white md:text-left"
        >
            <article class="max-w-screen-2xl mx-auto">
                <HeadingComponent text="Create your Profile" />

                <div class="grid md:grid-cols-2">
                    <div>
                        <a
                            class="border-5 border-white duration-500 font-black font-montserrat hover:bg-white hover:text-black px-7 py-3"
                            :href="route('register')"
                        >
                            JOIN US

                            <span>
                                <i
                                    class="fa-solid fa-arrow-right-to-bracket"
                                ></i>
                            </span>
                        </a>
                    </div>

                    <div class="mt-20 md:mt-0">
                        <SubHeadingComponent text="What we Offer" />

                        <ul class="list-inside text-left">
                            <li>
                                - Keep your school schedule perfectly organized.
                            </li>

                            <li class="mt-3">
                                - Manage all your homework, quizzes, and exams
                                in one place.
                            </li>

                            <li class="mt-3">
                                - Monitor your attendance effortlessly.
                            </li>

                            <li class="mt-3">
                                - Stay on top of your student profile with ease.
                            </li>

                            <li class="mt-3">
                                - Track and organize your grades by subject.
                            </li>

                            <li class="mt-3">
                                - Upload and archive your thesis digitally for
                                easy access.
                            </li>
                        </ul>
                    </div>
                </div>
            </article>
        </section>

        <section
            class="max-w-screen-2xl mx-auto px-5 py-20 text-center"
            id="colleges"
        >
            <HeadingComponent text="College Campuses" />

            <article class="gap-5 grid md:grid-cols-2 lg:grid-cols-4">
                <div v-for="college in homeStore.colleges" :key="college.id">
                    <img
                        :alt="`${college.name} Logo`"
                        :src="`/images/${college.logo}`"
                        class="inline-block w-30"
                    />

                    <p class="font-black mt-3 uppercase">
                        College of {{ college.name }}
                    </p>
                </div>
            </article>
        </section>

        <section
            class="bg-[url(/images/marble.jpg)] bg-center bg-cover bg-no-repeat px-5 py-20 text-center text-white md:text-left"
            id="programs"
        >
            <article class="max-w-screen-2xl mx-auto">
                <HeadingComponent text="Courses Offered" />

                <div class="grid md:grid-cols-2">
                    <div>
                        <SubHeadingComponent text="Undergraduate Programs" />

                        <ul class="list-inside text-left">
                            <li
                                class="font-thin mt-3 uppercase"
                                v-for="underGraduate in homeStore.underGraduates"
                                :key="underGraduate.id"
                            >
                                {{ underGraduate.name }}
                            </li>
                        </ul>
                    </div>

                    <div class="mt-20 md:mt-0">
                        <SubHeadingComponent text="Postgraduate Programs" />

                        <ul class="list-inside text-left">
                            <li
                                class="font-thin mt-3 uppercase"
                                v-for="postGraduate in homeStore.postGraduates"
                                :key="postGraduate.id"
                            >
                                {{ postGraduate.name }}
                            </li>
                        </ul>
                    </div>
                </div>
            </article>
        </section>

        <section
            class="bg-[url(/images/alumni-tracer.png)] bg-center bg-cover bg-no-repeat text-white md:text-left"
        >
            <article class="bg-black/70 px-5 py-20 text-center">
                <HeadingComponent text="CSU-A Alumni Repository" />

                <p
                    class="text-lg tracking-wide w-[95%] max-w-screen-2xl mx-auto mb-10 lg:w-1/2"
                >
                    Stay connected with the Cagayan State University Aparri
                    Alumni System! Our platform lets you update your career
                    journey through the Alumni Directory, find and connect with
                    fellow graduates, and get insights on alumni trends with our
                    Decision Support System. Whether you want to network, share
                    achievements, or stay linked with the university community,
                    CSU Aparri’s alumni platform keeps you connected to your
                    roots and your future.
                </p>

                <a
                    class="border-5 border-white duration-500 font-black font-montserrat hover:bg-white hover:text-black px-7 py-3"
                    href="https://pornhub.com/"
                    target="_blank"
                >
                    VISIT WEBSITE
                    <span
                        ><i class="fa-solid fa-right-to-bracket ml-2"></i
                    ></span>
                </a>
            </article>
        </section>
    </MainLayout>
</template>
