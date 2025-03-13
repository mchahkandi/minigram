<script setup>
import { defineEmits, ref } from 'vue';
import Modal from '@/components/Modal.vue';
import { LoaderCircle } from 'lucide-vue-next';
import { useForm } from '@inertiajs/vue3';
import Button from '@/components/Button.vue';
import InputError from '@/components/InputError.vue';

const modalOpen = ref(false);

function openModal() {
    modalOpen.value = true;
}

const form = useForm({
    name: '',
    phone_number: '',
});

const submit = () => {
    form.post(route('contacts.store'), {
        onSuccess: () => {
            form.reset();
            modalOpen.value = false;
        },
    });
};
</script>

<template>
    <div class="border-b border-gray-200 p-4 text-right">
        <button
            @click="openModal"
            type="button"
            class="rounded px-4 py-2 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-200 focus-visible:outline focus-visible:outline-2"
        >
            افزودن
        </button>
    </div>
    <Modal :open="modalOpen" @close="modalOpen = false">
        <div class="p-4">
            <h2 class="mb-4 text-lg font-semibold">افزودن مخاطب</h2>
            <form @submit.prevent="submit" class="flex flex-col gap-6">
                <div class="grid gap-6">
                    <div>
                        <label for="name" class="block text-right text-sm/6 font-medium text-gray-900"> نام</label>
                        <div class="mt-2">
                            <input
                                type="text"
                                v-model="form.name"
                                id="name"
                                autocomplete="name"
                                required="true"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 ring-1 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-1 focus:outline-blue-600 sm:text-sm/6"
                            />
                            <InputError :message="form.errors.name" />
                        </div>
                    </div>

                    <div>
                        <label for="phone" class="block text-right text-sm/6 font-medium text-gray-900"> شماره تلفن</label>
                        <div class="mt-2">
                            <input
                                type="text"
                                v-model="form.phone_number"
                                id="phone"
                                autocomplete="phone"
                                required="true"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 ring-1 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-1 focus:outline-blue-600 sm:text-sm/6"
                            />
                            <InputError :message="form.errors.phone_number" />
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <Button type="submit" class="mt-4 w-full" :tabindex="4" :disabled="form.processing">
                            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                            افزودن
                        </Button>
                        <button class="mt-4 w-full rounded-md bg-gray-200" @click.prevent="modalOpen = false">بازگشت</button>
                    </div>
                </div>
            </form>
        </div>
    </Modal>
</template>

<style scoped></style>
