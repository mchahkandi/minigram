<script setup lang="ts">
import { ref, watch, onMounted } from 'vue';
import ChatHeader from '@/components/chat/ChatHeader.vue';
import ChatMiddle from '@/components/chat/ChatMiddle.vue';
import ChatBottom from '@/components/chat/ChatBottom.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import ChatLayout from '@/components/chat/ChatLayout.vue';
import { useConversationStore } from '@/stores/ConversationStore';
import { useScrollBottom } from '@/composables/useScrollBottom';

const props = defineProps<{
    user?: object;
    chat?: object;
    messages?: object;
}>();

const conversation = useConversationStore()

conversation.type = 'chat';
conversation.model = props.user;
conversation.model['chat'] = props.chat;
conversation.messages = props.messages;

onMounted(() => {
    Echo.private(`chats.${props.chat?.id}`)
        .listen("ChatMessageSent", (response) => {
            if (response.message?.messagable?.id == conversation?.model?.chat?.id && conversation?.type == 'chat') {
                conversation.messages[response.message.id] = response.message;
            }
        });
});

</script>

<template>
    <AppLayout>
        <ChatLayout>
            <ChatHeader />
            <ChatMiddle />
            <ChatBottom />
        </ChatLayout>
    </AppLayout>
</template>

<style scoped>
</style>
