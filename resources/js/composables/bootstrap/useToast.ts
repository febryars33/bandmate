import { reactive } from 'vue'

export type ToastVariant = 'success' | 'danger' | 'info'

interface Toast {
    id: number
    title: string
    message?: string
    variant: ToastVariant
    duration: number
}

interface ToastOptions {
    title: string
    message?: string
    variant?: ToastVariant
    duration?: number
}

let seq = 0
const toasts = reactive<Toast[]>([])

const remove = (id: number) => {
    const idx = toasts.findIndex((t) => t.id === id)
    if (idx !== -1) toasts.splice(idx, 1)
}

const show = ({ title, message, variant = 'info', duration = 3500 }: ToastOptions) => {
    const id = ++seq
    toasts.push({ id, title, message, variant, duration })
    setTimeout(() => remove(id), duration)
}

// Singleton store — shared across all components
export const useToastStore = () => ({ toasts, show, remove })

// Convenience composable for use in components
export const useToast = () => ({ show })
