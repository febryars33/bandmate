<template>
    <!-- Results -->
    <template v-if="artists.data.length">
        <InfiniteScroll data="artists" :key="filterKey">
            <div class="row g-4">
                <div v-for="(artist, i) in artists.data" :key="artist.id" class="col-lg-6 artist-col" :style="{ animationDelay: `${i * 0.055}s` }">
                    <ArtistCard :artist="artist" />
                </div>
            </div>
        </InfiniteScroll>
    </template>

    <!-- Empty state -->
    <div v-else class="empty-state">
        <div class="empty-icon-wrap" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" width="40" height="40">
                <circle cx="11" cy="11" r="7.5" stroke="currentColor" stroke-width="1.5" />
                <path d="M16.5 16.5L21 21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                <path d="M8 11h6M11 8v6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
            </svg>
        </div>
        <h6 class="empty-title">Band tidak ditemukan</h6>
        <p class="empty-sub">
            <template v-if="search"
                >Tidak ada hasil untuk "<strong>{{ search }}</strong
                >"</template
            >
            <template v-else>Coba ubah filter yang diterapkan</template>
        </p>
    </div>
</template>

<script lang="ts" setup>
import type { Artist } from '@/types/models/artist'
import type { Pagination } from '@/types/pagination'
import { InfiniteScroll } from '@inertiajs/vue3'
import ArtistCard from './ArtistCard.vue'

defineProps<{
    artists: Pagination<Artist>
    filterKey: string // passed as :key to InfiniteScroll, resets on search change
    search: string
}>()
</script>

<style scoped>
/* Staggered entry */
.artist-col {
    animation: fadeUp 0.45s cubic-bezier(0.22, 1, 0.36, 1) both;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(16px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ── Empty state ── */
.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 4rem 1rem;
    gap: 0.5rem;
    animation: fadeUp 0.4s ease both;
}

.empty-icon-wrap {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: rgba(var(--bs-body-color-rgb), 0.05);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--bs-secondary-color);
    margin-bottom: 0.5rem;
}

.empty-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--bs-body-color);
    margin: 0;
}

.empty-sub {
    font-size: 0.85rem;
    color: var(--bs-secondary-color);
    margin: 0;
}
</style>
