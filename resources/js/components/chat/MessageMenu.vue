<!-- MessageMenu.vue -->
<template>
    <transition name="scale">
        <div
            v-if="visible"
            :style="{ top: `${y}px`, left: `${x}px` }"
            class="fixed z-50 w-[12.5rem] bg-white border border-gray-300 shadow-lg rounded-md py-2"
        >
            <ul class="list-none p-0 m-0 text-right">
                <li class="cursor-pointer px-4 py-2 hover:bg-gray-100" @click="handleReply">پاسخ</li>
                <li class="cursor-pointer px-4 py-2 hover:bg-gray-100" @click="handleDelete">کپی</li>
                <li class="cursor-pointer px-4 py-2 hover:bg-gray-100" @click="handleDelete">حذف</li>
            </ul>
        </div>
    </transition>
</template>

<script setup lang="ts">
import { ref, defineEmits } from 'vue'

const props = defineProps<{
    messageId: number;
    x: number;
    y: number;
}>();

const emits = defineEmits<{
    (e: 'reply', messageId: number): void;
    (e: 'delete', messageId: number): void;
}>();

const visible = ref(true);

const handleReply = () => {
    emits('reply', props.messageId);
    visible.value = false;
}

const handleDelete = () => {
    emits('delete', props.messageId);
    visible.value = false;
}

</script>

<style scoped>
.scale-enter-active {
    transition: all 0.1s ease-out;
}

.scale-leave-active {
    transition: all 0.075s ease-in;
}

.scale-enter-from {
    opacity: 0;
    transform: scale(0.95);
}

.scale-enter-to {
    opacity: 1;
    transform: scale(1);
}

.scale-leave-from {
    opacity: 1;
    transform: scale(1);
}

.scale-leave-to {
    opacity: 0;
    transform: scale(0.95);
}
</style>
