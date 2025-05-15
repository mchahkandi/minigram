<script setup lang="ts">

import { defineEmits, ref } from 'vue';
import { X } from 'lucide-vue-next';
import { useConversationStore } from '@/stores/ConversationStore';
import { shorten } from '@/utils';

const props = defineProps({
    show: {
        type: Boolean
    }
});

const emits = defineEmits<{
    (e: 'closeReply'): void;
}>();

const handleCloseReply = () => {
    emits('closeReply');
}

const conversation = useConversationStore();

</script>

<template>
    <Transition animation="shelf-up">
        <div
            class="absolute bottom-0 w-full rounded-t-lg -mb-2 px-5 py-2 bg-white dark:bg-gray-800 flex items-center justify-between transition-all duration-200"
            v-if="props.show"
        >
            <div
                v-if="props.show"
                class="border-l-2 pl-3 cursor-pointer outline-none border-opacity-50 duration-200"
                :class="['border-gray-900', 'dark:border-white', 'dark:border-opacity-50']"
                tabindex="0"
            >
                <!--name-->
                <p
                    class="mb-3 font-semibold text-xs leading-4 tracking-[.01rem]"
                    :class="[
                    'text-black',
                    'opacity-60',
                    'dark:text-white',
                    'dark:opacity-70',
                  ]"
                >
                    {{ conversation?.replyMessage?.user?.name }}
                </p>

                <!--content-->
                <p
                    class="body-2 text-black opacity-50 dark:text-white dark:opacity-70"
                >
                   {{ shorten(conversation.replyMessage.content) }}
                </p>

            </div>

            <X class="hover:cursor-pointer" @click="handleCloseReply"/>

        </div>
    </Transition>
</template>

<style scoped>
/* slide left */
.slide-left-enter-active {
    transition: all 0.2s;
}

.slide-left-leave-active {
    transition: all 0.2s;
}

.slide-left-enter-from {
    opacity: 0;
    transform: translateX(30px);
}

.slide-left-leave-to {
    opacity: 0;
    transform: translateX(-30px);
}

/* slide right */
.slide-right-enter-active {
    transition: all 0.2s;
}

.slide-right-leave-active {
    transition: all 0.2s;
}

.slide-right-enter-from {
    opacity: 0;
    transform: translateX(-30px);
}

.slide-right-leave-to {
    opacity: 0;
    transform: translateX(30px);
}

/* slide up */
.slide-up-enter-active {
    transition: all 0.2s;
}

.slide-up-leave-active {
    transition: all 0.2s;
}

.slide-up-enter-from {
    opacity: 0;
    transform: translateY(-30px);
}

.slide-up-leave-to {
    opacity: 0;
    transform: translateY(-30px);
}

/* slide down */
.slide-down-enter-active {
    transition: all 0.2s;
}

.slide-down-leave-active {
    transition: all 0.2s;
}

.slide-down-enter-from {
    opacity: 0;
    transform: translateY(-50px);
}

.slide-down-leave-to {
    opacity: 0;
    transform: translateY(-50px);
}

/* shelf up */
.shelf-up-enter-active {
    transition: all 0.2s;
}

.shelf-up-leave-active {
    transition: all 0.2s;
}

.shelf-up-enter-from {
    opacity: 0;
    transform: translateY(30px);
}

.shelf-up-leave-to {
    opacity: 0;
    transform: translateY(30px);
}

/* shelf down */
.shelf-down-enter-active {
    transition: all 0.2s;
}

.shelf-down-leave-active {
    transition: all 0.2s;
}

.shelf-down-enter-from {
    opacity: 0;
    transform: translateY(-30px);
}

.shelf-down-leave-to {
    opacity: 0;
    transform: translateY(-30px);
}
</style>
