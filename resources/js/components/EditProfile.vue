<script setup lang="ts">
import SliderContainer from '@/components/SliderContainer.vue';
import Button from '@/components/Button.vue';
import { X, Info, Phone, AtSign, Save, Users } from 'lucide-vue-next';
import { DialogTitle } from '@headlessui/vue';
import { useGlobalStore } from '@/stores/GlobalStore';
import { router, usePage } from '@inertiajs/vue3';
import Avatar from '@/components/Avatar.vue';
import { ref } from 'vue';
import InputError from '@/components/InputError.vue';
import { useForm } from '@inertiajs/vue3';


const store = useGlobalStore();
const page = usePage();
const user = page.props.auth.user;

const form = useForm({
    name: user.name,
    bio: user.bio,
    username: user.username,
    avatar: null as File | null
});

const avatarPreview = ref(user.avatar);
const isLoading = ref(false);
const fileInput = ref<HTMLInputElement | null>(null);  // Add this ref


const handleClose = () => {
    store.showEditProfileSlider = false;
};

function handleAvatarChange(e: Event) {
    const input = e.target as HTMLInputElement;
    if (input.files && input.files[0]) {
        const file = input.files[0];
        // Use form.data to properly update the avatar property
        form.avatar = file;

        const reader = new FileReader();
        reader.onload = (event) => {
            avatarPreview.value = event.target?.result as string;
        };
        reader.readAsDataURL(file);
    }
}

function submit() {
    form.post(route('profile.update'), {
        forceFormData: true,
        onSuccess: () => {
            form.reset();
            handleClose();
        },
    });
}
</script>

<template>
    <SliderContainer :open="store.showEditProfileSlider">
        <div class="p-6">
            <div class="flex flex-row-reverse items-start justify-between">
                <div class="flex flex-row-reverse items-center gap-x-4">

                    <DialogTitle class="mr-4 text-base font-semibold leading-6 text-gray-900">ویرایش پروفایل</DialogTitle>
                </div>

                <div class="ml-3 flex h-7 items-center">
                    <button
                        type="button"
                        class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-blue-500"
                        @click="handleClose"
                    >
                        <X class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>
            </div>
        </div>

        <div class="px-6 pb-6 text-right space-y-4 z-50">
            <form @submit.prevent="submit">
            <div class="flex flex-col items-center mb-6">
                <div class="relative group">
                    <Avatar
                        class="size-32 text-3xl border-4 border-white shadow-lg cursor-pointer group-hover:opacity-80 transition-opacity"
                        :full-name="form.name"
                        :avatar-url="avatarPreview"
                    />
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <label
                            for="file"
                            class="cursor-pointer flex items-start justify-end gap-2 px-4 py-4 text-right text-sm"
                            @click="$refs.fileInput.click()"
                        >
                            ویرایش عکس
                        </label>
                        <input
                            id="file"
                            type="file"
                            @change="handleAvatarChange"
                            class="hidden"
                            ref="fileInput"
                        />

                    </div>

                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">نام کامل</label>
                <input
                    v-model="form.name"
                    type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                />
                <InputError :message="form.errors.name" />
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">بیوگرافی</label>
                <textarea
                    v-model="form.bio"
                    rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="درباره خود بنویسید..."
                ></textarea>
                <InputError :message="form.errors.bio" />
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">شناسه کاربری</label>
                <input
                    v-model="form.username"
                    type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                />
            </div>
            <Button
                type="submit"
                @click="submit"
                :disabled="isLoading"
                class="flex items-center gap-2 mt-4"
            >
                <Save class="size-5" />
                ذخیره تغییرات
            </Button>
            </form>
        </div>
    </SliderContainer>
</template>

<style scoped>
.text-right {
    direction: rtl;
}
</style>
