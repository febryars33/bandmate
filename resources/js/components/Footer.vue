<template>
    <footer class="border-top py-5 mt-5">
        <div class="container">
            <div class="row gy-4">
                <!-- Brand Section -->
                <div class="col-lg-4">
                    <img src="../../img/logoipsum.svg" width="80" alt="Logo" class="mb-3" />
                    <p class="text-muted small pe-lg-5">
                        Platform kolaborasi musisi terbesar di Indonesia. Hubungkan bakatmu dengan band dan proyek musik impian.
                    </p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-muted fs-5"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-muted fs-5"><i class="bi bi-tiktok"></i></a>
                        <a href="#" class="text-muted fs-5"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-6 col-lg-2 ms-auto">
                    <h6 class="fw-bold mb-3">Eksplorasi</h6>
                    <ul class="list-unstyled d-grid gap-2">
                        <li><Link :href="index()" class="text-decoration-none text-muted small hover-primary">Cari Band</Link></li>
                        <li><a href="#" class="text-decoration-none text-muted small hover-primary">Lowongan Musisi</a></li>
                        <li><a href="#" class="text-decoration-none text-muted small hover-primary">Event Musik</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div class="col-6 col-lg-2">
                    <h6 class="fw-bold mb-3">Bantuan</h6>
                    <ul class="list-unstyled d-grid gap-2">
                        <li><a href="#" class="text-decoration-none text-muted small hover-primary">Tentang Kami</a></li>
                        <li><a href="#" class="text-decoration-none text-muted small hover-primary">FAQ</a></li>
                        <li><a href="#" class="text-decoration-none text-muted small hover-primary">Kontak</a></li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="border-top mt-5 pt-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <p class="text-muted small mb-0">&copy; {{ new Date().getFullYear() }} {{ $page.props.name }}. All rights reserved.</p>
                <div class="d-flex gap-4">
                    <a href="#" class="text-decoration-none text-muted x-small">Privacy Policy</a>
                    <a href="#" class="text-decoration-none text-muted x-small">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup lang="ts">
import { index } from '@/routes/artists'
import { Link } from '@inertiajs/vue3'
</script>
