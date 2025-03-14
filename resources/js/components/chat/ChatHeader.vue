<template>
    <div class="w-full absolute top-0 bg-white shadow-md p-4 flex items-center justify-between">
        <div class="flex items-center ml-2 gap-4">
            <button class="md:hidden text-gray-600 hover:text-blue-500" @click="goBack">
                <ArrowLeft class="size-6 text-gray-700"/>
            </button>
            <img :src="avatarUrl" alt="User Avatar" class="size-10 rounded-full" />
            <div class=" flex flex-col">
            <h1 class="text-lg font-semibold text-gray-800">{{ title }}</h1>
            <p class="text-sm text-gray-500">last seen recently</p>
            </div>
        </div>

        <div>
            <EllipsisVertical class="size-6 text-gray-600"/>
        </div>

    </div>
</template>

<script setup>
import { ref, defineProps } from 'vue';
import { ArrowLeft, EllipsisVertical } from 'lucide-vue-next';
const props = defineProps({
    user: Object
});

const goBack = () => {
    console.log("Going back");
};
</script>

