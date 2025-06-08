<template>
    <div
        ref="messagesContainer"
        class=" w-full space-y-2 px-2 lg:pl-32 lg:pr-48 scrollbar-hidden flex grow flex-col overflow-y-scroll"
    >
        <div v-for="(message, id) in localMessages" :data-message-id="message.id" :key="id">
            <Message :message="message" />
        </div>
    </div>
</template>

<script setup lang="ts">
import Message from './Message.vue';
import { nextTick, onMounted, ref, watch } from 'vue';
import { useScrollBottom } from '@/composables/useScrollBottom';
import { useConversationStore } from '@/stores/ConversationStore';

const conversation = useConversationStore();

const messagesContainer = ref(null);
const localMessages = ref({ ...conversation.messages } || {});
const { scrollToBottom } = useScrollBottom(messagesContainer);

watch(
    () => conversation.messages,
    (newMessages) => {
        localMessages.value = { ...newMessages };
    },
    { deep: true }
);

watch(
    () => conversation.messages,
    async () => {
        await nextTick();
        scrollToBottom();
    },
    { deep: true }
);

watch(() => conversation.scrollToMessageId, (newMessageId) => {
    if (newMessageId) {
        scrollToMessage(newMessageId);
    }
});

onMounted( () => {
    scrollToBottom();
})

function scrollToMessage(messageId) {
    const messageElement = messagesContainer.value?.querySelector(`[data-message-id="${messageId}"]`);
    if (messageElement) {
        messageElement.scrollIntoView({ behavior: 'smooth', block: 'center' });

        messageElement.classList.add('highlight-message-active');
        setTimeout(() => {
            messageElement.classList.remove('highlight-message-active');
        }, 2000);

    }
}
</script>

<style scoped>
.scrollbar-hidden {
    scrollbar-width: none;
}

.scrollbar-hidden::-webkit-scrollbar {
    display: none;
}

.highlight-message-active {
    animation: nextDivFade 2s ease-in-out;
}

@keyframes nextDivFade {
    0%   { background-color: #B1C8FA; }
    100% { background-color: transparent; }
}
</style>
