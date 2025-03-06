<script setup lang="ts">
import {  DropdownMenuItem } from '@/components/ui/dropdown-menu';
import { Link } from '@inertiajs/vue3';
import { User, Megaphone, Users } from 'lucide-vue-next';



</script>

<template>

        <DropdownMenuItem :as-child="true" class="h-12">
            <Link class="flex items-end justify-end w-full p-8" :href="route('profile.edit')" as="button">
                کانال جدید
                <Megaphone class="mr-2 h-4 w-4" />
            </Link>
        </DropdownMenuItem>

    <DropdownMenuItem :as-child="true" class="h-12">
        <Link class="flex items-end justify-end w-full p-8" method="post" :href="route('logout')" as="button">
            گروه جدید
            <Users class="mr-2 h-4 w-4" />

        </Link>
    </DropdownMenuItem>

    <DropdownMenuItem :as-child="true" class="h-12">
        <Link class="flex items-end justify-end w-full p-8" :href="route('contacts.index')" as="button">
            پیام جدید
            <User class="mr-2 h-4 w-4" />

        </Link>
    </DropdownMenuItem>
</template>
