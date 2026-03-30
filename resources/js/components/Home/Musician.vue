<template>
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
            <div v-for="musician in musicians" class="col-lg-3 mb-4" :key="musician.id">
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
                    <h5 class="fw-bold mb-1">{{ musician.real_name }}</h5>
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
</template>

<script lang="ts" setup>
import { home } from '@/routes'
import type { Musician } from '@/types/models/musician'
import { Link } from '@inertiajs/vue3'

defineProps<{
    musicians: Musician[]
}>()
</script>
