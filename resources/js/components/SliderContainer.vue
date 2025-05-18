<script setup lang="ts">

import { ref } from 'vue';
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild, TransitionRoot
} from '@headlessui/vue';
import { X } from 'lucide-vue-next';

const props = defineProps<{
    open : boolean
}>();
</script>

<template>
    <TransitionRoot as="template" :show="props.open">
        <Dialog as="div" class="relative z-40 w-screen">
            <div class="fixed inset-0" />

            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="pointer-events-none fixed inset-y-0 left-0 flex md:max-w-80 max-w-screen lg:max-w-96">
                        <TransitionChild as="template" enter="transform transition ease-in-out duration-500 sm:duration-700" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-x-0" leave-to="-translate-x-full">
                            <DialogPanel class="pointer-events-auto w-screen md:max-w-md">
                                <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                                    <slot/>

                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>

</template>
