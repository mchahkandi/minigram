import { defineStore } from 'pinia'
import { ref } from 'vue';

export const useGlobalStore = defineStore('global', {

    state: () => {
        return {
            showNewRoomSlider: ref(false),
            showContactsList: ref(false),
            showProfileSlider: ref(false),
            newRoomType: ref(''),

        }
    },
    actions: {
        createRoom(type: string) {
            this.newRoomType = type;
            this.showNewRoomSlider = true;
        }
    }
})
