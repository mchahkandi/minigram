<script setup lang="ts">
import Modal from '@/components/Modal.vue';
import { ref } from 'vue';
import { Phone, AtSign, Info } from 'lucide-vue-next'
const modalOpen = ref(false);

function openModal() {
    modalOpen.value = true;
}

const user = {
    name: "John Doe",
    imageUrl: "/assets/img/avatar.png",
    username: "@johndoe",
    phoneNumber: "+98 912 458 4574",
    files: {
        images: 4,
        videos: 5,
        documents: 2,
        others: 3
    }
};
</script>

<template>
    <div @click="openModal">
        <slot name="trigger"/>
    </div>

    <Modal :open="modalOpen" @close="modalOpen = false">
        <div class="bg-white p-6 max-w-sm mx-auto">

            <div class="flex items-center mb-16">
                <img :src="user.imageUrl ?? '/assets/img/avatar.png'" alt="User Avatar" class="size-12 rounded-full" />
                <div class=" flex flex-col items-start ml-4">
                    <h1 class="text-lg font-semibold text-gray-800">{{ user.name }}</h1>
                    <p class="text-sm text-gray-500">last seen recently</p>
                </div>
            </div>

            <div class="my-8 text-left space-y-6">
                <div class="flex items-center">
                    <Phone class="text-gray-600" />
                    <div class="ml-6">
                        <h2 class="text-gray-900">{{user.phoneNumber}}</h2>
                        <p class="text-gray-500">Mobile</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <AtSign class="text-gray-600"/>
                    <div class="ml-6">
                        <h2 class="text-gray-900">{{user.username}}</h2>
                        <p class="text-gray-500">Username</p>
                    </div>

                </div>
                <div class="flex items-start">
                    <Info class="text-gray-600 size-12"/>
                    <div class="ml-6">
                        <h2 class="text-gray-900">fdsfsfdsf sfsfdsfsdffsd fsdfdsfdsfsfdsfsdfsfdsfsd fsffdsfs dfsdfdsy6ergdg</h2>
                    </div>

                </div>
            </div>

            <div class="my-8 text-left">
                <ul class="space-y-4 pl-5 text-gray-700">
                    <li>{{ user.files.images }} Images</li>
                    <li>{{ user.files.videos }} Videos</li>
                    <li>{{ user.files.documents }} Documents</li>
                    <li>{{ user.files.others }} Other Files</li>
                </ul>
            </div>
        </div>
    </Modal>
</template>

<style scoped>
</style>
