<template>
    <li ref="dropdownRef" class="nav-item dropdown" :class="{ show: isOpen }">
        <a
            role="button"
            class="nav-link d-flex align-items-center gap-2 py-1 px-2 rounded-pill hover-bg-light"
            :aria-expanded="isOpen"
            @click.prevent="toggleDropdown"
        >
            <div class="position-relative">
                <img
                    :src="user.avatar || 'https://placehold.co/250x250'"
                    alt="User"
                    class="rounded-circle border border-2 border-white shadow-sm"
                    width="35"
                    height="35"
                />
                <span class="position-absolute bottom-0 end-0 badge border border-light rounded-circle bg-success p-1">
                    <span class="visually-hidden">Online</span>
                </span>
            </div>
            <div class="d-none d-lg-block me-1">
                <div class="fw-bold small lh-1">{{ user.name }}</div>
                <small class="text-muted x-small">@{{ user.username }}</small>
            </div>
        </a>

        <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-3 py-2 px-2 dropdown-user" :class="{ show: isOpen }">
            <div class="px-3 py-2">
                <h6 class="mb-0 fw-bold">Halo, {{ user.name }}!</h6>
                <p class="text-muted x-small mb-0 text-truncate">@{{ user.username }}</p>
            </div>

            <li><hr class="dropdown-divider mx-2 opacity-50" /></li>

            <li>
                <Link
                    :href="profileRoute"
                    class="dropdown-item d-flex align-items-center gap-3 py-2 px-3 rounded-3 dropdown-item-primary"
                    :class="{ 'text-primary': isActiveRoute(profileRoute) }"
                    @click="closeDropdown"
                >
                    <DropdownIcon variant="primary" icon="bi-person-circle" />
                    <div>
                        <div class="fw-bold lh-1 mb-1">Profil saya</div>
                        <div class="text-muted x-small">Atur info band & personel</div>
                    </div>
                </Link>
            </li>

            <li>
                <Link
                    :href="home()"
                    class="dropdown-item d-flex align-items-center gap-3 py-2 px-3 rounded-3 dropdown-item-info"
                    @click="closeDropdown"
                >
                    <DropdownIcon variant="info" icon="bi-megaphone" />
                    <div>
                        <div class="fw-bold lh-1 mb-1">Lowongan</div>
                        <div class="text-muted x-small">Pantau pelamar band</div>
                    </div>
                </Link>
            </li>

            <li>
                <Link
                    :href="home()"
                    class="dropdown-item d-flex align-items-center gap-3 py-2 px-3 rounded-3 dropdown-item-warning"
                    @click="closeDropdown"
                >
                    <DropdownIcon variant="warning" icon="bi-gear" />
                    <div>
                        <div class="fw-bold lh-1 mb-1">Pengaturan Akun</div>
                        <div class="text-muted x-small">Keamanan & privasi</div>
                    </div>
                </Link>
            </li>

            <li><hr class="dropdown-divider opacity-50" /></li>

            <li>
                <a role="button" class="dropdown-item d-flex align-items-center gap-3 py-2 px-3 rounded-3 dropdown-item-danger" @click="handleLogout">
                    <DropdownIcon variant="danger" icon="bi-box-arrow-right" />
                    <div class="fw-bold lh-1">Keluar</div>
                </a>
            </li>
        </div>
    </li>
</template>

<script setup lang="ts">
import { home, logout, profile } from '@/routes'
import { Link, router, usePage } from '@inertiajs/vue3'
import { useToast } from 'bootstrap-vue-next'
import { computed, defineComponent, h, onBeforeUnmount, onMounted, ref } from 'vue'

// ─── Sub-component ────────────────────────────────────────────────────────────

const DropdownIcon = defineComponent({
    props: {
        variant: { type: String, required: true },
        icon: { type: String, required: true },
    },
    setup(props) {
        return () => h('div', { class: `dropdown-icon bg-${props.variant}-subtle` }, [h('i', { class: `bi ${props.icon} text-${props.variant}` })])
    },
})

// ─── Auth ─────────────────────────────────────────────────────────────────────

const page = usePage()
const user = computed(() => page.props.auth.user)

// ─── Routes ───────────────────────────────────────────────────────────────────

const profileRoute = computed(() => profile(user.value.username))

const isActiveRoute = (route: { url: string }) => page.url === route.url

// ─── Dropdown State ───────────────────────────────────────────────────────────

const isOpen = ref(false)
const dropdownRef = ref<HTMLElement | null>(null)

const toggleDropdown = () => (isOpen.value = !isOpen.value)
const closeDropdown = () => (isOpen.value = false)

const handleClickOutside = (event: MouseEvent) => {
    if (dropdownRef.value && !dropdownRef.value.contains(event.target as Node)) {
        closeDropdown()
    }
}

onMounted(() => document.addEventListener('click', handleClickOutside))
onBeforeUnmount(() => document.removeEventListener('click', handleClickOutside))

// ─── Toast ────────────────────────────────────────────────────────────────────

const { create } = useToast()

// ─── Actions ──────────────────────────────────────────────────────────────────

const handleLogout = () => {
    closeDropdown()
    router.post(logout(), {}, { preserveScroll: true })
    create({
        props: {
            modelValue: 2000,
            body: 'Anda berhasil keluar.',
            variant: 'success',
            pos: 'bottom-center',
            noProgress: true,
            toastClass: 'mb-3',
            noCloseButton: true,
        },
    })
}
</script>

<style scoped>
.hover-bg-light:hover {
    background-color: var(--bs-body-bg);
    transition: background 0.2s ease;
}

.x-small {
    font-size: 0.75rem;
}

/* Menggantikan 4x inline style width/height: 35px */
.dropdown-icon {
    width: 35px;
    height: 35px;
    padding: 0.5rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.dropdown-menu {
    min-width: 240px;
    border-radius: 16px;
}
</style>
