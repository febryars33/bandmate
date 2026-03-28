<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta name="description" :content="meta.description" />
    </Head>

    <div class="container py-4 py-lg-5">
        <div class="row">
            <div class="col-lg-3 mb-3">
                <RecruitmentFilterPanel
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
            </div>
            <div class="col-lg-9">
                <RecruitmentListHeader :total="recruitments.total" :search="search" @update:search="search = $event" />

                <RecruitmentGrid :recruitments="recruitments" :filterKey="search" :search="search" />
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import API from '@/actions/App/Http/Controllers/API'
import RecruitmentFilterPanel from '@/components/Recruitment/RecruitmentFilterPanel.vue'
import RecruitmentGrid from '@/components/Recruitment/RecruitmentGrid.vue'
import RecruitmentListHeader from '@/components/Recruitment/RecruitmentListHeader.vue'
import { useRecruitmentFilter } from '@/composables/useRecruitmentFilter'
import { genre } from '@/routes'
import type { RecruitmentFilters } from '@/types/artists/filter'
import type { Genre } from '@/types/models/genre'
import type { Recruitment } from '@/types/models/recruitment'
import type { Regency } from '@/types/models/regency'
import type { Pagination } from '@/types/pagination'
import { Head } from '@inertiajs/vue3'

// ─── Props ───────────────────────────────────────────────────────────────────

const props = defineProps<{
    meta: { title: string; description: string }
    recruitments: Pagination<Recruitment>
    filters: RecruitmentFilters
    regencies: Pagination<Regency>
    genres: Pagination<Genre>
}>()

// ─── URLs ─────────────────────────────────────────────────────────────────────

const regencyUrl = API.Regional.RegencyController.url()
const genreUrl = genre().url

// ─── Filter composable ────────────────────────────────────────────────────────

const { search, selectedRegencies, selectedGenres, hasActiveFilters, applyFilters, resetFilters } = useRecruitmentFilter({
    search: props.filters.search ?? '',
    regencies: props.filters.regencies ?? [],
    genres: props.filters.genres ?? [],
})
</script>
