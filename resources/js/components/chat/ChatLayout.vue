<template>
    <div class="relative w-full h-screen overflow-hidden">
        <img class="absolute inset-0 w-full h-full object-cover" src="/assets/img/background.png" alt="Background Image">
        <div class="absolute inset-0 bg-gradient-to-bl from-blue-500 via-sky-100 to-blue-500 opacity-50"></div>
        <div class="relative z-10 flex flex-col items-center justify-center h-full">
            <slot/>
        </div>
    </div>

</template>

<script setup>


</script>

<style scoped>
</style>
