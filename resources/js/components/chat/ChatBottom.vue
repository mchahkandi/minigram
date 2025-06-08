<template>
    <div v-show="!(conversation.isSearching)" class="z-10 w-full">
        <div class="relative mt-2 ml-2 mr-[5rem] transition-all duration-200 lg:ml-32 lg:mr-48">
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
                <input id="file" type="file" @input="form.files = $event.target.files" @change="showModal = true" multiple class="hidden" ref="fileInput" />
            </div>

            <div class="ml-2 size-14 rounded-full bg-white p-4 shadow-sm">
                <button type="submit">
                    <Send class="size-6 cursor-pointer text-gray-600" />
                </button>
            </div>
        </form>


        <Modal :open="showModal" @close="showModal = false">
            <div class="py-4 px-8">
                <h2 class="mb-4 text-lg font-semibold"> ارسال فایل </h2>
                <div class="grid gap-6">
                    <div
                        v-for="(file, index) in form.files"
                        :key="index"
                        class="mb-2 flex items-start"
                    >
                        <!-- Preview on the left -->
                        <template v-if="file.type.startsWith('image/')">
                            <img
                                :src="previewFile(file)"
                                alt="preview"
                                class="h-16 w-16 object-cover rounded"
                            />
                        </template>
                        <template v-else>
                            <div
                                class="h-16 w-16 flex items-center justify-center rounded bg-gray-200 text-sm font-medium uppercase"
                            >
                                {{ file.name.split('.').pop() }}
                            </div>
                        </template>

                        <!-- Name (right‑aligned) and size underneath -->
                        <div class="ml-3 flex-1 text-right">
                            <span class="block font-medium">{{ file.name }}</span>
                            <span class="text-xs text-gray-500">{{ (file.size / 1024).toFixed(1) }} KB</span>
                        </div>
                    </div>
                    <div>
                        <label for="content" class="block text-right text-sm/6 font-medium text-gray-900"> عنوان</label>
                        <input
                            id="content"
                            type="text"
                            v-model="form.content"
                            class="mt-1 text-right block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 ring-1 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-1 focus:outline-blue-600 sm:text-sm/6"
                        />
                    </div>

                    <div class="flex gap-2">
                        <Button @click.prevent="submit" class="mt-4 w-full" :tabindex="4" >
                            ارسال
                        </Button>
                        <button class="mt-4 w-full rounded-md bg-gray-200" @click.prevent="showModal = false">بازگشت</button>
                    </div>
                </div>
            </div>
        </Modal>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from 'vue';
import { Smile, Paperclip, Send, Users, Megaphone } from 'lucide-vue-next';
import EmojiPicker from 'vue3-emoji-picker';
import 'vue3-emoji-picker/css';
import { useForm } from '@inertiajs/vue3';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import MessageReply from '@/components/chat/MessageReply.vue';
import { useConversationStore } from '@/stores/ConversationStore.js';
import Modal from '@/components/Modal.vue';
import Button from '@/components/Button.vue';

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

function previewFile(file) {
    const objectURL = URL.createObjectURL(file);
    return objectURL;
}

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
            showModal.value = false;
        },
    });
};
</script>
