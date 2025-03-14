<template>
    <div ref="container" class="scrollbar-hidden flex grow flex-col overflow-y-scroll px-5 py-5">
        <div v-for="(message, index) in activeConversation.messages" :key="index">
            <Message :message="message" />
        </div>
    </div>
</template>

<script setup>
import Message from './Message.vue';
import { computed } from 'vue';

const props = defineProps({
    messages: Object
})

const activeConversation = computed(() => {
    return {
        messages: [
            'dsdas',
            'dsadasd',
        ]
    };
});
</script>

<style scoped>
.scrollbar-hidden {
    scrollbar-width: none;
}

.scrollbar-hidden::-webkit-scrollbar {
    display: none;
}
</style>
