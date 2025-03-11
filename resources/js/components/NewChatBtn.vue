<template>
    <Menu as="div" class="absolute bottom-0 right-0 mb-4 mr-4">
        <div>
            <MenuButton class="inline-flex size-14 justify-center items-center gap-x-1.5 rounded-full bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                <Pencil class="-mr-1 size-5 text-gray-800" aria-hidden="true" />
            </MenuButton>
        </div>

        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
            <MenuItems class="absolute right-0 z-10 -mt-60 w-56 origin-bottom-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                <div class="py-1">
                    <MenuItem v-slot="{ active }">

                        <Link href="#" :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'flex items-start justify-end gap-2 px-4 py-4 text-sm text-right']">کانال جدید<Megaphone/></Link>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                        <Link href="#" :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'flex items-start justify-end gap-2 px-4 py-4 text-sm text-right']">گروه جدید<Users/></Link>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                        <Link :href="route('contacts.index')" :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'flex items-start justify-end gap-2 px-4 py-4 text-sm text-right']">پیام جدید<User/></Link>
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>

<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { Pencil, Megaphone, Users, User } from 'lucide-vue-next'
import { Link } from '@inertiajs/vue3'
</script>
