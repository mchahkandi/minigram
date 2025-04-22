<script setup lang="ts">
import SliderContainer from '@/components/SliderContainer.vue';
import Button from '@/components/Button.vue';
import { X, Info, Phone, AtSign, LogOut, Pencil } from 'lucide-vue-next';
import { DialogTitle } from '@headlessui/vue';
import { useGlobalStore } from '@/stores/GlobalStore';
import { router, usePage } from '@inertiajs/vue3';
import Avatar from '@/components/Avatar.vue';
import Modal from '@/components/Modal.vue';
import { ref } from 'vue';

const store = useGlobalStore();

const page = usePage();

const user = page.props.auth.user;

const logoutModalOpen = ref(false);

const handleClose = () => {
    store.showProfileSlider = false;
};

function logOut () {
    router.post(route('logout'), {
        onSuccess: () => logoutModalOpen.value = false,
    })
}

</script>

<template>
    <SliderContainer :open="store.showProfileSlider">
        <div class="p-6">
            <div class="flex flex-row-reverse items-start justify-between">
                <div class="flex flex-row-reverse items-center gap-x-4">
                    <button @click.prevent="logoutModalOpen = true" type="button" class="rounded-md bg-white text-red-400 hover:text-red-500">
                        <LogOut class="size-6"/>
                    </button>
                    <button type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-blue-500">
                        <Pencil class="size-6"/>
                    </button>
                    <DialogTitle class="mr-4 text-base font-semibold leading-6 text-gray-900">پروفایل</DialogTitle>
                </div>

                <div class="ml-3 flex h-7 items-center">
                    <button type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-blue-500" @click="handleClose">
                        <X class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>
            </div>
        </div>

        <div class="px-6 pb-6 text-right space-y-2">
            <div class="flex flex-col items-center mb-6">
                <div class="relative">
                    <Avatar class="size-32 text-3xl border-4 border-white shadow-lg" :full-name="user.name" :avatar-url="user.avatar" />
                </div>
                <div class="mt-4 text-center">
                    <h2 class="text-xl font-bold text-gray-900">{{ user.name }}</h2>
                    <span class="inline-block mt-1 px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                        آنلاین
                    </span>
                </div>
            </div>


            <div class="p-4 flex items-center gap-4 p-4 hover:bg-gray-50 rounded-lg transition-colors">
                <div class="p-2  rounded-full text-gray-600">
                    <Info class="h-5 w-5" />
                </div>
                <div class="flex-1">
                    <h2 dir="ltr" class="text-gray-900 font-medium text-sm">{{user.bio || 'بیوگرافی ثبت نشده است'}}</h2>
                    <p class="text-gray-500 text-xs mt-1"> درباره </p>
                </div>
            </div>

            <div class="flex items-center gap-4 p-4 hover:bg-gray-50 rounded-lg transition-colors">
                <div class="p-2  rounded-full text-gray-600">
                    <Phone class="h-5 w-5" />
                </div>
                <div class="flex-1">
                    <h2 dir="ltr" class="text-gray-900 font-medium text-sm">{{user.phone_number}}</h2>
                    <p class="text-gray-500 text-xs mt-1">شماره تلفن</p>
                </div>
            </div>

            <div class="flex items-center gap-4 p-4 hover:bg-gray-50 rounded-lg transition-colors">
                <div class="p-2  rounded-full text-gray-600">
                    <AtSign class="h-5 w-5" />
                </div>
                <div class="flex-1">
                    <h2 dir="ltr" class="text-gray-900 font-medium text-sm">{{user.username || 'شناسه ثبت نشده'}}</h2>
                    <p class="text-gray-500 text-xs mt-1"> شناسه </p>
                </div>
            </div>

        </div>
        <Modal :open="logoutModalOpen" @close="logoutModalOpen = false">
            <div class="p-4">
                <h2 class="mb-4 text-lg font-semibold"> خروج از حساب کاربری </h2>
                <div class="grid gap-6">
                    <p>آیا برای خارج شدن مطمئن هستید؟</p>
                    <div class="flex gap-2">
                        <Button @click.prevent="logOut" class="mt-4 w-full bg-red-500 hover:bg-red-600" :tabindex="4" >
                            خروج
                        </Button>
                        <button class="mt-4 w-full rounded-md bg-gray-200" @click.prevent="logoutModalOpen = false">بازگشت</button>
                    </div>
                </div>
            </div>
        </Modal>
    </SliderContainer>
</template>

<style scoped>
/* استایل‌های سفارشی */
.text-right {
    direction: rtl;
}
</style>
