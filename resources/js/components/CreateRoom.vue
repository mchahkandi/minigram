<script setup lang="ts">

import SliderContainer from '@/components/SliderContainer.vue';
import Button from '@/components/Button.vue';
import InputError from '@/components/InputError.vue';
import { LoaderCircle, X, Camera } from 'lucide-vue-next';
import { useForm } from '@inertiajs/vue3';
import { DialogTitle } from '@headlessui/vue';
import { useGlobalStore } from '@/stores/GlobalStore';
import { computed } from 'vue';

const store = useGlobalStore()

const handleClose = () => {
    store.showNewRoomSlider = false;
}

const form = useForm({
    name: '',
    description: '',
    link: '',
    avatar: '',
    type: computed(() => store.newRoomType)
});

const submit = () => {
    form.post(route('rooms.store'), {
        onSuccess: () => {
            handleClose();
        },
    });
};
</script>

<template>
    <SliderContainer :open="store.showNewRoomSlider">
        <div class="p-6">
            <div class="flex flex-row-reverse items-start justify-between">
                <DialogTitle class="text-base font-semibold leading-6 text-gray-900">{{store.newRoomType == 'channel' ? 'کانال' : 'گروه'}} جدید</DialogTitle>
                <div class="ml-3 flex h-7 items-center">
                    <button type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-indigo-500" @click="handleClose">
                        <X class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>
            </div>
        </div>
        <form @submit.prevent="submit" class="flex flex-col items-center gap-6 p-6">
                <div class="relative size-32 rounded-full bg-gray-200 flex items-center justify-center p-4">
                    <label for="avatar" class="text-gray-600 hover:cursor-pointer w-full h-full rounded-full flex items-center justify-center">
                        <Camera class="size-10"/>
                    </label>
                    <input type="file" @input="form.avatar = $event.target.files[0]" id="avatar" accept="image/*" class="hidden" />
                </div>
                <div class="w-full">
                    <label for="name" class="block text-right text-sm/6 font-medium text-gray-900"> نام</label>
                    <div class="mt-2">
                        <input
                            type="text"
                            v-model="form.name"
                            id="name"
                            required="true"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 ring-1 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-1 focus:outline-blue-600 sm:text-sm/6"
                        />
                        <InputError :message="form.errors.name" />
                    </div>
                </div>

                <div class="w-full">
                    <label for="phone" class="block text-right text-sm/6 font-medium text-gray-900"> توضیحات</label>
                    <div class="mt-2">
                        <input
                            type="text"
                            v-model="form.description"
                            id="phone"
                            autocomplete="phone"
                            required="true"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 ring-1 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-1 focus:outline-blue-600 sm:text-sm/6"
                        />
                        <InputError :message="form.errors.description" />
                    </div>
                </div>

                <div class="w-full">
                    <label for="phone" class="block text-right text-sm/6 font-medium text-gray-900"> لینک</label>
                    <div class="mt-2">
                        <input
                            type="text"
                            v-model="form.link"
                            id="phone"
                            required="true"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 ring-1 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-1 focus:outline-blue-600 sm:text-sm/6"
                        />
                        <InputError :message="form.errors.link" />
                    </div>
                </div>

                <div class="w-full flex gap-2">
                    <Button type="submit" class="mt-4 w-full" :tabindex="4" :disabled="form.processing">
                        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                        ایجاد
                    </Button>
                </div>
        </form>
    </SliderContainer>
</template>
