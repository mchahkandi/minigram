<script setup lang="ts">
import { DialogTitle, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { EllipsisVerticalIcon, X, Check, UserPlus } from 'lucide-vue-next';
import SliderContainer from '@/components/SliderContainer.vue';
import Create from '@/pages/contacts/Create.vue';
import { useGlobalStore } from '@/stores/GlobalStore';
import { onMounted, ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import axios from 'axios';
import Button from '@/components/Button.vue';
import Avatar from '@/components/Avatar.vue';

const store = useGlobalStore()
const contacts = ref({});
const selectedContacts = ref([]);
const isSelectMode = ref(false);

const fetchContacts = () => {
    axios.get(route('contacts.index')).then((res) => {
        contacts.value = Object.values(res.data);
    })
}

const toggleContactSelection = (contactId: number) => {
    const index = selectedContacts.value.indexOf(contactId);
    if (index === -1) {
        selectedContacts.value.push(contactId);
    } else {
        selectedContacts.value.splice(index, 1);
    }
}

const toggleSelectMode = () => {
    isSelectMode.value = !isSelectMode.value;
    if (!isSelectMode.value) {
        selectedContacts.value = [];
    }
}

const deleteContacts = () => {

    for (const [key, value] of Object.entries(selectedContacts.value)) {
        axios.delete(route('contacts.destroy', value))
            .then(response => {
                contacts.value.splice(key);

                isSelectMode.value = false;
                selectedContacts.value = [];

            })
            .catch(error => {
                console.log(error);
            });
    }
}

onMounted(() => {
    fetchContacts();
})
</script>

<template>
    <SliderContainer :open="store.showContactsList">
        <div class="p-6">
            <div class="flex flex-row-reverse items-start justify-between">
                <DialogTitle class="text-base font-semibold leading-6 text-gray-900">
                    مخاطبین
                    <span v-if="isSelectMode" class="text-sm text-gray-500"> ({{ selectedContacts.length }} انتخاب شده) </span>
                </DialogTitle>
                <div class="flex items-center gap-2">
                    <button
                        type="button"
                        class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-blue-500"
                        @click="store.showContactsList = false"
                    >
                        <span class="sr-only">Close panel</span>
                        <X class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>
            </div>
        </div>
        <div class="flex w-full flex-row-reverse justify-between px-4">
            <button v-if="!isSelectMode" @click="toggleSelectMode" class="rounded-md p-2 text-blue-600 hover:bg-blue-50" title="Select contacts">
                ویرایش
            </button>

            <button v-if="isSelectMode" @click="toggleSelectMode" class="rounded-md p-2 text-gray-500 hover:bg-gray-100" title="Cancel selection">
                لغو
            </button>

            <button
                v-if="isSelectMode"
                @click.prevent="deleteContacts"
                :disabled="selectedContacts.length === 0"
                class="rounded-md p-2 text-blue-600 hover:bg-blue-50 disabled:cursor-not-allowed disabled:opacity-50"
            >
                حذف انتخاب شده‌ها
            </button>
        </div>

        <ul role="list" class="mx-2 flex-1 overflow-y-auto">
            <li v-for="person in contacts" :key="person.id">
                <div
                    class="group flex w-full items-center justify-between gap-x-3 rounded-md p-4 text-sm font-semibold leading-6 hover:bg-gray-50 cursor-pointer"
                    :class="{
                        'bg-blue-50': selectedContacts.includes(person.id),
                    }"
                    @click="isSelectMode ? toggleContactSelection(person.id) : router.get(route('chats.show',{id: person.contact_id}))"
                >
                    <div class="flex items-center gap-x-3">
                        <Avatar :fullName="person.name" :avatarUrl="person.avatar" />

                        <div class="flex flex-col justify-between">
                            <h2 class="text-base font-bold text-gray-900">{{ person.name }}</h2>
                            <p class="truncate p-1 text-gray-500">{{ person.user.last_seen }}</p>
                        </div>
                    </div>

                    <div v-if="isSelectMode" class="flex-shrink-0">
                        <div
                            class="flex h-5 w-5 items-center justify-center rounded border border-gray-300"
                            :class="{
                                'border-blue-600 bg-blue-600': selectedContacts.includes(person.id),
                            }"
                        >
                            <Check v-if="selectedContacts.includes(person.id)" class="h-4 w-4 text-white" />
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <Create />
    </SliderContainer>
</template>

<style scoped>
/* Add any custom styles here */
</style>
