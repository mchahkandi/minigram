// src/stores/useConversationStore.ts
import { defineStore } from 'pinia';

export const useConversationStore = defineStore('conversation', {
    state: () => ({
        type: '',
        model: {},
        isReplying: false,
        replyId: null,
        messages: [],
    }),

    getters: {
    },

    actions: {
        clearMessages() {
            this.messages = [];
        },
    },
});
