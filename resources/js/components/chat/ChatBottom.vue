<template>
    <div class="absolute bottom-0 w-full">
        <div class="flex items-center justify-center">
            <div class="bg-white w-11/12 lg:w-4/6 min-h-12 my-6 px-4 py-2 rounded-lg shadow-md flex items-center">

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
                    v-model="message"
                ></textarea>

                <div class="flex items-center ml-2">
                    <Paperclip class="size-6 cursor-pointer text-gray-600" />
                </div>
            </div>

            <div class="ml-2 size-14 shadow-sm bg-white p-4 rounded-full">
                <Send class="size-6 cursor-pointer text-gray-600" @click="sendMessage" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Smile, Paperclip, Send } from 'lucide-vue-next';
import EmojiPicker from 'vue3-emoji-picker';
import 'vue3-emoji-picker/css';

const message = ref('');
const showEmojiPicker = ref(false);

const autoResize = (event) => {
    const target = event.target;
    target.style.height = 'auto';
    target.style.height = `${target.scrollHeight}px`;
};

const sendMessage = () => {
    if (message.value.trim() !== '') {
        console.log("Message sent:", message.value);
        message.value = '';
    }
};

const onSelectEmoji = (emoji) => {
    message.value += emoji.i;
};

const toggleEmojiPicker = () => {
    showEmojiPicker.value = !showEmojiPicker.value;
};

</script>

<style scoped>
</style>
