import artistsRoute from '@/routes/artists'
import { router } from '@inertiajs/vue3'
import debounce from 'lodash/debounce'
import { ref, watch } from 'vue'

export function useArtistSearch(initialSearch: string) {
    const search = ref(initialSearch)

    watch(
        search,
        debounce((value: string) => {
            const params: { search?: string } = {}

            if (value) {
                params.search = value
            }

            router.get(artistsRoute.index(), params, {
                preserveState: true,
                replace: true,
                preserveScroll: true,
            })
        }, 300),
    )

    return { search }
}
