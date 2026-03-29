<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta type="description" :content="meta.description" />
    </Head>

    <div>
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

        <RecruitmentComponent :recruitments="recruitments" />

        <!-- <Musician /> -->

        <!-- <Event /> -->
    </div>
</template>

<script lang="ts" setup>
import RecruitmentComponent from '@/components/Home/Recruitment.vue'
import type { Recruitment } from '@/types/models/recruitment'
import { Head } from '@inertiajs/vue3'

defineProps<{
    recruitments: Recruitment[]
    meta: {
        title: string
        description: string
    }
}>()
</script>
