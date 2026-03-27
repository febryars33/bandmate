import artistsRoute from '@/routes/artists'
import type { ArtistFilterParams, ArtistFilters } from '@/types/artists/filter'
import { router } from '@inertiajs/vue3'
import debounce from 'lodash/debounce'
import { ref, watch } from 'vue'

const DEBOUNCE_MS = 300

const buildParams = (filters: ArtistFilters): ArtistFilterParams => {
    const params: ArtistFilterParams = {}

    if (filters.search) params.search = filters.search
    if (filters.regencies.length) params.regencies = filters.regencies
    if (filters.genres.length) params.genres = filters.genres

    return params
}

const navigateWithFilters = (filters: ArtistFilters) => {
    router.get(artistsRoute.index(), buildParams(filters), {
        preserveState: true,
        replace: true,
        preserveScroll: true,
    })
}

export function useArtistFilter(initialFilters: ArtistFilters) {
    const search = ref(initialFilters.search)
    const selectedRegencies = ref<number[]>(initialFilters.regencies)
    const selectedGenres = ref<number[]>(initialFilters.genres)

    const hasActiveFilters = () =>
        !!search.value || selectedRegencies.value.length > 0 || selectedGenres.value.length > 0

    const getCurrentFilters = (): ArtistFilters => ({
        search: search.value,
        regencies: selectedRegencies.value,
        genres: selectedGenres.value,
    })

    // Search di-debounce, filter lain langsung submit via applyFilters()
    watch(
        search,
        debounce((value: string) => {
            navigateWithFilters({
                ...getCurrentFilters(),
                search: value,
            })
        }, DEBOUNCE_MS),
    )

    const applyFilters = () => navigateWithFilters(getCurrentFilters())

    const resetFilters = () => {
        search.value = ''
        selectedRegencies.value = []
        selectedGenres.value = []
        navigateWithFilters({ search: '', regencies: [], genres: [] })
    }

    return {
        search,
        selectedRegencies,
        selectedGenres,
        hasActiveFilters,
        applyFilters,
        resetFilters,
    }
}
