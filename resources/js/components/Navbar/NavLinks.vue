<template>
    <ul class="navbar-nav flex-grow-1 align-items-lg-center gap-1">
        <li v-for="item in links" :key="item.label" class="nav-item">
            <Link class="nav-link nav-pill" :class="{ active: item.active }" :href="item.href" preserve-scroll preserve-state>
                {{ item.label }}
            </Link>
        </li>

        <!-- Dropdown placeholder, dapat di-extend -->
        <li class="nav-item dropdown">
            <a class="nav-link nav-pill dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"> Jelajahi </a>
            <ul class="dropdown-menu dropdown-menu-animated">
                <li><a class="dropdown-item" href="#">Tentang Kami</a></li>
                <li><a class="dropdown-item" href="#">Event</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="#">Kontak</a></li>
            </ul>
        </li>
    </ul>
</template>

<script lang="ts" setup>
import { home } from '@/routes'
import { index } from '@/routes/artists'
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()

const links = computed(() => [
    {
        label: 'Beranda',
        href: home(),
        active: page.component === 'Home',
    },
    {
        label: 'Band',
        href: index(),
        active: page.component.startsWith('Artist'),
    },
])
</script>
