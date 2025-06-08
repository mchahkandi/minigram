<template>
    <div>
        <!-- Static sidebar for desktop -->
        <div v-if="!isMobile || isDashboard" class=" md:fixed md:inset-y-0 md:z-30 md:flex md:w-80 md:flex-col lg:w-96">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6">
                <div class="flex h-16 shrink-0 items-center gap-2">
                    <div>
                        <button @click.prevent="store.showProfileSlider = true" class="inline-flex size-12 justify-center items-center gap-x-1.5 rounded-full text-sm font-semibold text-gray-900 hover:bg-gray-50">
                            <MenuIcon class="size-5 text-gray-800" aria-hidden="true" />
                        </button>
                    </div>
                    <p>minigram</p>
                </div>
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 overflow-hidden">
                                <li v-for="item in sortedConversations" :key="item.title">
                                    <Link
                                        :href="route(item.type == 'chat' ? 'chats.show' : 'rooms.show',{id: item.route})"
                                        :class="[
                                            isCurrentConversation(item) ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-gray-50',
                                            'group flex gap-x-3 rounded-md p-4 text-sm font-semibold leading-6',
                                        ]"
                                    >
                                        <Avatar :fullName="item.title" :avatarUrl="item.avatar"/>
                                        <div class="flex flex-col justify-between w-full">
                                            <h2 :class="[isCurrentConversation(item) ? 'text-white' : 'text-gray-900', 'text-base font-bold flex justify-between']">{{ item.title }}
                                            <span :class="[isCurrentConversation(item) ? 'text-white' : 'text-gray-500', 'text-xs font-thin']">{{ formatPersianDate(item.last_update) }}</span>
                                            </h2>
                                            <p :class="[isCurrentConversation(item) ? 'text-white' : 'text-gray-500','p-1 text-gray-500 font-normal truncate']">{{ shorten(item.last_message,28) }}</p>
                                        </div>
                                        <span
                                            v-if="item.unread_messages > 0"
                                            class="text-xs size-6 text-center font-medium text-white bg-green-500 rounded-full p-1 ml-auto self-center"
                                        >
                                            {{ item.unread_messages > 9 ? '9+' : item.unread_messages }}
                                        </span>
                                    </Link>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <NewChatBtn />
            </div>
        </div>

        <CreateRoom/>
        <ContactList/>
        <Profile/>
        <EditProfile/>
        <AddUsers/>
        <main :class="[isMobile && isDashboard ? 'hidden' : '']" class=" md:flex md:pl-80 lg:pl-96">
            <slot />
        </main>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import NewChatBtn from '@/components/NewChatBtn.vue';
import { usePage } from '@inertiajs/vue3';
import CreateRoom from '@/components/CreateRoom.vue';
import ContactList from '@/components/ContactList.vue';
import Avatar from '@/components/Avatar.vue';
import { useConversationStore } from '@/stores/ConversationStore';
import { MenuIcon, } from 'lucide-vue-next';
import { useGlobalStore } from '@/stores/GlobalStore.js';
import Profile from '@/components/Profile.vue';
import AddUsers from '@/components/AddUsers.vue';
import EditProfile from '@/components/EditProfile.vue';
import { shorten } from '../../utils';
import { onMounted, onUnmounted, ref } from 'vue';
import moment from 'moment-jalaali';
import { computed } from 'vue';

const store = useGlobalStore()

const page = usePage();

store.conversationList = page.props.conversations.data;

const conversation = useConversationStore();

const sortedConversations = computed(() => {
    return [...store.conversationList].sort((a, b) => new Date(b.last_update).getTime() - new Date(a.last_update).getTime());
});

const isCurrentConversation = (item) => {
    return !isDashboard && conversation.model.id === item.route &&
        conversation.type == (item.type == 'chat' ? 'chat' : 'room');
};

const isMobile = ref(false);
const isDashboard =  route().current() == 'dashboard';


onMounted(() => {
    isMobile.value = window.innerWidth < 768;

    window.addEventListener('resize', () => {
        isMobile.value = window.innerWidth < 768;
    });
});

function formatPersianDate(dateStr: string): string {
    const inputDate = new Date(dateStr);
    const now = new Date();
    const oneWeekAgo = new Date();
    oneWeekAgo.setDate(now.getDate() - 7);

    const weekdaysFa = ['یک‌شنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه', 'شنبه'];

    if (inputDate >= oneWeekAgo && inputDate <= now) {
        return weekdaysFa[inputDate.getDay()];
    } else {
        const m = moment(inputDate);
        m.locale('fa');
        return m.format('jD jMMMM');
    }
}

const user = page.props.auth.user;

onMounted(() => {
    Echo.private(`users.${user?.id}`)
        .stopListening("ChatMessageSent")
        .listen("ChatMessageSent", (response) => {
            const sender = response.message.messagable.user_one_id == response.message.user_id
                ? response.message.messagable.user_one
                : response.message.messagable.user_two

            const receiver = response.message.messagable.user_one_id == response.message.user_id
                ? response.message.messagable.user_two
                : response.message.messagable.user_one

            const isCurrentUser = user?.id == sender?.id;

            const item = store.findConversation(isCurrentUser ? receiver.id : sender.id, 'chat');
            if (item) {
                if (user?.id !== response.message.user_id) {
                    item.unread_messages += 1;
                }
                item.last_message = response.message.content;
                item.last_update = response.message.created_at;
            }else {

                const newConversation = {
                    title: sender.name,
                    avatar: sender.avatar,
                    unread_messages: 1,
                    last_message: response.message.content,
                    last_update: response.message.created_at,
                    type: 'chat',
                    route: sender.id,
                };

                store.conversationList.push(newConversation);
            }
        });

    Echo.private(`users.${user?.id}`)
        .stopListening("RoomMessageSent")
        .listen("RoomMessageSent", (response) => {
            console.log(response);
            const item = store.findConversation(response.message.messagable.id, 'room');
            if (item) {
                if (user?.id !== response.message.user_id) {
                    item.unread_messages += 1;
                }
                item.last_message = response.message.content;
                item.last_update = response.message.created_at;
            }else {
                const room = response.message.messagable;

                const newConversation = {
                    title: room.name,
                    avatar: room.avatar,
                    unread_messages: 1,
                    last_message: response.message.content,
                    last_update: response.message.created_at,
                    type: 'room',
                    route: room.id,
                };

                store.conversationList.push(newConversation);
            }
        });

});

onUnmounted( () => {
    Echo.private(`users.${user?.id}`)
        .stopListening("ChatMessageSent");

    Echo.private(`users.${user?.id}`)
        .stopListening("RoomMessageSent");
})



</script>
