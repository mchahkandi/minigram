<script setup lang="ts">
import type { Ref } from "vue";
import { ArrowDown, Play } from "lucide-vue-next";
import { computed, ref } from "vue";


const props = defineProps<{
    message: object;
    self?: boolean;
}>();

const openCarousel: Ref<boolean> = ref(false);

const selectedAttachmentId: Ref<number | undefined> = ref();

const openCarouselWithAttachment = (attachmentId: number) => {
    selectedAttachmentId.value = attachmentId;
    openCarousel.value = true;
};

// close the carousel
const closeCarousel = () => {
    openCarousel.value = false;
};

// check if the message contains images or videos
const containsMedia = computed(() => {
    if (props.message.attachments) {
        for (let attachment of props.message.attachments) {
            if (["image", "video"].includes(attachment.file_type)) return true;
        }
    }
    return false;
});

// number of videos attached to this message.
const numberOfMedia = computed(() => {
    let counter = 0;

    if (props.message.attachments) {
        for (let attachment of props.message.attachments) {
            if (["video", "image"].includes(attachment.file_type)) {
                counter += 1;
            }
        }
    }

    return counter;
});

// test is the attachment is the second media item.
const isNumber = (
    attachment: object,
    number: number,
    largerThan?: boolean,
) => {
    let counter = 0;
    let caseCorrect = false;

    if (props.message.attachments) {
        for (let item of props.message.attachments) {
            if (["video", "image"].includes(item.file_type)) {
                counter += 1;

                if (largerThan) {
                    if (item.id === attachment.id && counter > number) {
                        caseCorrect = true;
                    }
                } else {
                    if (item.id === attachment.id && counter === number) {
                        caseCorrect = true;
                    }
                }
            }
        }
    }

    return caseCorrect;
};
</script>

<template>
    <div>
        <div class="flex">
            <div
                v-for="(attachment, index) in message.attachments"
                :key="index"
                class="mr-2 flex items-end"
                :class="{ 'mt-4': containsMedia }"
            >
                <!--image-->
                <button
                    @click="openCarouselWithAttachment(attachment.id)"
                    class="outline-none"
                    :aria-label="
            numberOfMedia > 2
              ? (props.message.attachments as []).length -
                1 +
                ' more attachments'
              : attachment.file_name
          "
                >
                    <div
                        v-if="!isNumber(attachment, 2, true)"
                        :style="{ backgroundImage: `url(${attachment.file_path})` }"
                        class="rounded bg-cover bg-center"
                        :class="
              numberOfMedia === 1
                ? ['w-[12.5rem]', 'h-[12.5rem]']
                : [
                    'md:w-[6.875rem]',
                    'md:h-[6.25rem]',
                    'xs:w-[6.25rem]',
                    'xs:h-[5.9375rem]',
                  ]
            "
                    >
                        <!--first image-->
                        <div
                            v-if="isNumber(attachment, 1)"
                            class="w-full h-full flex justify-center items-center rounded bg-black bg-opacity-20 hover:bg-opacity-10 transition duration-200"
                        ></div>

                        <!--more images overlay-->
                        <div
                            v-if="isNumber(attachment, 2) && numberOfMedia > 2"
                            class="w-full h-full flex items-center justify-center rounded bg-black bg-opacity-40 text-white hover:bg-opacity-10 transition duration-200"
                        >
                            {{ (props.message.attachments as []).length - 1 }}+
                        </div>
                    </div>
                </button>

                <!--video-->
                <button
                    v-if="attachment.file_type === 'video'"
                    @click="openCarouselWithAttachment(attachment.id)"
                    class="overflow-hidden outline-none"
                    :aria-label="
            numberOfMedia > 2
              ? (props.message.attachments as []).length -
                1 +
                ' more attachments'
              : attachment.file_name
          "
                >
                    <div
                        v-if="!isNumber(attachment, 2, true)"
                        :style="{ backgroundImage: `url(${attachment.file_url})` }"
                        class="rounded bg-cover bg-center"
                        :class="
              numberOfMedia === 1
                ? ['w-[12.5rem]', 'h-[12.5rem]']
                : [
                    'md:w-[6.875rem]',
                    'md:h-[6.25rem]',
                    'xs:w-[6.25rem]',
                    'xs:h-[5.9375rem]',
                  ]
            "
                    >
                        <!--first video-->
                        <div
                            v-if="isNumber(attachment, 1)"
                            class="w-full h-full flex justify-center items-center rounded bg-black bg-opacity-20 hover:bg-opacity-10 transition duration-200"
                        >
              <span
                  class="p-3 rounded-full bg-white bg-opacity-40 transition-all duration-200"
              >
                <Play class="w-5 h-5 text-white" />
              </span>
                        </div>

                        <!--second video-->
                        <div
                            v-else-if="isNumber(attachment, 2) && numberOfMedia < 3"
                            class="w-full h-full flex justify-center items-center rounded bg-black bg-opacity-20 hover:bg-opacity-10 transition duration-200"
                        >
              <span
                  class="p-3 rounded-full bg-white bg-opacity-40 transition-all duration-200"
              >
                <Play class="w-5 h-5 text-white" />
              </span>
                        </div>

                        <!--more videos overlay-->
                        <div
                            v-else-if="isNumber(attachment, 2) && numberOfMedia > 2"
                            class="w-full h-full flex items-center justify-center rounded bg-black bg-opacity-40 text-white hover:bg-opacity-10 transition duration-200"
                        >
                            {{ (props.message.attachments as []).length - 1 }}+
                        </div>
                    </div>
                </button>

                <!--file-->
                <div v-if="attachment.file_type === 'file' && !containsMedia">
                    <div class="flex">
                        <!--download button / icons-->
                        <button
                            c
                            class="w-8 h-8 mr-4 flex justify-center rounded-full outline-none items-center duration-200"
                            :class="
                props.self
                  ? ['bg-indigo-300']
                  : [
                      'bg-indigo-50',
                      'hover:bg-indigo-100',
                      'active:bg-indigo-200',
                      'dark:bg-gray-400',
                      'dark:hover:bg-gray-300',
                      'dark:focus:bg-gray-300',
                      'dark:active:bg-gray-200',
                    ]
              "
                        >
                            <ArrowDown
                                class="stroke-2 h-5 w-5"
                                :class="
                  props.self
                    ? ['text-white']
                    : ['text-blue-500', 'dark:text-gray-50']
                "
                            />
                        </button>

                        <div class="flex flex-col justify-center">
                            <p
                                class="heading-2 mb-3"
                                :class="
                  props.self
                    ? ['text-black opacity-50 dark:text-white dark:opacity-70 ']
                    : [
                        'text-black',
                        'opacity-50',
                        'dark:text-white',
                        'dark:opacity-70',
                      ]
                "
                            >
                                {{ attachment.file_name }}
                            </p>

                            <p
                                class="body-2"
                                :class="
                  props.self
                    ? ['text-black opacity-60 dark:text-white dark:opacity-70']
                    : [
                        'text-black',
                        'opacity-50',
                        'dark:text-white',
                        'dark:opacity-70',
                      ]
                "
                            >
                                {{ attachment.file_size }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!--carousel modal-->
<!--            <Carousel-->
<!--                :open="openCarousel"-->
<!--                :starting-id="selectedAttachmentId as number"-->
<!--                :close-carousel="closeCarousel"-->
<!--            />-->
        </div>
    </div>
</template>
