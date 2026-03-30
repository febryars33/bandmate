<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta name="description" :content="meta.description" />
    </Head>

    <!-- Parallax hero -->
    <ArtistHero :name="artist.name" :location="artist.regency_name" :bg="HERO_BG" />

    <!-- Page body -->
    <div class="container py-4 py-lg-5">
        <div class="artist-layout">
            <!-- Sidebar (sticky) -->
            <ArtistSidebar :name="artist.name" :location="artist.regency_name" :cover="BAND_COVER" :genres="artist.genres" :socials="socials" />

            <!-- Main content -->
            <div class="artist-main">
                <ArtistAbout v-if="artist.about" :about="artist.about" class="mb-4" />

                <ArtistMembers
                    v-if="artist.complete_lineups.length"
                    :complete="artist.complete_lineups"
                    :current="artist.current_lineups"
                    :past="artist.past_members"
                    class="mb-4"
                />

                <ArtistRecruitment v-if="artist.recruitments.length" :recruitments="artist.recruitments" class="mb-4" />

                <ArtistDiscography v-if="artist.discographies.length" :discographies="artist.discographies" :base-url="pageProps.baseUrl" />
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import '@/components/Artist/artist.css'
import ArtistAbout from '@/components/Artist/ArtistAbout.vue'
import ArtistDiscography from '@/components/Artist/ArtistDiscography.vue'
import ArtistHero from '@/components/Artist/ArtistHero.vue'
import ArtistMembers from '@/components/Artist/ArtistMembers.vue'
import ArtistRecruitment from '@/components/Artist/ArtistRecruitment.vue'
import ArtistSidebar from '@/components/Artist/ArtistSidebar.vue'
import type { Artist } from '@/types/models/artist'
import { Head, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

// ─── Props ───────────────────────────────────────────────────────────────────
const props = defineProps<{
    slug: string
    artist: Artist
    meta: { title: string; description: string }
}>()

const page = usePage()
const pageProps = computed(() => page.props)

// ─── Static assets (swap with dynamic data when API provides them) ───────────
let HERO_BG = 'https://placehold.co/820x360/1a1a2e/ffffff?font=raleway&text=' + props.artist.name
let BAND_COVER = 'https://placehold.co/200x200/1a1a2e/ffffff?font=raleway&text=' + props.artist.name

if (props.artist.img_cover !== null) {
    HERO_BG = 'http://localhost:8000/storage' + props.artist.img_cover
}

if (props.artist.img_logo !== null) {
    BAND_COVER = 'http://localhost:8000/storage' + props.artist.img_logo
} else if (props.artist.img_cover !== null) {
    BAND_COVER = 'http://localhost:8000/storage' + props.artist.img_cover
}

// ─── Social links (extend when API provides URLs) ────────────────────────────
const socials = computed(() =>
    [
        { label: 'Website', href: '#', icon: 'bi bi-globe', color: '#6b7280' },
        { label: 'Spotify', href: '#', icon: 'bi bi-spotify', color: '#1db954' },
        { label: 'Facebook', href: '#', icon: 'bi bi-facebook', color: '#1877f2' },
        { label: 'Instagram', href: '#', icon: 'bi bi-instagram', color: '#e1306c' },
        { label: 'Twitter/X', href: '#', icon: 'bi bi-twitter-x', color: '#000000' },
        { label: 'YouTube', href: '#', icon: 'bi bi-youtube', color: '#ff0000' },
        { label: 'Wikipedia', href: '#', icon: 'bi bi-wikipedia', color: '#6b7280' },
    ].filter((s) => s.href !== '#'),
) // hide if no real URL — remove filter when API ready
</script>

<style scoped>
.artist-layout {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.25rem;
}

@media (min-width: 992px) {
    .artist-layout {
        grid-template-columns: 280px 1fr;
        align-items: start;
    }
}
</style>
