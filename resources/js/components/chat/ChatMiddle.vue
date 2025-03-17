<template>
    <div ref="messagesContainer" class="h-full w-full pl-32 pr-48 scrollbar-hidden flex grow flex-col overflow-y-scroll ">
        <div v-for="(message, index) in props.messages" :key="index">
            <Message :message="message" />
        </div>
    </div>
</template>

<script setup>
import Message from './Message.vue';
import { nextTick, ref, watch } from "vue";

const props = defineProps({
    messages: Array
});

const messagesContainer = ref(null);

watch(
    () => props.messages,
    async () => {
        await nextTick();
        if (messagesContainer.value) {
            messagesContainer.value.scrollTo({
                top: messagesContainer.value.scrollHeight,
                behavior: "smooth"
            });
        }
    },
    { deep: true }
);

</script>

<style scoped>
.scrollbar-hidden {
    scrollbar-width: none;
}

.scrollbar-hidden::-webkit-scrollbar {
    display: none;
}
</style>
