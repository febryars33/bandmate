<template>
    <Teleport to="body">
        <div class="toast-stack" aria-live="polite" aria-atomic="false">
            <TransitionGroup name="toast">
                <div v-for="t in toasts" :key="t.id" class="app-toast" :class="`toast--${t.variant}`" role="alert">
                    <div class="toast-icon">
                        <svg v-if="t.variant === 'success'" viewBox="0 0 20 20" fill="currentColor" width="18" height="18">
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <svg v-else-if="t.variant === 'danger'" viewBox="0 0 20 20" fill="currentColor" width="18" height="18">
                            <path
                                fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <svg v-else viewBox="0 0 20 20" fill="currentColor" width="18" height="18">
                            <path
                                fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                    <div class="toast-body">
                        <p class="toast-title">{{ t.title }}</p>
                        <p v-if="t.message" class="toast-message">{{ t.message }}</p>
                    </div>
                    <button class="toast-close" @click="remove(t.id)" aria-label="Tutup">
                        <svg viewBox="0 0 16 16" fill="currentColor" width="14" height="14">
                            <path
                                d="M3.72 3.72a.75.75 0 011.06 0L8 6.94l3.22-3.22a.75.75 0 111.06 1.06L9.06 8l3.22 3.22a.75.75 0 11-1.06 1.06L8 9.06l-3.22 3.22a.75.75 0 01-1.06-1.06L6.94 8 3.72 4.78a.75.75 0 010-1.06z"
                            />
                        </svg>
                    </button>
                    <div class="toast-progress" :style="{ animationDuration: `${t.duration}ms` }" />
                </div>
            </TransitionGroup>
        </div>
    </Teleport>
</template>

<script lang="ts" setup>
import { useToastStore } from '@/composables/bootstrap/useToast'

const { toasts, remove } = useToastStore()
</script>

<style scoped>
.toast-stack {
    position: fixed;
    bottom: 1.5rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column-reverse;
    gap: 0.5rem;
    z-index: 9999;
    pointer-events: none;
    width: max-content;
    max-width: calc(100vw - 2rem);
}

.app-toast {
    pointer-events: auto;
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 0.875rem 1rem 0.875rem 1rem;
    border-radius: 12px;
    min-width: 280px;
    max-width: 360px;
    position: relative;
    overflow: hidden;
    box-shadow:
        0 4px 24px rgba(0, 0, 0, 0.12),
        0 1px 4px rgba(0, 0, 0, 0.08);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    background: var(--bs-body-bg);
    border: 1px solid rgba(var(--bs-body-color-rgb), 0.08);
}

.toast--success .toast-icon {
    color: #22c55e;
}
.toast--danger .toast-icon {
    color: #ef4444;
}
.toast--info .toast-icon {
    color: #3b82f6;
}

.toast-icon {
    flex-shrink: 0;
    margin-top: 1px;
}

.toast-body {
    flex: 1;
    min-width: 0;
}

.toast-title {
    margin: 0;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--bs-body-color);
    line-height: 1.4;
}

.toast-message {
    margin: 0.125rem 0 0;
    font-size: 0.8125rem;
    color: var(--bs-secondary-color);
    line-height: 1.4;
}

.toast-close {
    flex-shrink: 0;
    background: none;
    border: none;
    color: var(--bs-secondary-color);
    cursor: pointer;
    padding: 0;
    line-height: 1;
    opacity: 0.6;
    transition: opacity 0.15s;
    margin-top: 1px;
}

.toast-close:hover {
    opacity: 1;
}

/* Progress bar */
.toast-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 2.5px;
    width: 100%;
    border-radius: 0 0 12px 12px;
    transform-origin: left;
    animation: shrink linear forwards;
}

.toast--success .toast-progress {
    background: #22c55e;
}
.toast--danger .toast-progress {
    background: #ef4444;
}
.toast--info .toast-progress {
    background: #3b82f6;
}

@keyframes shrink {
    from {
        transform: scaleX(1);
    }
    to {
        transform: scaleX(0);
    }
}

/* Transition */
.toast-enter-active {
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.toast-leave-active {
    transition: all 0.2s ease-in;
}
.toast-enter-from {
    opacity: 0;
    transform: translateY(12px) scale(0.96);
}
.toast-leave-to {
    opacity: 0;
    transform: translateY(4px) scale(0.96);
}
</style>
