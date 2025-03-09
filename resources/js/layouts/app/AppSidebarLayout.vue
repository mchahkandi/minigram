<template>
    <div>


        <!-- Static sidebar for desktop -->
        <div class=" md:fixed md:inset-y-0 md:z-50 md:flex md:w-80 md:flex-col lg:w-96">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6">
                <div class="flex h-16 shrink-0 items-center">
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" />
                </div>
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li v-for="item in navigation" :key="item.name">
                                    <a :href="item.href" :class="[item.current ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
                                        <component :is="item.icon" :class="[item.current ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600', 'h-6 w-6 shrink-0']" aria-hidden="true" />
                                        {{ item.name }}
                                    </a>
                                </li>
                            </ul>
                        </li>


                    </ul>
                </nav>
            </div>
        </div>

        <div class="sticky top-0 z-40 flex items-center gap-x-6 bg-white px-4 py-4 shadow-sm sm:px-6 lg:hidden">
            <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="sidebarOpen = true">
                <span class="sr-only">Open sidebar</span>
                <Bars3Icon class="h-6 w-6" aria-hidden="true" />
            </button>
            <div class="flex-1 text-sm font-semibold leading-6 text-gray-900">Dashboard</div>
            <a href="#">
                <span class="sr-only">Your profile</span>
                <img class="h-8 w-8 rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
            </a>
        </div>

        <main class="py-10 lg:pl-72">
            <div class="px-4 sm:px-6 lg:px-8">
                <!-- Your content -->
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue'
import {
    Home
} from 'lucide-vue-next'

const navigation = [
    { name: 'Dashboard', href: '#', icon: Home, current: true },
]
const teams = [
    { id: 1, name: 'Heroicons', href: '#', initial: 'H', current: false },
    { id: 2, name: 'Tailwind Labs', href: '#', initial: 'T', current: false },
    { id: 3, name: 'Workcation', href: '#', initial: 'W', current: false },
]

const sidebarOpen = ref(false)
</script>
