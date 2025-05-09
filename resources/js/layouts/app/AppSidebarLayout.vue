<template>
    <div>
        <!-- Static sidebar for desktop -->
        <div class="md:fixed md:inset-y-0 md:z-30 md:flex md:w-80 md:flex-col lg:w-96">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6">
                <div class="flex h-16 shrink-0 items-center gap-2">
                    <Menu as="div">
                        <div>
                            <MenuButton class="inline-flex size-12 justify-center items-center gap-x-1.5 rounded-full text-sm font-semibold text-gray-900 hover:bg-gray-50">
                                <MenuIcon class="size-5 text-gray-800" aria-hidden="true" />
                            </MenuButton>
                        </div>

                        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="absolute w-72 left-6 z-10 mt-2 w-56 origin-top-left rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                                <div class="py-1">
                                    <MenuItem v-slot="{ active }">
                                        <button @click.prevent="globalStore.showProfileSlider = true" :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'w-full flex items-start justify-end gap-6 px-6 py-4 text-sm text-right']"> پروفایل <CircleUser/></button>
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                        <button :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'w-full flex items-start justify-end gap-6 px-6 py-4 text-sm text-right']">کانال جدید<Megaphone/></button>
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                        <Link href="#" :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'flex items-start justify-end gap-6 px-6 py-4 text-sm text-right']">گروه جدید<Users/></Link>
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                        <button @click.prevent="globalStore.showContactsList = true" :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'w-full flex items-start justify-end gap-6 px-6 py-4 text-sm text-right']"> مخاطبین <User/></button>
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                    <p>minigram</p>
                </div>
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 overflow-hidden">
                                <li v-for="item in conversations" :key="item.title">
                                    <Link
                                        :href="route(item.type == 'chat' ? 'chats.show' : 'rooms.show',{id: item.route})"
                                        :class="[
                                            isCurrentConversation(item) ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-gray-50',
                                            'group flex gap-x-3 rounded-md p-4 text-sm font-semibold leading-6',
                                        ]"
                                    >
                                        <Avatar :fullName="item.title" :avatarUrl="item.avatar"/>
                                        <div class="flex flex-col justify-between">
                                            <h2 :class="[isCurrentConversation(item) ? 'text-white' : 'text-gray-900', 'text-base font-bold ']">{{ item.title }}</h2>
                                            <p :class="[isCurrentConversation(item) ? 'text-white' : 'text-gray-500','truncate p-1 text-gray-500']">{{ item.last_message }}</p>
                                        </div>
                                        <span
                                            v-if="item.unread_messages > 0"
                                            class="text-xs size-6 text-center font-medium text-white bg-green-500 rounded-full p-1 ml-auto self-center"
                                        >
                                            {{ item.unread_messages > 9 ? '9+' : item.unread_messages }}
                                        </span>
                                    </Link>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <NewChatBtn />
            </div>
        </div>

        <!--        <div class="sticky top-0 z-40 flex items-center gap-x-6 bg-white px-4 py-4 shadow-sm sm:px-6 lg:hidden">-->
        <!--            <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="sidebarOpen = true">-->
        <!--                <span class="sr-only">Open sidebar</span>-->
        <!--                <Bars3Icon class="h-6 w-6" aria-hidden="true" />-->
        <!--            </button>-->
        <!--            <div class="flex-1 text-sm font-semibold leading-6 text-gray-900">Dashboard</div>-->
        <!--            <a href="#">-->
        <!--                <span class="sr-only">Your profile</span>-->
        <!--                <img class="h-8 w-8 rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />-->
        <!--            </a>-->
        <!--        </div>-->
        <CreateRoom/>
        <ContactList/>
        <Profile/>
        <main class="hidden md:flex lg:pl-96">
            <slot />
        </main>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import NewChatBtn from '@/components/NewChatBtn.vue';
import { usePage } from '@inertiajs/vue3';
import CreateRoom from '@/components/CreateRoom.vue';
import ContactList from '@/components/ContactList.vue';
import Avatar from '@/components/Avatar.vue';
import { useConversationStore } from '@/stores/ConversationStore';
import { Megaphone, MenuIcon, CircleUser, User, Users } from 'lucide-vue-next';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { useGlobalStore } from '@/stores/GlobalStore.js';
import Profile from '@/components/Profile.vue';

const globalStore = useGlobalStore()

const page = usePage();

const conversations = page.props.conversations.data;

const conversation = useConversationStore()

const isCurrentConversation = (item) => {
    return conversation.model.id === item.route &&
        conversation.type == (item.type == 'chat' ? 'chat' : 'room');
};

</script>
