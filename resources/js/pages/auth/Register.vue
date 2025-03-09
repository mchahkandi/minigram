<script setup lang="ts">
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3';
const form = useForm({
    name: '',
    phone_number: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthBase title="ساخت حساب کاربری" description="برای ایجاد حساب اطلاعات را وارد نمایید">
        <Head title="Register" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div>
                <label for="name" class="block text-right text-sm/6 font-medium text-gray-900">نام</label>
                <div class="mt-2">
                    <input type="text" v-model="form.name" id="name" autocomplete="email" required="true" class="ring-1 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-1 focus:outline-blue-600 sm:text-sm/6" />
                </div>
            </div>

            <div>
                <label for="phone_number" class="block text-right text-sm/6 font-medium text-gray-900">شماره تلفن</label>
                <div class="mt-2">
                    <input type="text" v-model="form.phone_number" id="email" autocomplete="phone_number" required="true" class="ring-1 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-1 focus:outline-blue-600 sm:text-sm/6" />
                </div>
            </div>

            <div>
                <label for="password" class="block text-right text-sm/6 font-medium text-gray-900">رمز عبور</label>
                <div class="mt-2">
                    <input type="password" v-model="form.password" id="password" autocomplete="current-password" required="true" class="ring-1 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-1 focus:outline-blue-600 sm:text-sm/6" />
                </div>
            </div>

            <div>
                <label for="password_confirmation" class="block text-right text-sm/6 font-medium text-gray-900"> تکرار رمز عبور</label>
                <div class="mt-2">
                    <input type="password" v-model="form.password_confirmation" id="password_confirmation" required="true" class="ring-1 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-1 focus:outline-blue-600 sm:text-sm/6" />
                </div>
            </div>

            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Sign in</button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                Already have an account?
                <Link :href="route('login')" class="underline underline-offset-4" :tabindex="6">Log in</Link>
            </div>
        </form>
    </AuthBase>
</template>
