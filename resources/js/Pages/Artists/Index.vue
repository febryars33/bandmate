<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta name="description" :content="meta.description" />
    </Head>

    <div class="container py-4 py-lg-5">
        <div class="page-layout">
            <!-- Sidebar: Filter -->
            <ArtistFilterPanel
                :regencies="regencies.data"
                :genres="genres.data"
                :regencyUrl="regencyUrl"
                :genreUrl="genreUrl"
                :selectedRegencies="selectedRegencies"
                :selectedGenres="selectedGenres"
                :hasActive="hasActiveFilters()"
                @apply="applyFilters"
                @reset="resetFilters"
                @update:selectedRegencies="selectedRegencies = $event"
                @update:selectedGenres="selectedGenres = $event"
            />

            <!-- Main: list -->
            <section class="page-main">
                <ArtistListHeader :total="artists.total" :search="search" @update:search="search = $event" />

                <ArtistGrid :artists="artists" :filterKey="search" :search="search" />
            </section>
        </div>
    </div>
</template>

<script lang="ts" setup>
import API from '@/actions/App/Http/Controllers/API'
import ArtistFilterPanel from '@/components/Artist/ArtistFilterPanel.vue'
import ArtistGrid from '@/components/Artist/ArtistGrid.vue'
import ArtistListHeader from '@/components/Artist/ArtistListHeader.vue'
import { useArtistFilter } from '@/composables/useArtistFilter'
import { genre } from '@/routes'
import type { ArtistFilters } from '@/types/artists/filter'
import type { Artist } from '@/types/models/artist'
import type { Genre } from '@/types/models/genre'
import type { Regency } from '@/types/models/regency'
import type { Pagination } from '@/types/pagination'
import { Head } from '@inertiajs/vue3'

// ─── Props ───────────────────────────────────────────────────────────────────

const props = defineProps<{
    meta: { title: string; description: string }
    artists: Pagination<Artist>
    filters: ArtistFilters
    regencies: Pagination<Regency>
    genres: Pagination<Genre>
}>()

// ─── URLs ─────────────────────────────────────────────────────────────────────

const regencyUrl = API.Regional.RegencyController.url()
const genreUrl = genre().url

// ─── Filter composable ────────────────────────────────────────────────────────

const { search, selectedRegencies, selectedGenres, hasActiveFilters, applyFilters, resetFilters } = useArtistFilter({
    search: props.filters.search ?? '',
    regencies: props.filters.regencies ?? [],
    genres: props.filters.genres ?? [],
})
</script>

<style scoped>
.page-layout {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
}

@media (min-width: 992px) {
    .page-layout {
        grid-template-columns: 260px 1fr;
        align-items: start;
    }
}
</style>
