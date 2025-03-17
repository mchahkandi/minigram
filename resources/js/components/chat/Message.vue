<script setup lang="ts">
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const user = computed(() => page.props.auth.user)

const props = defineProps<{
    message: {
        id: number;
        content: string;
        created_at?: string;
    };
}>();

const isSelf = computed(() => user.value.id === props.message.id);
</script>

<template>
    <div class="select-none">
        <div class="xs:mb-6 md:mb-5 flex" :class="isSelf ? 'justify-start' : 'justify-end'">

            <div class="flex items-end">
                <div
                    class="group max-w-[31.25rem] p-4 rounded-b transition duration-500"
                    :class="{
                        'rounded-tl rounded-xl ml-4 order-3 bg-white': isSelf,
                        'rounded-tr bg-gray-50 dark:bg-gray-600': !isSelf
                    }"
                >
                    <p class="body-2 outline-none text-black opacity-60 dark:text-white dark:opacity-70">
                        {{ props.message.content }}
                    </p>

                    <!-- Uncomment if you have attachments -->
                    <!-- Attachments -->
                    <!-- <Attachments v-if="props.message.attachments?.length > 0" :message="props.message" :self="isSelf" /> -->
                </div>

                <!-- Date -->
<!--                <div :class="isSelf ? 'ml-2 order-1' : 'mr-4 order-1'">-->
<!--                    <p class="body-1 text-color whitespace-pre">-->
<!--                        {{ props.message.created_at }}-->
<!--                    </p>-->
<!--                </div>-->
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Add any necessary styles here */
</style>
