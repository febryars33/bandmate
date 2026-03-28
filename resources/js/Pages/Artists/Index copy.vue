<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta name="description" :content="meta.description" />
    </Head>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <div class="d-flex justify-content-between mb-3">
                    <h3 class="m-0">Filter Band</h3>
                    <button type="button" class="btn btn-sm btn-outline-danger" :disabled="!hasActiveFilters()" @click="resetFilters">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
                <form @submit.prevent="applyFilters">
                    <div class="mb-3">
                        <label for="regency" class="form-label fw-bold">Pilih Kota / Kabupaten</label>
                        <MultiSelect
                            id="regency"
                            :fetchUrl="regencyUrl"
                            :search="true"
                            :paginate="true"
                            v-model="selectedRegencies"
                            :options="regencies.data"
                            placeholder="Pilih Kota / Kabupaten"
                            :initialNextPageUrl="regencyUrl"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="genre" class="form-label fw-bold">Genre</label>
                        <MultiSelect
                            id="genre"
                            :fetchUrl="genreUrl"
                            :search="true"
                            :paginate="true"
                            v-model="selectedGenres"
                            :options="genres.data"
                            placeholder="Pilih Genre..."
                            :initialNextPageUrl="genreUrl"
                        />
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary rounded-pill fw-bold py-2">Terapkan Filter</button>
                    </div>
                </form>
            </div>

            <div class="col-lg-9">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <h3 class="fw-bold m-0">Daftar Band</h3>
                            <span v-if="artists.total > 0" class="badge rounded-pill bg-primary-subtle text-primary fw-medium px-3 animate-fade-in">
                                {{ artists.total }}
                            </span>
                        </div>
                        <p class="text-muted small m-0">
                            <span v-if="filters.search">Hasil pencarian untuk "{{ filters.search }}"</span>
                            <span v-else>Eksplorasi band terpopuler</span>
                        </p>
                    </div>

                    <div class="col-md-5 col-lg-4 position-relative">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <input
                            type="search"
                            class="form-control rounded-pill ps-5 shadow-sm"
                            placeholder="Cari band favoritmu..."
                            v-model="search"
                            style="height: 46px"
                        />
                    </div>
                </div>

                <template v-if="artists.data.length > 0">
                    <InfiniteScroll data="artists" :key="filters.search">
                        <div class="row g-4">
                            <div v-for="artist in artists.data" :key="artist.id" class="col-lg-6">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="position-relative overflow-hidden card-img-wrapper">
                                        <img
                                            :src="'https://placehold.co/600x300?font=poppins&text=' + artist.name"
                                            class="card-img-top"
                                            alt="Artist Image"
                                            loading="lazy"
                                        />
                                        <div v-if="artist.regency" class="position-absolute bottom-0 start-0 m-3">
                                            <span class="badge bg-dark bg-opacity-75 blur-shadow py-2 px-3 rounded-pill small">
                                                <i class="bi bi-geo-alt-fill me-1 text-primary"></i> {{ artist.regency.name }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="fw-bold mb-1 d-flex align-items-center gap-1">
                                                    {{ artist.name }}
                                                    <sup v-if="artist.is_verified" class="bi bi-patch-check-fill text-blue" />
                                                </h5>
                                                <div class="d-flex align-items-center gap-2 text-muted x-small">
                                                    <span class="d-flex align-items-center gap-1">
                                                        <i class="bi bi-music-note-list text-primary"></i>
                                                        <strong>{{ 0 }}</strong> Lagu
                                                    </span>
                                                </div>
                                            </div>

                                            <div v-if="artist.few_genres?.length" class="d-flex flex-wrap justify-content-end gap-1">
                                                <span
                                                    v-for="genre in artist.few_genres"
                                                    :key="genre.id"
                                                    class="badge rounded-pill bg-primary-subtle text-primary border border-primary-subtle"
                                                >
                                                    {{ genre.name }}
                                                </span>
                                            </div>
                                        </div>

                                        <p class="card-text text-muted mb-4 line-clamp-2">
                                            {{ artist.about || DEFAULT_ARTIST_BIO }}
                                        </p>
                                    </div>

                                    <div class="card-footer d-grid bg-transparent">
                                        <Link :href="show(artist.slug)" class="btn btn-outline-primary rounded-pill fw-bold py-2">
                                            Lihat Band <i class="bi bi-arrow-right ms-1"></i>
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </InfiniteScroll>
                </template>

                <template v-else>
                    <div class="text-center py-5">
                        <i class="bi bi-search display-1 text-muted"></i>
                        <p class="mt-3">
                            Maaf, band "<strong>{{ search }}</strong
                            >" tidak ditemukan.
                        </p>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import API from '@/actions/App/Http/Controllers/API'
import MultiSelect from '@/components/MultiSelect.vue'
import { useArtistFilter } from '@/composables/useArtistFilter'
import { genre } from '@/routes'
import { show } from '@/routes/artists'
import type { ArtistFilters } from '@/types/artists/filter'
import type { Artist } from '@/types/models/artist'
import type { Genre } from '@/types/models/genre'
import type { Regency } from '@/types/models/regency'
import type { Pagination } from '@/types/pagination'
import { Head, InfiniteScroll, Link } from '@inertiajs/vue3'

// ─── Constants ───────────────────────────────────────────────────────────────

const DEFAULT_ARTIST_BIO = 'Belum ada bio.'

// ─── Interfaces ──────────────────────────────────────────────────────────────

interface Meta {
    title: string
    description: string
}

interface Props {
    meta: Meta
    artists: Pagination<Artist>
    filters: ArtistFilters
    regencies: Pagination<Regency>
    genres: Pagination<Genre>
}

// ─── Props ───────────────────────────────────────────────────────────────────

const props = defineProps<Props>()

// ─── URLs ────────────────────────────────────────────────────────────────────

const regencyUrl = API.Regional.RegencyController.url()
const genreUrl = genre().url

// ─── Filter ──────────────────────────────────────────────────────────────────

const { search, selectedRegencies, selectedGenres, hasActiveFilters, applyFilters, resetFilters } = useArtistFilter({
    search: props.filters.search ?? '',
    regencies: props.filters.regencies ?? [],
    genres: props.filters.genres ?? [],
})
</script>
