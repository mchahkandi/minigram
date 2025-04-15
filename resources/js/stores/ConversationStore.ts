// src/stores/useConversationStore.ts
import { defineStore } from 'pinia';
import axios from 'axios';

export const useConversationStore = defineStore('conversation', {
    state: () => ({
        type: '',
        model: {},
        isReplying: false,
        replyId: null,
        messages: [],
        isSearching: false,
        searchQuery: '',
        searchResults: [],
        currentSearchIndex: -1,
        scrollToMessageId: null,
    }),
    getters: {
        currentSearchResult: (state) => {
            return state.searchResults[state.currentSearchIndex] || null;
        },
        hasSearchResults: (state) => state.searchResults.length > 0,
        currentSearchPosition: (state) => state.currentSearchIndex + 1,
        totalSearchResults: (state) => state.searchResults.length,
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
        async handleSearch() {
            if (this.searchQuery.length > 3) {
                try {
                    const response = await axios.get(route('chats.messages.search', this.model.id), {
                        params: { content: this.searchQuery }
                    });
                    this.searchResults = response.data;
                } catch (error) {
                    console.error('Error fetching search results:', error);
                    this.searchResults = [];
                }
            }
        },
        nextSearchResult() {
            if (this.searchResults.length === 0) return;
            this.currentSearchIndex =
                (this.currentSearchIndex + 1) % this.searchResults.length;
            this.scrollToCurrentResult();
        },
        prevSearchResult() {
            if (this.searchResults.length === 0) return;
            this.currentSearchIndex =
                (this.currentSearchIndex - 1 + this.searchResults.length) % this.searchResults.length;
            this.scrollToCurrentResult();
        },
        scrollToCurrentResult() {
            if (this.currentSearchIndex >= 0 && this.currentSearchResult) {
                this.scrollToMessageId = this.currentSearchResult.id;
                setTimeout(() => this.scrollToMessageId = null, 100);
            }
        },
    },
});
