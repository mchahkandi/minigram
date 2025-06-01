<template>
    <div v-show="!(conversation.isSearching)" class="z-10 w-full">
        <div class="relative mt-2 transition-all duration-200 lg:ml-32 lg:mr-48">
            <MessageReply :show="conversation.isReplying" @closeReply="conversation.handleCloseReply" />
        </div>
        <form @submit.prevent="submit" class="mx-2 mb-6 mt-1 flex items-center justify-center">
            <div class="flex min-h-12 w-11/12 items-center rounded-lg bg-white px-4 py-2 shadow-md lg:w-4/6">
                <div class="relative mr-2 flex items-center">
                    <Smile class="size-6 cursor-pointer text-gray-600" @click="toggleEmojiPicker" />
                    <EmojiPicker v-if="showEmojiPicker" :native="true" @select="onSelectEmoji" class="absolute z-10" style="bottom: 50px; left: 0" />
                </div>

                <textarea
                    class="h-12 w-full resize-none content-center rounded-lg text-right focus:outline-none"
                    placeholder="پیام"
                    rows="1"
                    @input="autoResize"
                    v-model="form.content"
                ></textarea>

                <div class="ml-2 flex items-center">
                    <Menu as="div" class="relative">
                        <div>
                            <MenuButton>
                                <Paperclip class="size-6 cursor-pointer text-gray-600" />
                            </MenuButton>
                        </div>

                        <transition
                            enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95"
                        >
                            <MenuItems
                                class="absolute -left-48 z-10 -mt-44 w-56 origin-bottom-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
                            >
                                <div class="py-1">
                                    <MenuItem v-slot="{ active }">
                                        <label
                                            for="file"
                                            :class="[
                                                active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700',
                                                'flex items-start justify-end gap-2 px-4 py-4 text-right text-sm',
                                            ]"
                                        >
                                            عکس یا فیلم<Megaphone
                                        /></label>
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                        <label
                                            for="file"
                                            :class="[
                                                active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700',
                                                'flex items-start justify-end gap-2 px-4 py-4 text-right text-sm',
                                            ]"
                                        >
                                            فایل<Users
                                        /></label>
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
                <input id="file" type="file" @input="form.files = $event.target.files" multiple class="hidden" ref="fileInput" />
            </div>

            <div class="ml-2 size-14 rounded-full bg-white p-4 shadow-sm">
                <button type="submit">
                    <Send class="size-6 cursor-pointer text-gray-600" />
                </button>
            </div>
        </form>

        <!-- Modal for File Preview -->
        <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="w-11/12 rounded-lg bg-white p-4 lg:w-1/3">
                <h2 class="mb-2 text-lg font-bold">Preview Files</h2>
                <div v-for="(file, index) in previewFiles" :key="index" class="mb-2">
                    <div class="flex items-center">
                        <span class="mr-2">{{ file.name }}</span>
                        <input type="text" v-model="file.caption" placeholder="Add a caption" class="rounded border p-1" />
                    </div>
                    <img v-if="file.type.startsWith('image/')" :src="file.url" class="mt-2 h-auto w-full rounded" />
                </div>
                <div class="mt-4 flex justify-end">
                    <button @click="sendFiles" class="rounded bg-blue-500 px-4 py-2 text-white">Send</button>
                    <button @click="closeModal" class="ml-2 rounded bg-gray-300 px-4 py-2 text-black">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { Smile, Paperclip, Send, Users, Megaphone } from 'lucide-vue-next';
import EmojiPicker from 'vue3-emoji-picker';
import 'vue3-emoji-picker/css';
import { useForm } from '@inertiajs/vue3';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import MessageReply from '@/components/chat/MessageReply.vue';
import { useConversationStore } from '@/stores/ConversationStore.js';

const message = ref('');
const showEmojiPicker = ref(false);
const showModal = ref(false);
const previewFiles = ref([]);

const conversation = useConversationStore();

const form = useForm({
    content: '',
    reply_id: computed(() => conversation.replyMessage?.id),
    files: null,
});

const autoResize = (event) => {
    const target = event.target;
    target.style.height = 'auto';
    target.style.height = `${target.scrollHeight}px`;
};

const onSelectEmoji = (emoji) => {
    form.content += emoji.i;
};

const toggleEmojiPicker = () => {
    showEmojiPicker.value = !showEmojiPicker.value;
};

const closeModal = () => {
    showModal.value = false;
    previewFiles.value = [];
};

const messageRoute = computed(() => {
    return conversation.type == 'room' ? 'rooms.messages.store' : 'messages.store';
})

const id = conversation.model.id;

const submit = () => {
    form.post(route(messageRoute.value, { id }), {
        onSuccess: () => {
            form.content = '';
            form.files = null;
            conversation.handleCloseReply();
        },
    });
};
</script>
