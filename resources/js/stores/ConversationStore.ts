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
        handleReply(id) {
            console.log(id);
            this.replyId = id;
            this.isReplying = true;
            console.log(this.replyId);
        },
        handleCloseReply() {
            this.replyId = null;
            this.isReplying = false;
        },
    },
});
