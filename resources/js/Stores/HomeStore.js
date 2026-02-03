import { defineStore } from "pinia";

export const useHomeStore = defineStore("home", {
    state: () => ({
        colleges: [],
        postGraduates: [],
        title: "Home",
        underGraduates: [],
    }),
    actions: {
        setColleges(data) {
            this.colleges = data;
        },
        setPostGraduates(data) {
            this.postGraduates = data;
        },
        setTitle(title) {
            this.title = title;
        },
        setUnderGraduates(data) {
            this.underGraduates = data;
        },
    },
});
