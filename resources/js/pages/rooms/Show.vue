<script setup lang="ts">
import ChatHeader from '@/components/chat/ChatHeader.vue';
import ChatMiddle from '@/components/chat/ChatMiddle.vue';
import ChatBottom from '@/components/chat/ChatBottom.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import ChatLayout from '@/components/chat/ChatLayout.vue';
import { useConversationStore } from '@/stores/ConversationStore';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
    room?: object;
    messages?: object;
}>();

const conversation = useConversationStore()

conversation.type = 'room';
conversation.model = props.room;
conversation.messages = props.messages;

const page = usePage();

const user = page.props.auth.user;

const isOwner = computed(() => {
    return conversation.model?.type === 'group' || user.id === conversation.model?.owner_id;
});

</script>

<template>
    <AppLayout>
        <ChatLayout>
            <ChatHeader />
            <ChatMiddle :messages="messages" :chat="room" />
            <ChatBottom v-if="isOwner" />
        </ChatLayout>
    </AppLayout>
</template>

<style scoped>
</style>
