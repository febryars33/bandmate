<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta name="description" :content="meta.description" />
    </Head>

    <div class="container py-5">
        <Link class="text-primary text-decoration-none small fw-bold d-flex align-items-center" :href="recruitments.index()" data-discover="true">
            <i class="bi bi-arrow-left me-2" />
            Kembali ke Daftar Lowongan
        </Link>
        <div class="row mt-3">
            <div class="col-lg-8">
                <div class="card p-4 shadow-sm border-0 rounded-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3">
                        <div>
                            <div class="d-flex gap-2 mb-3">
                                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-3 small fw-bold">Drummer</span
                                ><span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-3 small fw-bold">Urgent</span>
                            </div>
                            <h1 class="fw-bold">{{ recruitment.title }}</h1>
                            <p class="text-primary fw-bold d-flex align-items-center fs-5">
                                <i class="bi bi-person-bounding-box me-2" />
                                The Rockers
                            </p>
                        </div>
                        <div class="text-md-end">
                            <p class="small mb-1">Diposting pada</p>
                            <p class="fw-bold small mb-0">15 Maret 2026</p>
                        </div>
                    </div>
                    <div class="row g-3 mb-5 pb-4 border-bottom">
                        <div class="col-md-4">
                            <div class="p-3 bg-body-tertiary rounded-4 border-0 h-100">
                                <p class="small mb-2">Lokasi</p>
                                <p class="fw-bold mb-0 d-flex align-items-center">
                                    <i class="bi bi-geo-alt me-2 text-primary" />
                                    Jakarta Selatan
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-body-tertiary rounded-4 border-0 h-100">
                                <p class="small mb-2">Genre</p>
                                <p class="fw-bold mb-0 d-flex align-items-center">
                                    <i class="bi bi-music-note-beamed text-primary me-2" />
                                    Hard Rock
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-body-tertiary rounded-4 border-0 h-100">
                                <p class="small mb-2">Skill Level</p>
                                <p class="fw-bold mb-0 d-flex align-items-center">
                                    <i class="bi bi-check2-circle text-primary me-2" />
                                    Menengah - Pro
                                </p>
                            </div>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3 small text-uppercase">Deskripsi Lowongan</h5>
                    <p class="mb-5">
                        {{ recruitment.description }}
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3">
                        <button class="btn btn-primary px-5 py-3 shadow-sm fw-bold">Apply Sekarang</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 85px">
                    <div v-if="recruitment.recruitmentable_type === 'App\\Models\\Artist'" class="card p-4 shadow-sm border-0 rounded-4">
                        <h5 class="fw-bold mb-4 small text-uppercase">Tentang Band</h5>
                        <div class="d-flex align-items-center mb-4">
                            <div
                                v-if="recruitment.recruitmentable.img_cover"
                                class="me-3 shadow-sm rounded-3 overflow-hidden"
                                style="width: 64px; height: 64px"
                            >
                                <img
                                    alt="Band"
                                    class="w-100 h-100 object-fit-cover"
                                    :src="'http://localhost:8000/storage' + recruitment.recruitmentable.img_cover"
                                />
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">{{ recruitment.recruitmentable.name }}</h6>
                                <p class="small mb-0">{{ recruitment.recruitmentable.regency_name }}</p>
                            </div>
                        </div>
                        <p class="small mb-4">
                            {{ recruitment.recruitmentable.truncated_about }}
                        </p>
                        <Link
                            class="btn btn-outline-primary btn-sm w-100 py-2 fw-bold"
                            :href="artists.show(recruitment.recruitmentable.slug)"
                            data-discover="true"
                        >
                            Lihat Profil Band
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import artists from '@/routes/artists'
import recruitments from '@/routes/recruitments'
import type { Recruitment } from '@/types/models/recruitment'
import { Head, Link } from '@inertiajs/vue3'

defineProps<{
    meta: { title: string; description: string }
    recruitment: Recruitment
}>()
</script>
