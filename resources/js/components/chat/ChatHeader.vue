<template>
    <div class="z-20 w-full bg-white shadow-md p-3 mb-4 flex items-center justify-between">
        <div class="flex items-center ml-2 gap-4">
            <button class="md:hidden text-gray-600 hover:text-blue-500" @click="goBack">
                <ArrowLeft class="size-6 text-gray-700"/>
            </button>
            <ChatInfo>
                <template #trigger>
                    <div class="hover:cursor-pointer flex gap-4">
                        <Avatar :fullName="conversation.model.name" :avatarUrl="conversation.model.avatar" />
                        <div class=" flex flex-col">
                            <h1 class="text-lg font-semibold text-gray-800">{{ conversation.model.name }}</h1>
                            <p class="text-sm text-gray-500">last seen recently</p>
                        </div>
                    </div>
                </template>
            </ChatInfo>

        </div>

        <div>
            <Menu as="div" class="mr-4">
                <div>
                    <MenuButton class="flex justify-center items-center gap-x-1.5 px-3 py-2 text-sm font-semibold text-gray-900">
                        <EllipsisVertical class="size-6 text-gray-600"/>
                    </MenuButton>
                </div>

                <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                    <MenuItems class="absolute right-0 z-10 mt-6 mr-8 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                        <div class="py-1">
                            <MenuItem v-slot="{ active }">

                                <button :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'w-full flex items-start justify-end gap-2 px-4 py-4 text-sm text-right']"> جستجو <Search/></button>
                            </MenuItem>
                            <MenuItem class="hover:text-red-500" v-slot="{ active }">
                                <button @click.prevent="openDeleteModal" :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-red-500', 'w-full flex items-start justify-end gap-2 px-4 py-4 text-sm text-right']"> حذف گفتگو <Trash2/></button>
                            </MenuItem>
                        </div>
                    </MenuItems>
                </transition>
            </Menu>
        </div>

        <Modal :open="deleteModalOpen" @close="deleteModalOpen = false">
            <div class="p-4">
                <h2 class="mb-4 text-lg font-semibold"> حذف گفتگو </h2>
                <div class="grid gap-6">
                    <p>از حذف گفتگو مطمئن هستید؟</p>
                    <div class="flex gap-2">
                        <Button @click.prevent="deleteChat" class="mt-4 w-full bg-red-500 hover:bg-red-600" :tabindex="4" >
                            حذف
                        </Button>
                        <button class="mt-4 w-full rounded-md bg-gray-200" @click.prevent="deleteModalOpen = false">بازگشت</button>
                    </div>
                </div>
            </div>
        </Modal>

    </div>
</template>

<script setup>
import { ArrowLeft, EllipsisVertical, Search, Trash2 } from 'lucide-vue-next';
import ChatInfo from '@/components/chat/ChatInfo.vue';
import { useConversationStore } from '@/stores/ConversationStore.js';
import Avatar from '@/components/Avatar.vue';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import Button from '@/components/Button.vue';
import Modal from '@/components/Modal.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const conversation = useConversationStore();


const deleteModalOpen = ref(false);

function openDeleteModal() {
    deleteModalOpen.value = true;
}

const deleteChat = ( () => {
    const rt = `${conversation.type}s.${conversation.type == 'chat' ? 'destroy' : 'leave'}`;

    router.delete(route(rt,conversation.model.id));
})

const goBack = () => {
    console.log("Going back");
};
</script>

