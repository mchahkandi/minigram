<script setup lang="ts">

import { DialogTitle, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { EllipsisVerticalIcon, X } from 'lucide-vue-next';
import SliderContainer from '@/components/SliderContainer.vue';
import Create from '@/pages/contacts/Create.vue';
import { useGlobalStore } from '@/stores/GlobalStore';
import { onMounted, ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import axios from 'axios';
import Button from '@/components/Button.vue';
import Avatar from '@/components/Avatar.vue';
const store = useGlobalStore()

const contacts = ref(null);

    const fetchContacts = () => {
        axios.get(route('contacts.index')).then((res) => {
            contacts.value = res.data;
        })
    }

onMounted(() => {
    fetchContacts();
})


</script>

<template>
    <SliderContainer :open="store.showContactsList">
        <div class="p-6">
            <div class="flex flex-row-reverse items-start justify-between">
                <DialogTitle class="text-base font-semibold leading-6 text-gray-900">مخاطبین</DialogTitle>
                <div class="ml-3 flex h-7 items-center">
                    <button type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-indigo-500" @click="store.showContactsList = false">
                        <span class="sr-only">Close panel</span>
                        <X class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>
            </div>
        </div>

        <ul role="list" class="flex-1  overflow-y-auto mx-2">
            <li v-for="person in contacts" :key="person.id">
                    <Link
                        :href="route( 'chats.show',{id: person.id})"
                        class="w-full group flex items-center justify-between gap-x-3 rounded-md p-4 text-sm font-semibold leading-6 hover:bg-gray-50">
                        <div class="flex gap-x-3">
                            <Avatar :fullName="person.name" :avatarUrl="person.avatar"/>
                            <div class="flex flex-col justify-between">
                                <h2 class="text-gray-900 text-base font-bold">{{ person.name }}</h2>
                                <p class="text-gray-500','truncate p-1 text-gray-500"> {{person.user.last_seen}} </p>
                            </div>
                        </div>
                        <Menu as="div" class="relative ml-2 inline-block flex-shrink-0 text-left">
                            <MenuButton class="group relative inline-flex h-8 w-8 items-center justify-center rounded-full bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <span class="sr-only">Open options menu</span>
                                <span class="flex h-full w-full items-center justify-center rounded-full">
                                                            <EllipsisVerticalIcon class="h-5 w-5 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                                                        </span>
                            </MenuButton>
                            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                <MenuItems class="absolute right-9 top-0 z-10 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <div class="py-1">
                                        <MenuItem v-slot="{ active }">
                                            <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm text-right']">حذف</a>
                                        </MenuItem>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </Link>

            </li>
        </ul>
        <Create/>

    </SliderContainer>
</template>

<style scoped>

</style>
