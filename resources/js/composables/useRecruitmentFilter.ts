import recruitmentsRoute from '@/routes/recruitments'
import type { RecruitmentFilterParams, RecruitmentFilters } from '@/types/artists/filter'
import { router } from '@inertiajs/vue3'
import debounce from 'lodash/debounce'
import { ref, watch } from 'vue'

const DEBOUNCE_MS = 300

const buildParams = (filters: RecruitmentFilters): RecruitmentFilterParams => {
    const params: RecruitmentFilterParams = {}

    if (filters.search) params.search = filters.search
    if (filters.regencies.length) params.regencies = filters.regencies
    if (filters.genres.length) params.genres = filters.genres

    return params
}

const navigateWithFilters = (filters: RecruitmentFilters) => {
    router.get(recruitmentsRoute.index(), buildParams(filters), {
        preserveState: true,
        replace: true,
        preserveScroll: true,
    })
}

export function useRecruitmentFilter(initialFilters: RecruitmentFilters) {
    const search = ref(initialFilters.search)
    const selectedRegencies = ref<number[]>(initialFilters.regencies)
    const selectedGenres = ref<number[]>(initialFilters.genres)

    const hasActiveFilters = () =>
        !!search.value || selectedRegencies.value.length > 0 || selectedGenres.value.length > 0

    const getCurrentFilters = (): RecruitmentFilters => ({
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
