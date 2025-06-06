<script setup lang="ts">
import type { Ref } from "vue";
import { ArrowDownToLine } from "lucide-vue-next";
import { computed, ref } from "vue";
import { shorten } from '../../utils';

import axios from 'axios';

const props = defineProps<{
    message: {
        attachments: Array<{
            id: number;
            file_name: string;
            file_path: string;
            file_url?: string;
            file_size?: number;
            file_type: string;
        }>;
    };
    self?: boolean;
}>();

const openCarousel: Ref<boolean> = ref(false);
const selectedAttachmentId: Ref<number | undefined> = ref();

const openCarouselWithAttachment = (attachmentId: number) => {
    selectedAttachmentId.value = attachmentId;
    openCarousel.value = true;
};
const closeCarousel = () => (openCarousel.value = false);

const mediaAttachments = computed(() =>
    props.message.attachments.filter((a) => ["png", "jpeg", "jpg", "webp", "gif", "mp4", "mov", "webm"].includes(a.file_type.toLowerCase())),
);

const containsMedia = computed(() => mediaAttachments.value.length > 0);
const firstMediaAttachment = computed(() => mediaAttachments.value[0]);


const isSingleImage = computed(
    () => containsMedia.value && props.message.attachments.length === 1 && ["png", "jpeg", "jpg", "webp", "gif"].includes(firstMediaAttachment.value?.file_type.toLowerCase()),
);

const previewAttachment = (a: (typeof props.message.attachments)[number]) => {
    if (["png", "jpeg", "jpg", "webp", "gif"].includes(a.file_type.toLowerCase())) return a.file_path;
    if (["mp4", "mov", "webm"].includes(a.file_type.toLowerCase())) return a.file_url ?? a.file_path;
    return "";
};

function downloadFile(file: { file_path: string, file_type: string, file_name: string }) {
    axios.get(file.file_path, { responseType: 'blob' })
        .then(response => {
            const blob = new Blob([response.data], { type: file.file_type });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = file.file_name;
            link.click();
            URL.revokeObjectURL(link.href);
        })
        .catch(console.error);
}
</script>

<template>
    <div v-if="isSingleImage" class="pb-4">
        <button
            @click="openCarouselWithAttachment(firstMediaAttachment!.id)"
            class="outline-none"
            :aria-label="firstMediaAttachment!.file_name"
        >
            <img
                :src="firstMediaAttachment!.file_path"
                :alt="firstMediaAttachment!.file_name"
                class="w-full max-w-[22rem] rounded-lg object-cover"
            />
        </button>
    </div>

    <div v-else class="pb-4">
        <div
            v-for="(attachment, index) in props.message.attachments"
            :key="attachment.id ?? index"
            class="mb-2 flex items-start"
        >
            <button @click.prevent="downloadFile(attachment)" class="relative h-16 w-16 rounded overflow-hidden">
                <div
                    class="absolute inset-0 flex items-center justify-center bg-black/10 z-10"
                >
                    <ArrowDownToLine class="h-5 w-5 text-white" />
                </div>
            <template v-if="['png', 'jpeg', 'jpg', 'webp', 'gif'].includes(attachment.file_type.toLowerCase())">
                <img
                    :src="previewAttachment(attachment)"
                    alt="preview"
                    class="h-16 w-16 object-cover rounded"
                />
            </template>
            <template v-else>
                <div
                    class="h-16 w-16 flex items-center justify-center rounded bg-gray-300 text-sm font-medium uppercase"
                >
                </div>
            </template>
            </button>

            <!-- File info -->
            <div class="ml-3 flex-1 text-right">
                <span class="block font-medium">{{ shorten(attachment.file_name) }}</span>
                <span class="text-xs text-gray-500"
                >{{ ((attachment.file_size ?? 0) / 1024).toFixed(1) }} KB</span
                >
            </div>
        </div>
    </div>

</template>
