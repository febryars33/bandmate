<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-main fixed-top" :class="{ scrolled }">
        <div class="container">
            <!-- Brand -->
            <Link class="navbar-brand" :href="home()" preserve-scroll preserve-state>
                <img src="../../../img/logoipsum.svg" width="72" alt="BandMate" />
            </Link>

            <!-- Mobile toggler -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#navOffcanvas"
                aria-controls="navOffcanvas"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon" />
            </button>

            <!-- Nav body (offcanvas on mobile) -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="navOffcanvas" aria-labelledby="navOffcanvasLabel">
                <div class="offcanvas-header">
                    <span id="navOffcanvasLabel" class="offcanvas-title">
                        <img src="../../../img/logoipsum.svg" width="72" alt="BandMate" />
                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" />
                </div>

                <div class="offcanvas-body d-flex flex-column flex-lg-row align-items-lg-center gap-3">
                    <NavLinks />
                    <NavActions />
                </div>
            </div>
        </div>
    </nav>
</template>

<script lang="ts" setup>
import { home } from '@/routes'
import { Link } from '@inertiajs/vue3'
import { onMounted, onUnmounted, ref } from 'vue'
import NavActions from './NavActions.vue'
import NavLinks from './NavLinks.vue'
import './navbar.css'

const scrolled = ref(false)

const onScroll = () => {
    scrolled.value = window.scrollY > 12
}

onMounted(() => window.addEventListener('scroll', onScroll, { passive: true }))
onUnmounted(() => window.removeEventListener('scroll', onScroll))
</script>
