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
                            <p dir="rtl" class="text-sm text-gray-500">{{ conversation.type == 'chat' ? conversation.model.last_seen : `${conversation.model.members_count} مشترک` }}</p>
                        </div>
                    </div>
                </template>
            </ChatInfo>

        </div>

        <div v-if="conversation.isSearching" class="flex items-center relative">
            <button @click="conversation.isSearching = false" class="absolute left-3 text-gray-500">
                <X />
            </button>

            <input
                v-model="conversation.searchQuery"
                @input="conversation.handleSearch()"
                class="w-80 focus:border-blue-500 outline-none rounded-full border-2 border-gray-300 text-right pl-10 pr-10 py-2"
                type="text"
                placeholder="جستجو"
            />

            <button class="absolute right-3 text-gray-500">
                <Search />
            </button>

            <div class="right-0 z-50 fixed bottom-0 flex items-center justify-between bg-white h-14 w-full pl-96">
                <p class="px-8">
                    نمایش {{ conversation.currentSearchPosition }} از {{ conversation.totalSearchResults }}
                </p>
                <div class="flex gap-x-4 px-8">
                    <button
                        @click="conversation.prevSearchResult"
                        :disabled="!conversation.hasSearchResults"
                        class="p-1 rounded hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <ChevronDown class="w-5 h-5"/>
                    </button>

                    <button
                        @click="conversation.nextSearchResult"
                        :disabled="!conversation.hasSearchResults"
                        class="p-1 rounded hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <ChevronUp class="w-5 h-5"/>
                    </button>
                </div>

            </div>
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
                            <MenuItem v-slot="{ close, active }">
                                <button
                                    @click.prevent="(conversation.isSearching = true); close()"
                                    :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'w-full flex items-start justify-end gap-2 px-4 py-4 text-sm text-right']"
                                >
                                    جستجو <Search />
                                </button>
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
import { ArrowLeft, EllipsisVertical, Search, Trash2, X, ChevronUp, ChevronDown } from 'lucide-vue-next';
import ChatInfo from '@/components/chat/ChatInfo.vue';
import { useConversationStore } from '@/stores/ConversationStore.js';
import Avatar from '@/components/Avatar.vue';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import Button from '@/components/Button.vue';
import Modal from '@/components/Modal.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const conversation = useConversationStore();

console.log(conversation);


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

