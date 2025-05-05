<script setup lang="ts">
import Modal from '@/components/Modal.vue';
import { computed, ref } from 'vue';
import { Phone, AtSign, Info, XIcon, Users } from 'lucide-vue-next'
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
        info: conversation.type == 'chat' ? conversation.model.last_seen : `${conversation.model.members_count} مشترک`,
        files: {
            images: 4,
            videos: 5,
            documents: 2,
            others: 3
        },
        members: conversation.model.members ?? null,
    }
});
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
                    <p dir="rtl" class="text-sm text-gray-500">{{ data.info }}</p>
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

            <div dir="rtl"  class="flex flex-col items-start">
                <div class="flex items-center mb-2 mr-2">
                    <Users class="text-gray-600"/>
                    <p class="mr-2 text-gray-500"> اعضا</p>
                </div>
                <div class="w-full max-h-40 overflow-y-auto">
                    <div v-for="member in data.members" :key="member.id" class="flex items-center p-2 hover:bg-gray-100 rounded">
                        <Avatar :fullName="member.name" :avatarUrl="member.avatar" class="size-8 text-xs" />
                        <div class="mr-3">
                            <h3 class="text-sm text-gray-800">{{ member.name }}</h3>
                            <p dir="rtl" class="text-xs -mt-1 text-gray-500">{{ member.last_seen  }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </Modal>
</template>

<style scoped>
</style>
