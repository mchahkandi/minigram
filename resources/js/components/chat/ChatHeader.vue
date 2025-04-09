<template>
    <div class="z-20 w-full bg-white shadow-md p-3 mb-4 flex items-center justify-between">
        <div class="flex items-center ml-2 gap-4">
            <button class="md:hidden text-gray-600 hover:text-blue-500" @click="goBack">
                <ArrowLeft class="size-6 text-gray-700"/>
            </button>
            <ChatInfo>
                <template #trigger>
                    <div class="hover:cursor-pointer flex gap-4">
                        <Avatar :fullName="conversation.model.name" :avatarUrl="conversation.model.avatar" />
                        <div class=" flex flex-col">
                            <h1 class="text-lg font-semibold text-gray-800">{{ conversation.model.name }}</h1>
                            <p class="text-sm text-gray-500">last seen recently</p>
                        </div>
                    </div>
                </template>
            </ChatInfo>

        </div>

        <div>
            <EllipsisVertical class="size-6 text-gray-600"/>
        </div>

    </div>
</template>

<script setup>
import { ArrowLeft, EllipsisVertical } from 'lucide-vue-next';
import ChatInfo from '@/components/chat/ChatInfo.vue';
import { useConversationStore } from '@/stores/ConversationStore.js';
import Avatar from '@/components/Avatar.vue';

const conversation = useConversationStore();

const goBack = () => {
    console.log("Going back");
};
</script>

