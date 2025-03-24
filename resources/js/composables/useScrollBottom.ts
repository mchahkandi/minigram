// useScrollBottom.ts
import { Ref } from 'vue';

export function useScrollBottom(containerRef: Ref<HTMLElement | null>) {
    const scrollToBottom = () => {
        if (containerRef.value) {
            containerRef.value.scrollTo({
                top: containerRef.value.scrollHeight,
                behavior: 'smooth'
            });
        }
    };

    return {
        scrollToBottom,
    };
}
