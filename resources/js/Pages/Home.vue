<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta type="description" :content="meta.description" />
    </Head>

    <section class="hero-section position-relative overflow-hidden">
        <!-- Background Decor (Elemen ini bikin UI tidak flat) -->
        <div class="hero-blob hero-blob-1"></div>
        <div class="hero-blob hero-blob-2"></div>

        <div class="container position-relative">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10 col-xl-8">
                    <!-- Badge Kecil di Atas Judul (Sangat Tren saat ini) -->
                    <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2 mb-4 animate-up">
                        <i class="bi bi-stars me-1"></i> #1 Platform Kolaborasi Musisi
                    </span>

                    <h1 class="display-3 fw-black mb-3 tracking-tight main-title">
                        Temukan <span class="text-gradient">Band</span> atau <span class="text-gradient">Personel</span> Musik di Kotamu
                    </h1>

                    <p class="lead text-muted mb-5 mx-auto opacity-75 sub-title" style="max-width: 600px">
                        Platform kolaborasi musisi terbesar di Indonesia. Bangun karir musikmu dengan rekan yang tepat, mulai hari ini.
                    </p>

                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                        <a class="btn btn-primary btn-lg rounded-pill px-5 py-3 shadow-lg btn-glow" href="#">
                            Cari Lowongan <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        <a class="btn btn-outline-primary btn-lg rounded-pill px-5 py-3 border-2 btn-glow" href="#"> Cari Musisi </a>
                    </div>

                    <!-- Social Proof Sederhana (Opsional) -->
                    <!-- <div class="mt-5 pt-4 border-top border-light d-none d-md-block">
                        <p class="small text-muted text-uppercase fw-bold letter-spacing-1">Dipercaya oleh 500+ Band Lokal</p>
                    </div> -->
                </div>
            </div>
        </div>
    </section>

    <div class="container my-5">
        <div class="d-flex">
            <div>
                <h3>Lowongan Musisi Terbaru</h3>
                <p>Banyak band sedang mencari personel baru untuk bergabung</p>
            </div>
            <div class="ms-auto">
                <Link :href="recruitmentsRoute.index()" class="btn btn-link"> Lihat Semua <i class="bi bi-arrow-right"></i> </Link>
            </div>
        </div>
        <div class="row">
            <div v-for="recruitment in recruitments" class="col-lg-3 mb-4" :key="recruitment.id">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <div class="badge bg-primary-subtle text-primary">Drummer</div>
                        </div>
                        <h4 class="card-title">{{ recruitment.title }}</h4>
                        <p class="text-muted small mb-3 d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill me-2"></i> {{ recruitment.regency_name }}
                        </p>

                        <p class="card-text small text-muted">{{ recruitment.truncated_description }}</p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <Link :href="recruitmentsRoute.show(recruitment.slug).url" class="btn btn-outline-primary btn-sm w-100"> Lihat Detail </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="d-flex">
            <div>
                <h3>Musisi Berbakat Terbaru</h3>
                <p>Temukan rekan kolaborasi terbaik untuk proyek musikmu</p>
            </div>
            <div class="ms-auto">
                <Link :href="home()" class="btn btn-link"> Lihat Semua <i class="bi bi-arrow-right"></i> </Link>
            </div>
        </div>
        <div class="row">
            <div v-for="item in 8" class="col-lg-3 mb-4" :key="item">
                <div class="card h-100 p-4 text-center border-0 shadow-sm">
                    <div class="mb-4 mx-auto position-relative" style="width: 90px; height: 90px">
                        <img
                            alt="Musician"
                            class="rounded-circle w-100 h-100 object-fit-cover border-3 border-white shadow-sm"
                            referrerpolicy="no-referrer"
                            src="https://picsum.photos/seed/musician1/100/100"
                        />
                        <div
                            class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle p-1"
                            style="width: 14px; height: 14px"
                        ></div>
                    </div>
                    <h5 class="fw-bold mb-1">Andi Pratama</h5>
                    <p class="small fw-bold mb-3">Gitaris · Rock</p>
                    <p class="small mb-4 d-flex align-items-center justify-content-center">
                        <i class="bi bi-geo-alt-fill me-2" />
                        Bandung
                    </p>
                    <a class="btn btn-outline-primary btn-sm w-100 py-2" href="/musician/1" data-discover="true">Lihat Profil</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="d-flex">
            <div>
                <h3>Event Musik Mendatang</h3>
                <p>Jangan lewatkan keseruannya di tahun ini</p>
            </div>
            <div class="ms-auto">
                <Link :href="events.index()" class="btn btn-link"> Lihat Semua <i class="bi bi-arrow-right"></i> </Link>
            </div>
        </div>
        <div class="row">
            <div v-for="item in 4" class="col-lg-6 mb-4" :key="item">
                <div class="card h-100 overflow-hidden flex-row">
                    <div class="w-40 d-none d-sm-block">
                        <img alt="Event" class="h-100 w-100 object-fit-cover" :src="'https://picsum.photos/seed/event' + (item + 4) + '/400/300'" />
                    </div>
                    <div class="p-4 flex-grow-1">
                        <span class="badge bg-warning-subtle text-warning-emphasis mb-2">Festival</span>
                        <h4 class="fw-bold mb-2">Hammersonic Fest 2026</h4>
                        <p class="text-muted small mb-3">
                            <i class="bi bi-calendar me-2"></i>
                            15 Mei 2026
                        </p>
                        <p class="text-muted small mb-4">Festival musik metal terbesar di Asia Tenggara kembali hadir di Jakarta...</p>
                        <Link class="btn btn-outline-primary btn-sm" :href="events.show(item)">Lihat Detail</Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { home } from '@/routes'
import events from '@/routes/events'
import recruitmentsRoute from '@/routes/recruitments'
import type { Recruitment } from '@/types/models/recruitment'
import { Head, Link } from '@inertiajs/vue3'

defineProps<{
    recruitments: Recruitment[]
    meta: {
        title: string
        description: string
    }
}>()
</script>
