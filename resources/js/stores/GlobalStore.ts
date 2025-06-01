import { defineStore } from 'pinia'
import { ref } from 'vue';

export const useGlobalStore = defineStore('global', {

    state: () => {
        return {
            showNewRoomSlider: ref(false),
            showContactsList: ref(false),
            showProfileSlider: ref(false),
            newRoomType: ref(''),
            showAddUsers: ref(false),
            showEditProfileSlider: ref(false),
            conversationList: ref([]),
        }
    },
    actions: {
        createRoom(type: string) {
            this.newRoomType = type;
            this.showNewRoomSlider = true;
        },
        findConversation(route: string, type: string) {
            return this.conversationList.find(item => item.route == route && item.type == type) || null;
        }
    },
})
