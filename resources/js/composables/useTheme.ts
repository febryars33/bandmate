import Theme from '@/theme'
import { onMounted, ref } from 'vue'

export type ThemeMode = 'light' | 'dark'

export function useTheme() {
    const mode = ref<ThemeMode>('light')

    const toggle = () => {
        mode.value = mode.value === 'dark' ? 'light' : 'dark'
        Theme.apply(mode.value)
    }

    onMounted(() => {
        mode.value = Theme.init() as ThemeMode
    })

    return { mode, toggle }
}
