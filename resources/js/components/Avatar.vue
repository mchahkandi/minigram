<template>
    <div
        class="shrink-0 flex items-center justify-center size-14 rounded-full text-white font-bold text-lg"
        :style="{ backgroundColor: avatarColor }"
    >
        <span v-if="!avatarUrl">{{ initials }}</span>
        <img
            v-if="avatarUrl"
            :src="avatarUrl"
            alt="User Avatar"
            class="w-full h-full rounded-full object-cover"
        />
    </div>
</template>

<script setup>
import { toRefs, computed } from 'vue';
import { defineProps } from 'vue';

const props = defineProps({
    fullName: {
        type: String,
        required: true,
    },
    avatarUrl: {
        type: String,
        default: '',
    },
});

const initials = computed(() => {
    const names = props.fullName.split(' ');
    const firstInitial = names[0] ? names[0].charAt(0) : '';
    const lastInitial = names[1] ? names[1].charAt(0) : '';
    return `${firstInitial}${lastInitial}`.toUpperCase();
});

const avatarColor = computed(() => getColorFromInitials(initials.value));

function getColorFromInitials(initials) {
    const colors = ['#008CD8', '#E47438', '#D8528C', '#DD4342', '#A172E3'];
    if (initials.length === 0) {
        return colors[0];
    }
    const index = initials.charCodeAt(0) % colors.length;
    return colors[index];
}
</script>
