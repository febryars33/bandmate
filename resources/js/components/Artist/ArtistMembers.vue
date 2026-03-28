<template>
    <div class="artist-card artist-animate members-card">
        <p class="section-eyebrow">Anggota</p>

        <!-- Vue tab nav — zero Bootstrap JS dependency -->
        <div class="tab-nav" role="tablist">
            <button
                v-for="tab in tabs"
                :key="tab.key"
                class="tab-btn"
                :class="{ 'tab-btn--active': active === tab.key }"
                role="tab"
                :aria-selected="active === tab.key"
                @click="active = tab.key"
            >
                {{ tab.label }}
                <span class="tab-count">{{ tab.list.length }}</span>
            </button>
        </div>

        <!-- Tab panels -->
        <Transition name="tab-fade" mode="out-in">
            <div :key="active" class="tab-panel" role="tabpanel">
                <ArtistMusician :musicians="currentList" />
                <p v-if="!currentList.length" class="tab-empty">Tidak ada anggota.</p>
            </div>
        </Transition>
    </div>
</template>

<script lang="ts" setup>
import type { ArtistMusician as ArtistMusicianType } from '@/types/models/pivots/artist_musician'
import { computed, ref } from 'vue'
import ArtistMusician from './ArtistMusician.vue'

type TabKey = 'current' | 'complete' | 'past'

const props = defineProps<{
    complete: ArtistMusicianType[]
    current: ArtistMusicianType[]
    past: ArtistMusicianType[]
}>()

const active = ref<TabKey>('current')

const tabs = computed(() => [
    { key: 'current' as TabKey, label: 'Lineup Saat Ini', list: props.current },
    { key: 'complete' as TabKey, label: 'Lineup Lengkap', list: props.complete },
    { key: 'past' as TabKey, label: 'Mantan Anggota', list: props.past },
])

const currentList = computed(() => tabs.value.find((t) => t.key === active.value)?.list ?? [])
</script>

<style scoped>
.members-card {
    padding: 1.5rem 1.5rem 0.75rem;
}

/* --- Tab nav --- */
.tab-nav {
    display: flex;
    flex-wrap: wrap;
    gap: 0.25rem;
    margin-bottom: 1rem;
    padding-bottom: 0.875rem;
    border-bottom: 1px solid rgba(var(--bs-body-color-rgb), 0.08);
}

.tab-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.375rem 0.875rem;
    font-size: 0.8125rem;
    font-weight: 500;
    border: none;
    border-radius: 8px;
    background: transparent;
    color: var(--bs-secondary-color);
    cursor: pointer;
    transition: all 0.15s ease;
}

.tab-btn:hover {
    background: rgba(var(--bs-body-color-rgb), 0.06);
    color: var(--bs-body-color);
}

.tab-btn--active {
    background: rgba(var(--bs-primary-rgb), 0.1);
    color: var(--bs-primary);
    font-weight: 600;
}

.tab-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 18px;
    height: 18px;
    padding: 0 5px;
    border-radius: 999px;
    font-size: 0.7rem;
    font-weight: 700;
    background: rgba(var(--bs-body-color-rgb), 0.08);
    color: var(--bs-secondary-color);
}
.tab-btn--active .tab-count {
    background: rgba(var(--bs-primary-rgb), 0.15);
    color: var(--bs-primary);
}

/* --- Panel --- */
.tab-panel {
    padding-bottom: 0.75rem;
}

.tab-empty {
    font-size: 0.85rem;
    color: var(--bs-secondary-color);
    text-align: center;
    padding: 1.5rem 0;
    margin: 0;
}

/* --- Fade transition --- */
.tab-fade-enter-active,
.tab-fade-leave-active {
    transition:
        opacity 0.15s ease,
        transform 0.15s ease;
}
.tab-fade-enter-from {
    opacity: 0;
    transform: translateY(6px);
}
.tab-fade-leave-to {
    opacity: 0;
    transform: translateY(-4px);
}
</style>
