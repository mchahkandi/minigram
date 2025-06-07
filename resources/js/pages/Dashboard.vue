<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import ChatLayout from '@/components/chat/ChatLayout.vue';


</script>

<template>
    <Head title="Dashboard" />

    <AppLayout>
        <ChatLayout/>
    </AppLayout>
</template>
