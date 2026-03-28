<template>
    <Link :href="href" class="artist-card-link">
        <article class="artist-card">
            <!-- Cover image -->
            <div class="card-cover">
                <img :src="HERO_BG" :alt="artist.name" class="cover-img" loading="lazy" />
                <!-- Location badge -->
                <span v-if="artist.regency" class="loc-badge">
                    <i class="bi bi-geo-alt-fill" />
                    {{ artist.regency.name }}
                </span>
                <!-- Hover overlay -->
                <div class="cover-overlay" aria-hidden="true">
                    <span class="overlay-cta">Lihat Band</span>
                </div>
            </div>

            <!-- Body -->
            <div class="card-body-inner">
                <div class="card-top">
                    <div class="card-identity">
                        <h5 class="card-name">
                            {{ artist.name }}
                            <svg
                                v-if="artist.is_verified"
                                viewBox="0 0 16 16"
                                fill="currentColor"
                                width="14"
                                height="14"
                                class="verified-icon"
                                title="Terverifikasi"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M9.585.52a2.678 2.678 0 00-3.17 0l-.928.68a1.178 1.178 0 01-.518.215L3.83 1.59a2.678 2.678 0 00-2.24 2.24l-.175 1.14a1.178 1.178 0 01-.215.518l-.68.928a2.678 2.678 0 000 3.17l.68.928c.113.153.186.33.215.518l.175 1.138a2.678 2.678 0 002.24 2.24l1.138.175c.187.029.365.102.518.215l.928.68a2.678 2.678 0 003.17 0l.928-.68a1.178 1.178 0 01.518-.215l1.138-.175a2.678 2.678 0 002.241-2.241l.175-1.138c.029-.187.102-.365.215-.518l.68-.928a2.678 2.678 0 000-3.17l-.68-.928a1.178 1.178 0 01-.215-.518L14.41 3.83a2.678 2.678 0 00-2.24-2.24l-1.138-.175a1.178 1.178 0 01-.518-.215L9.585.52zM7.303 9.803L5.92 8.42a.75.75 0 011.06-1.061l1.106 1.105 2.214-2.7a.75.75 0 011.168.946l-2.752 3.354a.75.75 0 01-1.413-.261z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </h5>
                        <span class="card-song-count"> {{ artist.discographies_count }} Diskografi </span>
                    </div>

                    <div v-if="artist.few_genres?.length" class="card-genres">
                        <span v-for="g in artist.few_genres" :key="g.id" class="genre-chip">
                            {{ g.name }}
                        </span>
                    </div>
                </div>

                <p class="card-bio">{{ artist.truncated_about || DEFAULT_BIO }}</p>
            </div>
        </article>
    </Link>
</template>

<script lang="ts" setup>
import { show } from '@/routes/artists'
import type { Artist } from '@/types/models/artist'
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const DEFAULT_BIO = 'Belum ada deskripsi untuk band ini.'

const props = defineProps<{ artist: Artist }>()

const href = computed(() => show(props.artist.slug))

let HERO_BG = 'https://placehold.co/820x360/1a1a2e/ffffff?font=raleway&text=' + props.artist.name

if (props.artist.img_cover !== null) {
    HERO_BG = 'http://localhost:8000/storage' + props.artist.img_cover
}
</script>

<style scoped>
/* ── Link reset ── */
.artist-card-link {
    display: block;
    text-decoration: none;
    color: inherit;
    height: 100%;
}

/* ── Card shell ── */
.artist-card {
    height: 100%;
    border-radius: 16px;
    border: 1px solid rgba(var(--bs-body-color-rgb), 0.07);
    background: var(--bs-body-bg);
    box-shadow:
        0 1px 3px rgba(0, 0, 0, 0.04),
        0 4px 16px rgba(0, 0, 0, 0.04);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition:
        box-shadow 0.25s ease,
        transform 0.25s ease;
}
.artist-card-link:hover .artist-card {
    box-shadow:
        0 4px 12px rgba(0, 0, 0, 0.08),
        0 12px 32px rgba(0, 0, 0, 0.1);
    transform: translateY(-3px);
}

/* ── Cover ── */
.card-cover {
    position: relative;
    overflow: hidden;
    aspect-ratio: 16 / 7;
}

.cover-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.4s ease;
}
.artist-card-link:hover .cover-img {
    transform: scale(1.04);
}

.loc-badge {
    position: absolute;
    bottom: 0.625rem;
    left: 0.625rem;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    padding: 0.25rem 0.65rem;
    border-radius: 999px;
    font-size: 0.72rem;
    font-weight: 500;
    background: rgba(0, 0, 0, 0.65);
    color: #fff;
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
}

.cover-overlay {
    position: absolute;
    inset: 0;
    background: rgba(var(--bs-primary-rgb), 0.85);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.2s ease;
}
.artist-card-link:hover .cover-overlay {
    opacity: 1;
}

overlay-cta {
    color: #fff;
    font-size: 0.875rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}

/* ── Body ── */
.card-body-inner {
    padding: 1.125rem 1.25rem 1.25rem;
    display: flex;
    flex-direction: column;
    gap: 0.625rem;
    flex: 1;
}

.card-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 0.5rem;
}

.card-identity {
    flex: 1;
    min-width: 0;
}

.card-name {
    font-size: 1rem;
    font-weight: 700;
    letter-spacing: -0.01em;
    margin: 0 0 0.2rem;
    display: flex;
    align-items: center;
    gap: 0.3rem;
    color: var(--bs-body-color);
}

.verified-icon {
    color: var(--bs-primary);
    flex-shrink: 0;
}

.card-song-count {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 0.75rem;
    color: var(--bs-secondary-color);
}

/* ── Genres ── */
.card-genres {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-end;
    gap: 0.3rem;
    flex-shrink: 0;
}

.genre-chip {
    font-size: 0.68rem;
    font-weight: 600;
    padding: 0.2rem 0.55rem;
    border-radius: 999px;
    background: rgba(var(--bs-primary-rgb), 0.1);
    color: var(--bs-primary);
    border: 1px solid rgba(var(--bs-primary-rgb), 0.2);
    white-space: nowrap;
}

/* ── Bio ── */
.card-bio {
    font-size: 0.8125rem;
    color: var(--bs-secondary-color);
    line-height: 1.6;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
