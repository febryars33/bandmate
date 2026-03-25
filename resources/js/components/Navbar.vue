<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <Link class="navbar-brand" :href="home()" preserve-scroll preserve-state>
                <img src="../../img/logoipsum.svg" width="75px" alt="Logo" />
            </Link>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                        <img src="../../img/logoipsum.svg" width="75px" alt="Logo" />
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-start flex-grow-1 align-items-lg-center">
                        <li class="nav-item">
                            <Link class="nav-link" :class="{ active: $page.component === 'Home' }" :href="home()" preserve-scroll preserve-state>
                                Home
                            </Link>
                        </li>
                        <li class="nav-item">
                            <Link
                                class="nav-link"
                                :class="{ active: $page.component.startsWith('Artist') }"
                                :href="index()"
                                preserve-scroll
                                preserve-state
                            >
                                Band
                            </Link>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"> Dropdown </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- <ul class="navbar-nav justify-content-end flex-grow-1">
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Login </a>
                            </li>
                        </ul> -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <!-- Toggle User dengan Hover Effect & No Caret (Panah) -->
                            <a
                                class="nav-link d-flex align-items-center gap-2 py-1 px-2 rounded-pill hover-bg-light"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <div class="position-relative">
                                    <img
                                        src="https://placehold.co/250x250"
                                        alt="User"
                                        class="rounded-circle border border-2 border-white shadow-sm"
                                        width="35"
                                        height="35"
                                    />
                                    <!-- Indikator Online (Opsional) -->
                                    <span class="position-absolute bottom-0 end-0 badge border border-light rounded-circle bg-success p-1">
                                        <span class="visually-hidden">Online</span>
                                    </span>
                                </div>
                                <div class="d-none d-lg-block me-1">
                                    <div class="fw-bold small lh-1">Username</div>
                                    <small class="text-muted x-small">Musisi Verifikasi</small>
                                </div>
                            </a>

                            <!-- Dropdown Menu yang Lebih Kaya Fitur -->
                            <div
                                class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-3 py-2 px-2 dropdown-user"
                                style="min-width: 240px; border-radius: 16px"
                            >
                                <div class="px-3 py-2 mb-1">
                                    <h6 class="mb-0 fw-bold">Halo, Username!</h6>
                                    <p class="text-muted x-small mb-0 text-truncate">user@example.com</p>
                                </div>

                                <li><hr class="dropdown-divider mx-2 opacity-50" /></li>

                                <li>
                                    <!-- Tambahkan class 'rounded-3' agar saat hover, kotaknya melengkung rapi -->
                                    <a class="dropdown-item d-flex align-items-center gap-3 py-2 px-3 rounded-3 dropdown-item-primary" href="#">
                                        <div
                                            class="bg-primary-subtle p-2 rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 35px; height: 35px"
                                        >
                                            <i class="bi bi-person-circle text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-medium lh-1 mb-1">Profil Saya</div>
                                            <div class="text-muted x-small">Atur info band & personel</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <!-- Tambahkan class 'rounded-3' agar saat hover, kotaknya melengkung rapi -->
                                    <a class="dropdown-item d-flex align-items-center gap-3 py-2 px-3 rounded-3 dropdown-item-info" href="#">
                                        <div
                                            class="bg-info-subtle p-2 rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 35px; height: 35px"
                                        >
                                            <i class="bi bi-megaphone text-info"></i>
                                        </div>
                                        <div>
                                            <div class="fw-medium lh-1 mb-1">Lowongan Anda</div>
                                            <div class="text-muted x-small">Pantau pelamar band</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <!-- Tambahkan class 'rounded-3' agar saat hover, kotaknya melengkung rapi -->
                                    <a class="dropdown-item d-flex align-items-center gap-3 py-2 px-3 rounded-3 dropdown-item-warning" href="#">
                                        <div
                                            class="bg-warning-subtle p-2 rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 35px; height: 35px"
                                        >
                                            <i class="bi bi-gear text-warning"></i>
                                        </div>
                                        <div>
                                            <div class="fw-medium lh-1 mb-1">Pengaturan Akun</div>
                                            <div class="text-muted x-small">Atur info band & personel</div>
                                        </div>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider opacity-50" /></li>
                                <li>
                                    <!-- Tambahkan class 'rounded-3' agar saat hover, kotaknya melengkung rapi -->
                                    <a class="dropdown-item d-flex align-items-center gap-3 py-2 px-3 rounded-3 dropdown-item-danger" href="#">
                                        <div
                                            class="bg-danger-subtle p-2 rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 35px; height: 35px"
                                        >
                                            <i class="bi bi-box-arrow-right text-danger"></i>
                                        </div>
                                        <div>
                                            <div class="fw-medium lh-1 mb-1">Keluar</div>
                                        </div>
                                    </a>
                                </li>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>

<script lang="ts" setup>
import { home } from '@/routes'
import { index } from '@/routes/artists'
import { Link, router } from '@inertiajs/vue3'

const logout = () => {
    router.flushAll()
    router.post('/logout')
}
</script>
