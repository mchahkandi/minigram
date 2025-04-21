<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { route } from '../../../vendor/tightenco/ziggy';
</script>

<template>
    <Head title="Minigram - پیام‌رسان سریع و امن">

    </Head>

    <div dir="rtl" class="bg-light text-gray-800">
    <!-- نوار ناوبری -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <svg class="h-8 w-8 text-primary" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"/>
                        </svg>
                        <span class="ml-2 text-xl font-bold text-primary">Minigram</span>
                    </div>
                </div>
                <div class="hidden md:ml-6 md:flex md:flex-row-reverse md:items-center md:space-x-8">
                    <a href="#features" class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">امکانات</a>
                    <a href="#security" class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">امنیت</a>
                    <a href="#download" class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">دانلود</a>
                    <a href="#contact" class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">تماس</a>
                </div>
                <div class="flex items-center">
                    <Link :href="route('register')" class="bg-primary text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-opacity-90 transition">شروع کنید</Link>
                </div>
            </div>
        </div>
    </nav>

    <!-- بخش اصلی -->
    <section class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-right">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block">پیام‌رسانی سریع و</span>
                        <span class="block text-primary">امن</span>
                    </h1>
                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        مینی‌گرام با رمزنگاری پیشرفته، پیام‌رسانی سریع و امن را برای شما فراهم می‌کند.
                    </p>
                    <div class="mt-8 sm:max-w-lg sm:mx-auto sm:text-center lg:text-right lg:mx-0">
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <Link :href="route('register')" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-opacity-90 md:py-4 md:text-lg md:px-10">
                                    دانلود کنید
                                </Link>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:mr-3">
                                <Link :href="route('register')" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-white border-primary md:py-4 md:text-lg md:px-10">
                                    نسخه وب
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                    <div class="relative mx-auto w-full rounded-lg shadow-lg lg:max-w-md">
                        <img class="w-full rounded-lg" src="https://via.placeholder.com/600x400/1976D2/ffffff?text=Minigram+App" alt="تصویر اپلیکیشن">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- بخش امکانات -->
    <section id="features" class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-primary font-semibold tracking-wide uppercase">امکانات</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    همه آنچه در یک پیام‌رسان نیاز دارید
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    مینی‌گرام سرعت، امنیت و سادگی را در یک بسته قدرتمند ارائه می‌دهد.
                </p>
            </div>

            <div class="mt-10">
                <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- امکان 1 -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded-md">
                                    <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <div class="mr-5 w-0 flex-1">
                                    <h3 class="text-lg font-medium text-gray-900">رمزنگاری end-to-end</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        پیام‌های شما با استانداردهای نظامی رمزنگاری می‌شوند.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- امکان 2 -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded-md">
                                    <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                                    </svg>
                                </div>
                                <div class="mr-5 w-0 flex-1">
                                    <h3 class="text-lg font-medium text-gray-900">همگام‌سازی ابری</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        از هر دستگاهی به پیام‌های خود دسترسی داشته باشید.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- امکان 3 -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded-md">
                                    <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="mr-5 w-0 flex-1">
                                    <h3 class="text-lg font-medium text-gray-900">پیام‌های خودتخریب</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        پیام‌هایی که پس از خوانده شدن به طور خودکار پاک می‌شوند.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- امکان 4 -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded-md">
                                    <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="mr-5 w-0 flex-1">
                                    <h3 class="text-lg font-medium text-gray-900">تماس تصویری و صوتی</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        تماس‌های با کیفیت با دوستان و خانواده.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- امکان 5 -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded-md">
                                    <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                                    </svg>
                                </div>
                                <div class="mr-5 w-0 flex-1">
                                    <h3 class="text-lg font-medium text-gray-900">کانال‌ها و گروه‌ها</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        ارتباط با هزاران عضو در گروه‌ها و کانال‌ها.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- امکان 6 -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded-md">
                                    <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="mr-5 w-0 flex-1">
                                    <h3 class="text-lg font-medium text-gray-900">چندسکویی</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        در دسترس برای iOS، اندروید، ویندوز، مک و لینوکس.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- بخش امنیت -->
    <section id="security" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
                <div class="mb-8 lg:mb-0">
                    <img class="w-full rounded-lg shadow-xl" src="https://via.placeholder.com/600x400/0D47A1/ffffff?text=امنیت+اولویت+ماست" alt="تصویر امنیت">
                </div>
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                        حریم خصوصی شما اولویت ماست
                    </h2>
                    <p class="mt-3 text-lg text-gray-500">
                        ما به حق شما برای ارتباطات خصوصی اعتقاد داریم. به همین دلیل مینی‌گرام از رمزنگاری end-to-end برای تمام پیام‌ها، تماس‌ها و رسانه‌ها استفاده می‌کند.
                    </p>
                    <div class="mt-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div class="mr-3">
                                <p class="text-base text-gray-700">
                                    <strong>چت‌های مخفی</strong> - پیام‌ها قابل فوروارد نیستند و هیچ ردی روی سرورهای ما باقی نمی‌گذارند
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div class="mr-3">
                                <p class="text-base text-gray-700">
                                    <strong>احراز هویت دو مرحله‌ای</strong> - لایه امنیتی اضافی برای حساب شما
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div class="mr-3">
                                <p class="text-base text-gray-700">
                                    <strong>متن باز</strong> - کد ما شفاف و توسط همه قابل بررسی است
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- بخش دعوت به اقدام -->
    <section class="py-16 bg-primary text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold sm:text-4xl">
                آماده امتحان مینی‌گرام هستید؟
            </h2>
            <p class="mt-4 text-xl opacity-90">
                به بیش از 500 میلیون کاربر در سراسر جهان بپیوندید که برای پیام‌رسانی سریع و امن به مینی‌گرام اعتماد دارند.
            </p>
            <div class="mt-8 flex justify-center">
                <div class="inline-flex rounded-md shadow">
                    <Link :href="route('register')" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-white hover:bg-gray-50">
                        رایگان شروع کنید
                    </Link>
                </div>
            </div>
        </div>
    </section>

    <!-- پاورقی -->
        <footer class="bg-dark">
            <div class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center md:justify-between lg:px-8">
                <div class="flex justify-center flex-row-reverse space-x-6 md:order-2">
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">GitHub</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">YouTube</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                <div class="mt-8 md:order-1 md:mt-0">
                    <p class="text-center text-xs leading-5 text-gray-500">&copy; ۲۰۲۵ مینی‌گرام. تمامی حقوق محفوض است.</p>
                </div>
            </div>
        </footer>
    </div>


</template>
