<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <slot />
    </AppLayout>
</template>
