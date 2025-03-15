<script setup lang="ts">
import ChatHeader from '@/components/chat/ChatHeader.vue';
import ChatMiddle from '@/components/chat/ChatMiddle.vue';
import ChatBottom from '@/components/chat/ChatBottom.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import ChatLayout from '@/components/chat/ChatLayout.vue';
import { onMounted } from 'vue';

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
            <ChatMiddle :messages="messages" />
            <ChatBottom />
        </ChatLayout>
    </AppLayout>



</template>

<style scoped>

</style>
