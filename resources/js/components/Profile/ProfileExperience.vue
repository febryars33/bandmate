<template>
    <div class="profile-card profile-animate mb-4 exp-card">
        <p class="section-label">Pengalaman</p>

        <div v-if="experiences.length" class="exp-list">
            <div v-for="(exp, i) in experiences" :key="exp.id" class="exp-item" :class="{ 'exp-item--last': i === experiences.length - 1 }">
                <!-- Timeline dot + line -->
                <div class="exp-timeline">
                    <span class="timeline-dot" />
                </div>

                <!-- Content -->
                <div class="exp-content">
                    <div class="exp-top">
                        <div>
                            <h6 class="exp-band">{{ exp.band_name }}</h6>
                            <span class="exp-role">
                                {{ exp.role }}
                                <span class="exp-sep">·</span>
                                {{ exp.start_year }} – {{ exp.end_year ?? 'Sekarang' }}
                            </span>
                        </div>
                        <span v-if="!exp.end_year" class="exp-current">Aktif</span>
                    </div>
                    <p v-if="exp.description" class="exp-desc">{{ exp.description }}</p>
                </div>
            </div>
        </div>

        <div v-else class="exp-empty">
            <svg viewBox="0 0 16 16" fill="currentColor" width="18" height="18" class="empty-icon">
                <path
                    fill-rule="evenodd"
                    d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM0 8a8 8 0 1116 0A8 8 0 010 8zm9 3a1 1 0 11-2 0 1 1 0 012 0zm-.25-6.25a.75.75 0 00-1.5 0v3.5a.75.75 0 001.5 0v-3.5z"
                    clip-rule="evenodd"
                />
            </svg>
            Belum ada pengalaman yang ditambahkan.
        </div>
    </div>
</template>

<script lang="ts" setup>
import type { Experience } from '@/types/profile'

defineProps<{ experiences: Experience[] }>()
</script>

<style scoped>
.exp-card {
    padding: 1.5rem;
}

.exp-list {
    display: flex;
    flex-direction: column;
    gap: 0;
}

/* --- Timeline item --- */
.exp-item {
    display: flex;
    gap: 1rem;
    padding-bottom: 1.375rem;
}

.exp-item--last {
    padding-bottom: 0;
}

/* --- Timeline track --- */
.exp-timeline {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex-shrink: 0;
    width: 18px;
    padding-top: 4px;
    position: relative;
}

.timeline-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: var(--bs-primary);
    box-shadow: 0 0 0 3px rgba(var(--bs-primary-rgb), 0.15);
    flex-shrink: 0;
    z-index: 1;
}

.exp-timeline::after {
    content: '';
    position: absolute;
    top: 18px;
    left: 50%;
    transform: translateX(-50%);
    width: 1.5px;
    bottom: -18px;
    background: rgba(var(--bs-body-color-rgb), 0.1);
}

.exp-item--last .exp-timeline::after {
    display: none;
}

/* --- Content --- */
.exp-content {
    flex: 1;
    min-width: 0;
    padding-bottom: 0.25rem;
}

.exp-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 0.5rem;
    margin-bottom: 0.375rem;
}

.exp-band {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--bs-body-color);
    margin: 0 0 0.2rem;
    letter-spacing: -0.01em;
}

.exp-role {
    font-size: 0.8rem;
    color: var(--bs-secondary-color);
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.25rem;
}

.exp-sep {
    opacity: 0.5;
}

.exp-current {
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    color: #16a34a;
    background: rgba(34, 197, 94, 0.1);
    border: 1px solid rgba(34, 197, 94, 0.2);
    padding: 0.15rem 0.5rem;
    border-radius: 999px;
    white-space: nowrap;
    flex-shrink: 0;
}

.exp-desc {
    font-size: 0.85rem;
    color: var(--bs-secondary-color);
    margin: 0;
    line-height: 1.6;
}

/* --- Empty state --- */
.exp-empty {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    color: var(--bs-secondary-color);
}

.empty-icon {
    color: var(--bs-secondary-color);
    opacity: 0.5;
    flex-shrink: 0;
}
</style>
