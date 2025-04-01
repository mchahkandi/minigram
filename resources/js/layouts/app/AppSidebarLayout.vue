<template>
    <div>
        <!-- Static sidebar for desktop -->
        <div class="md:fixed md:inset-y-0 md:z-50 md:flex md:w-80 md:flex-col lg:w-96">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6">
                <div class="flex h-16 shrink-0 items-center">
                    <p>minigram</p>
                </div>
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2">
                                <li v-for="item in conversations" :key="item.name">
                                    <Link
                                        :href="route(item.type == 'chat' ? 'chats.show' : '',{id: item.route})"
                                        :class="[
                                            item.current ? 'bg-gray-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50',
                                            'group flex gap-x-3 rounded-md p-4 text-sm font-semibold leading-6',
                                        ]"
                                    >
                                        <img :src="item.avatar ?? '/assets/img/background.png'" alt="User Avatar" class="size-14 rounded-full" />
                                        <div class="flex flex-col justify-between">
                                            <h2 class="text-base font-bold text-gray-900">{{ item.title }}</h2>
                                            <p class="truncate p-1 text-gray-500">{{ item.last_message }}</p>
                                        </div>
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

const page = usePage();

const conversations = page.props.conversations.data;

</script>
