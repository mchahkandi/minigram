<script setup lang="ts">
import {shorten} from '@/utils';

const props = defineProps<{
    message: object;
}>();

</script>

<template>
    <div
        v-if="props.message"
        class="border-l-2 pl-3 cursor-pointer outline-none border-opacity-50 duration-200"
        :class="['border-gray-900', 'dark:border-white', 'dark:border-opacity-50']"
        tabindex="0"
    >
        <!--name-->
        <p
            class="mb-3 font-semibold text-xs leading-4 tracking-[.01rem]"
            :class="[
        'text-black',
        'opacity-60',
        'dark:text-white',
        'dark:opacity-70',
      ]"
        >
            {{ props.message.user?.name }}
        </p>

        <!--content-->
        <p
            v-if="props.message.content"
            class=" text-black opacity-50 dark:text-white dark:opacity-70"
        >
            {{ shorten(props.message?.replied?.content) }}
        </p>

        <!--attachments title-->
        <p
            v-else-if="props.message.attachments"
            class="body-2 text-black opacity-50 dark:text-white dark:opacity-70"
        >
            {{ props?.message?.attachments[0]?.file_name }}
        </p>
    </div>
</template>
