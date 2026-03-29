<template>
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
            <div class="col-lg-6 mb-4">
                <div class="card h-100 overflow-hidden flex-row">
                    <div class="w-40 d-none d-sm-block">
                        <img alt="Event" class="h-100 w-100 object-fit-cover" :src="'https://picsum.photos/seed/event4/400/300'" />
                    </div>
                    <div class="p-4 flex-grow-1">
                        <span class="badge bg-warning-subtle text-warning-emphasis mb-2">Festival</span>
                        <h4 class="fw-bold mb-2">Hammersonic Fest 2026</h4>
                        <p class="text-muted small mb-3">
                            <i class="bi bi-calendar me-2"></i>
                            15 Mei 2026
                        </p>
                        <p class="text-muted small mb-4">Festival musik metal terbesar di Asia Tenggara kembali hadir di Jakarta...</p>
                        <Link class="btn btn-outline-primary btn-sm" :href="events.show(1)">Lihat Detail</Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import events from '@/routes/events'
import { Link } from '@inertiajs/vue3'
</script>
