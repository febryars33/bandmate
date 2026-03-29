<template>
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
</template>

<script lang="ts" setup>
import recruitmentsRoute from '@/routes/recruitments'
import type { Recruitment } from '@/types/models/recruitment'
import { Link } from '@inertiajs/vue3'

defineProps<{
    recruitments: Recruitment[]
}>()
</script>
