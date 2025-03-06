<script setup lang="ts">
import UserInfo from '@/components/UserInfo.vue';
import { DropdownMenu, DropdownMenuContent, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type SharedData, type User } from '@/types';
import { usePage } from '@inertiajs/vue3';
import { Pencil } from 'lucide-vue-next';
import NewChat from './NewChat.vue';

const page = usePage<SharedData>();
const user = page.props.auth.user as User;
</script>

<template>
    <SidebarMenu>
        <SidebarMenuItem  class="mr-auto">
            <DropdownMenu>
                <DropdownMenuTrigger as-child>
                    <SidebarMenuButton variant="outline" size="lg" class="group bg-white size-12 justify-center rounded-full">
                        <Pencil class="dark:fill-sidebar dark:text-sidebar dark:group-hover:fill-sidebar-primary-foreground dark:group-hover:text-sidebar-primary-foreground" />
                    </SidebarMenuButton>
                </DropdownMenuTrigger>
                <DropdownMenuContent class="w-[--radix-dropdown-menu-trigger-width] min-w-56 rounded-lg" side="bottom" align="end" :side-offset="4">
                    <NewChat />
                </DropdownMenuContent>
            </DropdownMenu>
        </SidebarMenuItem>
    </SidebarMenu>
</template>
