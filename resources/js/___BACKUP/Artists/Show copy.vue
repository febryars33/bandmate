<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta type="description" :content="meta.description" />
    </Head>

    <!-- It seems like this hero is cool if parallax -->
    <section class="hero d-flex align-items-end mb-5">
        <div class="container pb-5">
            <h1 class="display-2" style="font-weight: bolder">{{ artist.name }}</h1>
            <h4 style="font-weight: 300">{{ artist.regency_name }}</h4>
        </div>
    </section>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link :href="artists.index()">Band</Link>
                    </li>
                    <li class="breadcrumb-item active">{{ artist.name }}</li>
                </ol>
            </nav>
            <Link :href="artists.index()" class="btn btn-link ms-auto"> <i class="bi bi-arrow-left"></i> Back </Link>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="col-6 col-lg-6 mx-auto">
                            <img src="https://picsum.photos/seed/band1/300/300" alt="Band" class="img-fluid rounded-4" />
                        </div>
                        <div class="text-center mt-3">
                            <h2>{{ artist.name }}</h2>
                            <p>Bandung, Jawa Barat</p>
                            <div class="mb-3">
                                <span
                                    v-for="genre in artist.genres"
                                    class="badge rounded-pill bg-primary-subtle text-primary border border-primary-subtle"
                                    :key="genre.id"
                                >
                                    {{ genre.name }}
                                </span>
                            </div>

                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-dark">
                                    <i class="bi bi-globe" />
                                </button>
                                <button type="button" class="btn btn-success">
                                    <i class="bi bi-spotify" />
                                </button>
                                <button type="button" class="btn btn-blue">
                                    <i class="bi bi-facebook" />
                                </button>
                                <button type="button" class="btn btn-pink">
                                    <i class="bi bi-instagram" />
                                </button>
                                <button type="button" class="btn btn-dark">
                                    <i class="bi bi-twitter-x" />
                                </button>
                                <button type="button" class="btn btn-primary">
                                    <i class="bi bi-youtube" />
                                </button>
                                <button type="button" class="btn btn-dark">
                                    <i class="bi bi-wikipedia" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h3>Tentang Band</h3>
                        <div class="mb-4">
                            <p>
                                {{ artist.about }}
                            </p>
                        </div>

                        <template v-if="artist.complete_lineups.length > 0">
                            <h5>Members</h5>
                            <div class="mb-4">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button
                                            class="nav-link"
                                            id="nav-complete-lineup-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#nav-complete-lineup"
                                            type="button"
                                            role="tab"
                                            aria-controls="nav-complete-lineup"
                                            aria-selected="true"
                                        >
                                            Complete Lineup
                                        </button>
                                        <button
                                            class="nav-link active"
                                            id="nav-current-lineup-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#nav-current-lineup"
                                            type="button"
                                            role="tab"
                                            aria-controls="nav-current-lineup"
                                            aria-selected="false"
                                        >
                                            Current Lineup
                                        </button>
                                        <button
                                            class="nav-link"
                                            id="nav-past-members-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#nav-past-members"
                                            type="button"
                                            role="tab"
                                            aria-controls="nav-past-members"
                                            aria-selected="false"
                                        >
                                            Past Members
                                        </button>
                                        <!-- <button
                                            class="nav-link"
                                            id="nav-disabled-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#nav-disabled"
                                            type="button"
                                            role="tab"
                                            aria-controls="nav-disabled"
                                            aria-selected="false"
                                            disabled
                                        >
                                            Live Musicians
                                        </button> -->
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div
                                        class="tab-pane fade"
                                        id="nav-complete-lineup"
                                        role="tabpanel"
                                        aria-labelledby="nav-complete-lineup-tab"
                                        tabindex="0"
                                    >
                                        <Musician :musicians="artist.complete_lineups" />
                                    </div>
                                    <div
                                        class="tab-pane fade show active"
                                        id="nav-current-lineup"
                                        role="tabpanel"
                                        aria-labelledby="nav-current-lineup-tab"
                                        tabindex="0"
                                    >
                                        <Musician :musicians="artist.current_lineups" />
                                    </div>
                                    <div
                                        class="tab-pane fade"
                                        id="nav-past-members"
                                        role="tabpanel"
                                        aria-labelledby="nav-past-members-tab"
                                        tabindex="0"
                                    >
                                        <Musician :musicians="artist.past_members" />
                                    </div>
                                    <!-- <div class="tab-pane fade" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab" tabindex="0">
                                        ...
                                    </div> -->
                                </div>
                            </div>
                        </template>

                        <template v-if="artist.discographies.length > 0">
                            <h5>Discography</h5>
                            <div class="row g-4">
                                <div v-for="discography in artist.discographies" class="col-lg-6 mb-1" :key="discography.id">
                                    <a role="button">
                                        <div class="card card-body border p-3 m-0">
                                            <div class="row align-items-center">
                                                <div class="col-4 col-lg-3">
                                                    <img
                                                        :src="pageProps.baseUrl + '/storage' + discography.cover"
                                                        :alt="discography.title"
                                                        class="img-fluid rounded"
                                                    />
                                                </div>
                                                <div class="col-8 col-lg-9">
                                                    <h4 class="m-0">{{ discography.title }}</h4>
                                                    <h6 class="m-0 text-muted">
                                                        {{
                                                            new Intl.DateTimeFormat('en-US', { year: 'numeric' }).format(
                                                                new Date(discography.release_date),
                                                            )
                                                        }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="card card-body">
            {{ slug }}
        </div>
        <div class="card card-body">
            {{ artist }}
        </div> -->
    </div>
</template>

<script lang="ts" setup>
import Musician from '@/components/Artist/Musician.vue'
import artists from '@/routes/artists'
import type { Artist } from '@/types/models/artist'
import { Head, Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

defineProps<{
    slug: string
    artist: Artist
    meta: {
        title: string
        description: string
    }
}>()

const page = usePage()
const pageProps = computed(() => page.props)
</script>

<style>
.hero {
    background:
        linear-gradient(0deg, rgba(0, 0, 0, 0.3), transparent),
        url(https://saosin.com/cdn/shop/files/SAOSIN_DESKTOPO_HERO.png?v=1755126017&width=2000);
    background-size: cover;
    background-position: center;
    min-height: 600px;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
