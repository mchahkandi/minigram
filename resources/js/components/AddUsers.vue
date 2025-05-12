<script setup lang="ts">
import { DialogTitle } from '@headlessui/vue';
import { X, Check } from 'lucide-vue-next';
import SliderContainer from '@/components/SliderContainer.vue';
import { useGlobalStore } from '@/stores/GlobalStore';
import { useConversationStore } from '@/stores/ConversationStore';

import { onMounted, ref } from 'vue';
import axios from 'axios';
import Avatar from '@/components/Avatar.vue';

const store = useGlobalStore();
const conversation = useConversationStore();
const contacts = ref({});
const selectedContacts = ref([]);

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

const AddUsers = () => {

        axios.post(route('rooms.addusers', conversation.model.id),{members: selectedContacts.value})
            .then(response => {

                selectedContacts.value = [];
                store.showAddUsers = false;

            })
            .catch(error => {
                console.log(error);
            });

}

onMounted(() => {
    fetchContacts();
})
</script>

<template>
    <SliderContainer :open="store.showAddUsers">
        <div class="p-6">
            <div class="flex flex-row-reverse items-start justify-between">
                <DialogTitle class="text-base font-semibold leading-6 text-gray-900">
                    مخاطبین
                    <span class="text-sm text-gray-500"> ({{ selectedContacts.length }} انتخاب شده) </span>
                </DialogTitle>
                <div class="flex items-center gap-2">
                    <button
                        type="button"
                        class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-blue-500"
                        @click="store.showAddUsers = false"
                    >
                        <span class="sr-only">Close panel</span>
                        <X class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>
            </div>
        </div>

        <ul role="list" class="mx-2 flex-1 overflow-y-auto">
            <li v-for="person in contacts" :key="person.id">
                <div
                    class="group flex w-full items-center justify-between gap-x-3 rounded-md p-4 text-sm font-semibold leading-6 hover:bg-gray-50 cursor-pointer"
                    :class="{
                        'bg-blue-50': selectedContacts.includes(person.contact_id),
                    }"
                    @click="toggleContactSelection(person.contact_id)"
                >
                    <div class="flex items-center gap-x-3">
                        <Avatar :fullName="person.name" :avatarUrl="person.avatar" />

                        <div class="flex flex-col justify-between">
                            <h2 class="text-base font-bold text-gray-900">{{ person.name }}</h2>
                            <p class="truncate p-1 text-gray-500">{{ person.user.last_seen }}</p>
                        </div>
                    </div>

                    <div class="flex-shrink-0">
                        <div
                            class="flex h-5 w-5 items-center justify-center rounded border border-gray-300"
                            :class="{
                                'border-blue-600 bg-blue-600': selectedContacts.includes(person.contact_id),
                            }"
                        >
                            <Check v-if="selectedContacts.includes(person.contact_id)" class="h-4 w-4 text-white" />
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="border-b border-gray-200 p-4 text-right">
            <button
                type="button"
                @click.prevent="AddUsers"
                class="rounded px-4 py-2 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-200 focus-visible:outline focus-visible:outline-2"
            >
                افزودن
            </button>
        </div>
    </SliderContainer>
</template>

<style scoped>
/* Add any custom styles here */
</style>
