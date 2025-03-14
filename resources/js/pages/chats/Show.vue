<script setup lang="ts">
import ChatHeader from '@/components/chat/ChatHeader.vue';
import ChatMiddle from '@/components/chat/ChatMiddle.vue';
import ChatBottom from '@/components/chat/ChatBottom.vue';

defineProps<{
    user?: object;
    chat?: object;
    messages?: object;
}>();

</script>

<template>

    <div
        class="h-full flex flex-col scrollbar-hidden"
    >
        <ChatHeader :user="user" />
        <ChatMiddle :messages="messages" />
        <ChatBottom />
    </div>

</template>

<style scoped>

</style>
