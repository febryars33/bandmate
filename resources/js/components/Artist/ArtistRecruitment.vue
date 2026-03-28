<template>
    <div class="artist-card artist-animate about-card">
        <p class="section-eyebrow">Lowongan Terbuka</p>
        <ul class="list-group list-group-flush">
            <li v-for="recruitment in recruitments" class="list-group-item" :key="recruitment.id">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="bg-body-tertiary p-3 rounded-3 me-3 shadow-sm">
                            <i class="bi bi-music-note-beamed text-primary" />
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">{{ recruitment.title }}</h6>
                            <p class="text-primary small mb-0">{{ recruitment.regency_name }}</p>
                        </div>
                    </div>
                    <Link :href="recruitmentsRoute.show(recruitment.slug)" class="btn btn-ghost-primary btn-sm shadow px-3 py-2" data-discover="true">
                        Lihat Detail
                    </Link>
                </div>
            </li>
        </ul>
    </div>
</template>

<script lang="ts" setup>
import recruitmentsRoute from '@/routes/recruitments'
import type { Recruitment } from '@/types/models/recruitment'
import { Link } from '@inertiajs/vue3'

defineProps<{
    recruitments: Recruitment[]
}>()
</script>

<style scoped>
.about-card {
    padding: 1.5rem;
}
</style>
