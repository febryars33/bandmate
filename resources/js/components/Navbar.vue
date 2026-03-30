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
                                Beranda
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
                    <ul class="navbar-nav justify-content-end align-items-lg-center gap-2">
                        <li class="nav-item">
                            <button
                                class="btn btn-link rounded-circle d-flex align-items-center justify-content-center shadow-none border-0"
                                @click="toggleTheme"
                                style="width: 40px; height: 40px; padding: 0"
                                aria-label="Toggle Theme"
                            >
                                <template v-if="activeTheme === 'dark'">
                                    <img src="https://img.icons8.com/color/48/sun--v1.png" alt="" class="img-fluid" width="32" />
                                </template>
                                <template v-else>
                                    <img src="https://img.icons8.com/color/48/moon-satellite.png" alt="" class="img-fluid" width="32" />
                                </template>
                            </button>
                        </li>

                        <template v-if="user">
                            <UserDropdown />
                        </template>
                        <template v-else>
                            <li class="nav-item">
                                <Link :href="login()" class="btn btn-outline-primary fw-medium px-4"> Sign In </Link>
                            </li>
                            <li class="nav-item">
                                <a role="button" class="btn btn-primary px-4"> Sign Up </a>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>

<style scoped>
.nav-link,
.btn {
    transition: all 0.2s ease-in-out;
}

.btn:hover {
    transform: translateY(-1px);
    shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}
</style>

<script lang="ts" setup>
import { home, login } from '@/routes'
import { index } from '@/routes/artists'
import Theme from '@/theme'
import { Link, router, usePage } from '@inertiajs/vue3'
import { computed, onMounted, ref } from 'vue'
import UserDropdown from './Navbar/UserDropdown.vue'

const page = usePage()
const user = computed(() => page.props.auth.user)

const logout = () => {
    router.flushAll()
    router.post('/logout')
}

const activeTheme = ref('light')

const toggleTheme = () => {
    activeTheme.value = activeTheme.value === 'dark' ? 'light' : 'dark'
    Theme.apply(activeTheme.value)
}

onMounted(() => {
    // Inisialisasi tema saat komponen dimuat
    activeTheme.value = Theme.init()
})
</script>
