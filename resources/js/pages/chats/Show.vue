<script setup lang="ts">
import { ref, watch, onMounted } from 'vue';
import ChatHeader from '@/components/chat/ChatHeader.vue';
import ChatMiddle from '@/components/chat/ChatMiddle.vue';
import ChatBottom from '@/components/chat/ChatBottom.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import ChatLayout from '@/components/chat/ChatLayout.vue';

const props = defineProps<{
    user?: object;
    chat?: object;
    messages?: object;
}>();


</script>

<template>
    <AppLayout>
        <ChatLayout>
            <ChatHeader :user="user" />
            <ChatMiddle :messages="messages" :chat="chat" />
            <ChatBottom />
        </ChatLayout>
    </AppLayout>
</template>

<style scoped>
</style>
