<script setup lang="ts">
import { computed, ref, onMounted } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import MessageMenu from '@/components/chat/MessageMenu.vue';
import Button from '@/components/Button.vue';
import { LoaderCircle } from 'lucide-vue-next';
import Modal from '@/components/Modal.vue';
import { useConversationStore } from '@/stores/ConversationStore';

const page = usePage()
const user = computed(() => page.props.auth.user)
const conversation = useConversationStore()

const props = defineProps<{
    message: {
        id: number;
        content: string;
        created_at?: string;
    };
}>();

const isSelf = computed(() => user.value.id === props.message.user_id && conversation.type === 'chat');

const showContextMenu = ref(false);
const contextMenuX = ref(0);
const contextMenuY = ref(0);

const deleteModalOpen = ref(false);


const handleCloseContextMenu = () => {
    showContextMenu.value = false;
};

const handleContextMenu = (event: MouseEvent) => {
    contextMenuX.value = event.pageX;
    contextMenuY.value = event.pageY;
    showContextMenu.value = true;
}

const contextConfig = {
    handler: handleCloseContextMenu,
    events: ["contextmenu"],
};


function openDeleteModal() {
    deleteModalOpen.value = true;
}

function deleteMessage () {
    router.delete(route('messages.destroy', [props.message.id]), {
        onSuccess: () => deleteModalOpen.value = false,
    })
}


onMounted(() => {
    document.addEventListener('click', handleCloseContextMenu);
});

</script>

<template>
    <div class="select-none" >
        <div class="xs:mb-6 md:mb-5 flex" :class="isSelf ? 'justify-end' : 'justify-start'">

            <div class="flex items-end">
                <div
                    @click="handleCloseContextMenu"
                    v-click-outside="contextConfig"
                    @contextmenu.prevent="handleContextMenu"
                    class="group max-w-[31.25rem] p-4 rounded-b transition duration-500"
                    :class="{
                        'rounded-tl rounded-xl ml-4 order-3 bg-gray-50': isSelf,
                        'rounded-tr bg-white dark:bg-gray-600': !isSelf
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
        <MessageMenu
            v-if="showContextMenu"
            :handle-close-context-menu="handleCloseContextMenu"
            :message="props.message"
            :x="contextMenuX"
            :y="contextMenuY"
            @delete-message="openDeleteModal"
        />

        <Modal :open="deleteModalOpen" @close="deleteModalOpen = false">
            <div class="p-4">
                <h2 class="mb-4 text-lg font-semibold"> حذف پیام </h2>
                    <div class="grid gap-6">
                        <p>از حذف پیام مطمئن هستید؟</p>
                        <div class="flex gap-2">
                            <Button @click.prevent="deleteMessage" class="mt-4 w-full" :tabindex="4" >
                                حذف
                            </Button>
                            <button class="mt-4 w-full rounded-md bg-gray-200" @click.prevent="deleteModalOpen = false">بازگشت</button>
                        </div>
                    </div>
            </div>
        </Modal>
    </div>
</template>

<style scoped>
/* Add any necessary styles here */
</style>
