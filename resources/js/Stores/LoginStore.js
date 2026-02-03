import { defineStore } from "pinia";

export const useLoginStore = defineStore("login", {
    state: () => ({
        title: "Login",
    }),
    actions: {
        setTitle(title) {
            this.title = title;
        },
    },
});
