<template>
    <div
        ref="messagesContainer"
        class="h-full w-full space-y-2 px-2 lg:pl-32 lg:pr-48 scrollbar-hidden flex grow flex-col overflow-y-scroll"
    >
        <div v-for="(message, id) in localMessages" :key="id">
            <Message :message="message" />
        </div>
    </div>
</template>

<script setup lang="ts">
import Message from './Message.vue';
import { nextTick, onMounted, ref, watch } from 'vue';

const props = defineProps({
    messages: Object,
    chat: Object
});

const messagesContainer = ref(null);
const localMessages = ref({ ...props.messages } || {});

watch(
    () => props.messages,
    (newMessages) => {
        localMessages.value = { ...newMessages };
    },
    { deep: true }
);

watch(
    () => localMessages.value,
    async () => {
        await nextTick();
        if (messagesContainer.value) {
            messagesContainer.value.scrollTo({
                top: messagesContainer.value.scrollHeight,
                behavior: 'smooth'
            });
        }
    },
    { deep: true }
);

onMounted(() => {
    Echo.private(`chats.${props.chat?.id}`)
        .listen("ChatMessageSent", (response) => {
            console.log(response);
            localMessages.value[response.message.id] = response.message;
        });
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
