<script setup lang="ts">
import Modal from '@/components/Modal.vue';
import { computed, ref } from 'vue';
import { Phone, AtSign, Info, XIcon } from 'lucide-vue-next'
import Avatar from '@/components/Avatar.vue';
import { useConversationStore } from '@/stores/ConversationStore';
import { Link } from '@inertiajs/vue3';

const modalOpen = ref(false);

function openModal() {
    modalOpen.value = true;
}

const conversation = useConversationStore();

const data = computed(() => {
    return {
        title: conversation.model.name,
        imageUrl: conversation.model.avatar,
        username: conversation.type == 'chat' ? conversation.model.username : conversation.model.link,
        phoneNumber: conversation.model.phone_number ?? '',
        bio: conversation.type == 'chat' ? conversation.model.bio : conversation.model.description,
        files: {
            images: 4,
            videos: 5,
            documents: 2,
            others: 3
        }
    }
});

console.log(data);
</script>

<template>
    <div @click="openModal">
        <slot name="trigger"/>
    </div>

    <Modal :open="modalOpen" @close="modalOpen = false">
        <div class="bg-white p-6 max-w-sm mx-auto">

            <div class="flex items-center mb-16">
                <Avatar :fullName="data.title" :avatarUrl="data.imageUrl" />
                <div class=" flex flex-col items-start ml-4">
                    <h1 class="text-lg font-semibold text-gray-800">{{ data.title }}</h1>
                    <p class="text-sm text-gray-500">last seen recently</p>
                </div>
                <XIcon class="ml-auto hover:cursor-pointer" @click.prevent="modalOpen = false" />
            </div>

            <div dir="rtl" class="my-8 text-right space-y-6 p-3">
                <div v-if="data.phoneNumber" class="flex items-center">
                    <Phone class="text-gray-600" />
                    <div class="mr-6">
                        <h2 dir="ltr" class="text-gray-900">{{data.phoneNumber}}</h2>
                        <p class="text-gray-500">شماره تلفن</p>
                    </div>
                </div>
                <div v-if="data.username" class="flex items-center">
                    <AtSign class="text-gray-600"/>
                    <div class="mr-6">
                        <h2 dir="ltr" class="text-gray-900">{{data.username}}</h2>
                        <p class="text-gray-500">نام کاربری</p>
                    </div>

                </div>
                <div v-if="data.bio" class="flex items-start">
                    <Info class="text-gray-600"/>
                    <div class="mr-6">
                        <p class="text-gray-900"> {{data.bio}} </p>
                        <p class="text-gray-500"> بیوگرافی </p>

                    </div>

                </div>
            </div>
            <div class="border-t border-gray-300 my-4 w-full"></div>
            <div class="my-8">
                <Link href="#" class="text-blue-500 text-base font-semibold  w-full block p-3 rounded" >{{ conversation.type == 'chat' ? 'ارسال پیام' : 'نمایش' }}</Link>
            </div>
        </div>
    </Modal>
</template>

<style scoped>
</style>
