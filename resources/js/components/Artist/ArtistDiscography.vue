<template>
    <div class="artist-card artist-animate disco-card">
        <p class="section-eyebrow">Diskografi</p>

        <div class="disco-grid">
            <a v-for="d in discographies" :key="d.id" role="button" class="disco-item">
                <div class="disco-cover-wrap">
                    <img :src="baseUrl + '/storage' + d.cover" :alt="d.title" class="disco-cover" />
                    <div class="disco-overlay" aria-hidden="true">
                        <svg viewBox="0 0 20 20" fill="currentColor" width="20" height="20">
                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z" />
                        </svg>
                    </div>
                </div>
                <div class="disco-meta">
                    <span class="disco-title">{{ d.title }}</span>
                    <span class="disco-year">{{ releaseYear(d.release_date) }}</span>
                </div>
            </a>
        </div>
    </div>
</template>

<script lang="ts" setup>
interface Discography {
    id: number
    title: string
    cover: string
    release_date: string
}

defineProps<{
    discographies: Discography[]
    baseUrl: string
}>()

const releaseYear = (date: string): string => new Intl.DateTimeFormat('id-ID', { year: 'numeric' }).format(new Date(date))
</script>

<style scoped>
.disco-card {
    padding: 1.5rem;
}

.disco-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 1rem;
}

.disco-item {
    cursor: pointer;
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

/* --- Cover with hover play overlay --- */
.disco-cover-wrap {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    aspect-ratio: 1;
}

.disco-cover {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.3s ease;
}
.disco-item:hover .disco-cover {
    transform: scale(1.06);
}

.disco-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    opacity: 0;
    transition: opacity 0.2s ease;
    border-radius: 10px;
}
.disco-item:hover .disco-overlay {
    opacity: 1;
}

/* --- Meta --- */
.disco-meta {
    display: flex;
    flex-direction: column;
    gap: 0.1rem;
}

.disco-title {
    font-size: 0.8125rem;
    font-weight: 600;
    color: var(--bs-body-color);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.3;
}

.disco-year {
    font-size: 0.75rem;
    color: var(--bs-secondary-color);
}
</style>
