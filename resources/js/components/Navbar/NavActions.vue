<template>
    <ul class="navbar-nav align-items-lg-center gap-2">
        <li class="nav-item">
            <ThemeToggle :mode="mode" @toggle="toggle" />
        </li>

        <template v-if="user">
            <UserDropdown />
        </template>
        <template v-else>
            <li class="nav-item">
                <Link :href="login()" class="btn btn-ghost-primary fw-semibold px-4"> Masuk </Link>
            </li>
            <li class="nav-item">
                <Link :href="register()" class="btn btn-primary-gradient fw-semibold px-4"> Daftar </Link>
            </li>
        </template>
    </ul>
</template>

<script lang="ts" setup>
import { useTheme } from '@/composables/useTheme'
import { login, register } from '@/routes'
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import ThemeToggle from './ThemeToggle.vue'
import UserDropdown from './UserDropdown.vue'

const { mode, toggle } = useTheme()
const page = usePage()
const user = computed(() => page.props.auth?.user)
</script>
