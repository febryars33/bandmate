<template>
    <Head :title="title" />
    <div class="min-vh-100 d-flex align-items-center justify-content-center position-relative overflow-hidden">
        <!-- Dekorasi Blob seperti di Hero -->
        <div class="hero-blob hero-blob-1" style="opacity: 0.05"></div>

        <div class="container text-center position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="mb-4">
                        <div class="icon-wrapper position-relative d-inline-block">
                            <i class="bi bi-music-note-beamed display-1 text-muted opacity-25"></i>
                            <i class="bi bi-heartbreak-fill position-absolute top-50 start-50 translate-middle text-primary fs-1 animate-pulse"></i>
                        </div>
                    </div>
                    <h1 class="display-1 fw-black text-gradient mb-0 animate-up">{{ status }}</h1>
                    <h2 class="fw-bold mb-3">{{ title }}</h2>
                    <p class="lead text-muted mb-5 px-lg-5">
                        {{ description }}
                    </p>

                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                        <Link :href="home()" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">
                            <i class="bi bi-house-door me-2"></i> Kembali ke Beranda
                        </Link>
                        <button @click="back" class="btn btn-outline-primary btn-lg rounded-pill px-5">
                            <i class="bi bi-arrow-left me-2"></i> Halaman Sebelumnya
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.icon-wrapper {
    .bi-music-note-beamed {
        display: block;
        transform: rotate(-15deg);
        filter: blur(1px);
    }
}

.animate-pulse {
    animation: heart-pulse 2s infinite;
}

@keyframes heart-pulse {
    0% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.8;
    }
    50% {
        transform: translate(-50%, -50%) scale(1.2);
        opacity: 1;
    }
    100% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.8;
    }
}

.animate-up {
    animation: slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script setup lang="ts">
import { home } from '@/routes'
import { Head, Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps<{ status: number }>()

const back = () => window.history.back()

const title = computed(() => {
    return (
        {
            404: 'Halaman Tidak Ditemukan',
            403: 'Akses Dilarang',
            500: 'Kesalahan Server',
            503: 'Layanan Tidak Tersedia',
        }[props.status] || 'Terjadi Kesalahan'
    )
})

const description = computed(() => {
    return (
        {
            404: 'Maaf, band atau halaman yang kamu cari mungkin sudah pindah panggung atau bubar.',
            403: 'Ups! Kamu tidak punya tiket (izin) untuk masuk ke area ini.',
            500: 'Sound system kami bermasalah. Tim teknis sedang memperbaikinya.',
            503: 'Kami sedang melakukan check-sound (maintenance). Tunggu sebentar ya!',
        }[props.status] || 'Sesuatu yang tidak terduga telah terjadi.'
    )
})
</script>

<style scoped>
.fw-black {
    font-weight: 900;
    font-size: 8rem;
}
.text-gradient {
    background: linear-gradient(45deg, var(--bs-primary), #6f42c1);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
</style>
