import { defineStore } from "pinia";

export const useRegisterStore = defineStore("register", {
    state: () => ({
        title: "Register",
    }),
    actions: {
        setTitle(title) {
            this.title = title;
        },
    },
});
