import { defineStore } from 'pinia'
import { ref } from 'vue';

export const useGlobalStore = defineStore('global', {

    state: () => {
        return {
            showNewRoomSlider: ref(false),
            showContactsList: ref(false),

        }
    },
})
