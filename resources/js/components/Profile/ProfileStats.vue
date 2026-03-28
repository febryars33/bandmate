<template>
    <div class="profile-card profile-animate stats-grid mb-4">
        <div v-for="stat in stats" :key="stat.label" class="stat-item">
            <span class="stat-icon" :style="{ background: stat.bg }">
                <svg viewBox="0 0 16 16" fill="currentColor" width="14" height="14" :style="{ color: stat.color }">
                    <path :d="stat.icon" />
                </svg>
            </span>
            <span class="stat-value">{{ stat.value }}</span>
            <span class="stat-label">{{ stat.label }}</span>
        </div>
    </div>
</template>

<script lang="ts" setup>
import type { Profile } from '@/types/profile'
import { computed } from 'vue'

const props = defineProps<{ profile: Profile }>()

const stats = computed(() => [
    {
        label: 'Connections',
        value: props.profile.connections_count,
        icon: 'M8 9.5a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm-4.5-3a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm9 0a1.5 1.5 0 100-3 1.5 1.5 0 000 3zM1 13.25a3.25 3.25 0 016.5 0 .75.75 0 01-1.5 0 1.75 1.75 0 00-3.5 0 .75.75 0 01-1.5 0zm7.25 0a3.25 3.25 0 016.5 0 .75.75 0 01-1.5 0 1.75 1.75 0 00-3.5 0 .75.75 0 01-1.5 0z',
        color: '#3b82f6',
        bg: 'rgba(59,130,246,0.1)',
    },
    {
        label: 'Projects',
        value: props.profile.projects_count,
        icon: 'M1.75 0A1.75 1.75 0 000 1.75v12.5C0 15.216.784 16 1.75 16h12.5A1.75 1.75 0 0016 14.25V1.75A1.75 1.75 0 0014.25 0H1.75zM1.5 1.75a.25.25 0 01.25-.25h12.5a.25.25 0 01.25.25v12.5a.25.25 0 01-.25.25H1.75a.25.25 0 01-.25-.25V1.75zM8 4a.75.75 0 01.75.75v2.5h2.5a.75.75 0 010 1.5h-2.5v2.5a.75.75 0 01-1.5 0v-2.5h-2.5a.75.75 0 010-1.5h2.5v-2.5A.75.75 0 018 4z',
        color: '#22c55e',
        bg: 'rgba(34,197,94,0.1)',
    },
    {
        label: 'Experiences',
        value: props.profile.experiences.length,
        icon: 'M3.75 2A1.75 1.75 0 002 3.75v8.5C2 13.216 2.784 14 3.75 14h8.5A1.75 1.75 0 0014 12.25v-8.5A1.75 1.75 0 0012.25 2h-8.5zM3.5 3.75a.25.25 0 01.25-.25h8.5a.25.25 0 01.25.25v8.5a.25.25 0 01-.25.25h-8.5a.25.25 0 01-.25-.25v-8.5zM5.75 6.5a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5zm0 2.5a.75.75 0 000 1.5h2.5a.75.75 0 000-1.5h-2.5z',
        color: '#f59e0b',
        bg: 'rgba(245,158,11,0.1)',
    },
])
</script>

<style scoped>
.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    divide-color: transparent;
}

.stat-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.3rem;
    padding: 1.25rem 1rem;
    text-align: center;
    position: relative;
}

.stat-item + .stat-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 20%;
    height: 60%;
    width: 1px;
    background: rgba(var(--bs-body-color-rgb), 0.08);
}

.stat-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 0.2rem;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    letter-spacing: -0.03em;
    color: var(--bs-body-color);
    line-height: 1;
}

.stat-label {
    font-size: 0.75rem;
    color: var(--bs-secondary-color);
    font-weight: 500;
}
</style>
