import { defineStore } from "pinia";

export const useProfileStore = defineStore("profile", {
    state: () => ({
        genders: [],
        programs: [],
        title: "My Profile",
        student: [],
    }),
    actions: {
        setGenders() {
            this.genders = [
                { id: "Male", name: "Male" },
                { id: "Female", name: "Female" },
            ];
        },
        setPrograms(data) {
            this.programs = data;
        },
        setStudent(data) {
            this.student = data;
        },
        setTitle(title) {
            this.title = title;
        },
    },
});
