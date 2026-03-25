<template>
    <Head>
        <title>{{ title }}</title>
        <meta type="description" content="Platform kolaborasi musisi di seluruh Indonesia. Mulai karir musikmu bersama rekan yang tepat." />
    </Head>

    <section class="hero-section position-relative overflow-hidden py-5 py-lg-10">
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
                    <div class="mt-5 pt-4 border-top border-light d-none d-md-block">
                        <p class="small text-muted text-uppercase fw-bold letter-spacing-1">Dipercaya oleh 500+ Band Lokal</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container my-5">
        <div class="d-flex">
            <div>
                <h3>Lowongan Musisi Terbaru</h3>
                <p>Banyak band sedang mencari personel baru.</p>
            </div>
            <div class="ms-auto">
                <a href="#" class="btn btn-link"> Lihat Semua <i class="bi bi-arrow-right"></i> </a>
            </div>
        </div>

        <!-- {{ recruitments }} -->

        <div class="row">
            <div v-for="(recruitment, index) in recruitments" class="col-lg-3 mb-4" :key="index">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <div class="badge bg-primary-subtle text-primary">Drummer</div>
                        </div>
                        <h4 class="card-title">{{ recruitment.title }}</h4>
                        <p class="text-muted small mb-3 d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill me-2"></i> {{ recruitment.location }}
                        </p>

                        <p class="card-text">{{ recruitment.description }}</p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a class="btn btn-outline-primary btn-sm w-100" href="/recruitment/2"> Lihat Detail </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import type { Recruitment } from '@/types/models/recruitment'
import { Head } from '@inertiajs/vue3'
// import Quotes from '@/components/Quotes.vue';

defineProps<{ title: string; paragraph: string; recruitments: Recruitment[] }>()
</script>
