<template>
    <div class="w-full z-20">
            <form @submit.prevent="submit" class="flex items-center justify-center  mb-6 mt-1">

            <div class="bg-white w-11/12 lg:w-4/6 min-h-12 px-4 py-2 rounded-lg shadow-md flex items-center">
                <div class="relative flex items-center mr-2">
                    <Smile class="size-6 cursor-pointer text-gray-600" @click="toggleEmojiPicker" />
                    <EmojiPicker
                        v-if="showEmojiPicker"
                        :native="true"
                        @select="onSelectEmoji"
                        class="absolute z-10"
                        style="bottom: 50px; left: 0;"
                    />
                </div>

                    <textarea
                        class="w-full h-12 text-right content-center focus:outline-none rounded-lg resize-none"
                        placeholder="پیام"
                        rows="1"
                        @input="autoResize"
                        v-model="form.content"
                    ></textarea>

                    <div class="flex items-center ml-2">
                        <Menu as="div" class="relative">
                            <div>
                                <MenuButton>
                                    <Paperclip class="size-6 cursor-pointer text-gray-600" />
                                </MenuButton>
                            </div>

                            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                <MenuItems class="absolute z-10 -left-48 -mt-44 w-56 origin-bottom-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                                    <div class="py-1">
                                        <MenuItem v-slot="{ active }">
                                            <label for="file" :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'flex items-start justify-end gap-2 px-4 py-4 text-sm text-right']"> عکس یا فیلم<Megaphone/></label>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <label for="file" :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'flex items-start justify-end gap-2 px-4 py-4 text-sm text-right']"> فایل<Users/></label>
                                        </MenuItem>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                    <input id="file" type="file" @input="handleFileInput" multiple class="hidden" ref="fileInput" />
            </div>

            <div class="ml-2 size-14 shadow-sm bg-white p-4 rounded-full">
                <button type="submit">
                    <Send class="size-6 cursor-pointer text-gray-600" />
                </button>
            </div>
            </form>


        <!-- Modal for File Preview -->
        <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg p-4 w-11/12 lg:w-1/3">
                <h2 class="text-lg font-bold mb-2">Preview Files</h2>
                <div v-for="(file, index) in previewFiles" :key="index" class="mb-2">
                    <div class="flex items-center">
                        <span class="mr-2">{{ file.name }}</span>
                        <input type="text" v-model="file.caption" placeholder="Add a caption" class="border rounded p-1" />
                    </div>
                    <img v-if="file.type.startsWith('image/')" :src="file.url" class="mt-2 w-full h-auto rounded" />
                </div>
                <div class="flex justify-end mt-4">
                    <button @click="sendFiles" class="bg-blue-500 text-white px-4 py-2 rounded">Send</button>
                    <button @click="closeModal" class="bg-gray-300 text-black px-4 py-2 rounded ml-2">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Smile, Paperclip, Send, Users, Megaphone } from 'lucide-vue-next';
import EmojiPicker from 'vue3-emoji-picker';
import 'vue3-emoji-picker/css';
import { useForm } from '@inertiajs/vue3';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';

const message = ref('');
const showEmojiPicker = ref(false);
const showModal = ref(false);
const previewFiles = ref([]);

const form = useForm({
    content: '',
    files: null,
});

let user_id = '';

onMounted(() => {
    const pathSegments = window.location.pathname.split('/');
    user_id = pathSegments[pathSegments.length - 1];
});

const autoResize = (event) => {
    const target = event.target;
    target.style.height = 'auto';
    target.style.height = `${target.scrollHeight}px`;
};

const onSelectEmoji = (emoji) => {
    message.value += emoji.i;
};

const toggleEmojiPicker = () => {
    showEmojiPicker.value = !showEmojiPicker.value;
};

const handleFileInput = (event) => {
    const files = Array.from(event.target.files);
    previewFiles.value = files.map(file => ({
        name: file.name,
        type: file.type,
        caption: '',
        url: URL.createObjectURL(file) // Create a URL for preview
    }));
    showModal.value = true; // Show modal after file selection
};

const closeModal = () => {
    showModal.value = false;
    previewFiles.value = [];
};

const sendFiles = () => {
    // Prepare files to send with their captions
    const filesWithCaptions = previewFiles.value.map(file => ({
        file: file,
        caption: file.caption
    }));

    form.files = filesWithCaptions.map(f => f.file);
    form.content = message.value;

    form.post(route('messages.store', { user_id }), {
        onFinish: () => {
            form.reset();
            closeModal();
        },
    });
};

const submit = () => {
    form.post(route('messages.store', { user_id }), {
        onSuccess: () => form.reset(),
    });
};
</script>
