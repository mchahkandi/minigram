<script setup lang="ts">
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    phone_number: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <AuthBase title="ورود به حساب کاربری" description="شماره و رمزعبور را برای ورود وارد کنید">
        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div>
                    <label for="phone" class="block text-right text-sm/6 font-medium text-gray-900">شماره تلفن</label>
                    <div class="mt-2">
                        <input type="text" v-model="form.phone_number" id="phone" autocomplete="phone_number" required="true" class="ring-1 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-1 focus:outline-blue-600 sm:text-sm/6" />
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-right text-sm/6 font-medium text-gray-900">رمز عبور</label>
                    <div class="mt-2">
                        <input type="password" v-model="form.password" id="password" autocomplete="current-password" required="true" class="ring-1 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-1 focus:outline-blue-600 sm:text-sm/6" />
                    </div>
                </div>

                <div dir="rtl" class="flex items-center justify-start" :tabindex="3">
                    <div class="ml-3 flex h-6 items-center">
                        <input id="remember" v-model="form.remember"  type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                    </div>
                    <div class="min-w-0  text-sm leading-6">
                        <label for="remember" class="select-none font-medium text-gray-900">مرا بخاطر بسپار</label>
                    </div>

                </div>

                <button type="submit" class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />ورود</button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                حساب کاربری ندارید؟
                <Link :href="route('register')" class="underline underline-offset-4" :tabindex="6">ثبت نام</Link>
            </div>
        </form>
    </AuthBase>
</template>
