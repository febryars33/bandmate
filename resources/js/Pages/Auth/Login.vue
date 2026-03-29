<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta name="description" :content="meta.description" />
    </Head>

    <!-- Header -->
    <div class="auth-header">
        <div>
            <h3 class="auth-title">Masuk</h3>
            <p class="auth-sub">Selamat datang kembali 👋</p>
        </div>
        <Link :href="home()" class="btn-back">
            <i class="bi bi-arrow-left" />
            Beranda
        </Link>
    </div>

    <!-- Form -->
    <form class="auth-form" @submit.prevent="submit" novalidate>
        <!-- Email -->
        <div class="field" :class="{ 'field--error': form.errors.username }">
            <label for="username" class="field-label">Email / Username</label>
            <div class="field-input-wrap">
                <i class="bi bi-envelope field-icon" />
                <input
                    id="text"
                    v-model="form.username"
                    type="username"
                    class="field-input"
                    placeholder="nama@email.com"
                    autocomplete="username"
                    autofocus
                    :aria-invalid="!!form.errors.username"
                    :aria-describedby="form.errors.username ? 'username-err' : undefined"
                />
            </div>
            <span v-if="form.errors.username" id="username-err" class="field-error" role="alert">
                {{ form.errors.username }}
            </span>
        </div>

        <!-- Password -->
        <div class="field" :class="{ 'field--error': form.errors.password }">
            <label for="password" class="field-label">Password</label>
            <div class="field-input-wrap">
                <i class="bi bi-lock field-icon" />
                <input
                    id="password"
                    v-model="form.password"
                    :type="showPwd ? 'text' : 'password'"
                    class="field-input"
                    placeholder="••••••••"
                    autocomplete="current-password"
                    :aria-invalid="!!form.errors.password"
                    :aria-describedby="form.errors.password ? 'pwd-err' : undefined"
                />
                <button
                    type="button"
                    class="field-pwd-toggle"
                    @click="showPwd = !showPwd"
                    :aria-label="showPwd ? 'Sembunyikan password' : 'Tampilkan password'"
                >
                    <svg v-if="!showPwd" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                        <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                        <path
                            fill-rule="evenodd"
                            d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    <svg v-else viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                        <path
                            fill-rule="evenodd"
                            d="M3.28 2.22a.75.75 0 00-1.06 1.06l14.5 14.5a.75.75 0 101.06-1.06l-1.745-1.745a10.029 10.029 0 003.3-4.38 1.651 1.651 0 000-1.185A10.004 10.004 0 009.999 3a9.956 9.956 0 00-4.744 1.194L3.28 2.22zM7.752 6.69l1.092 1.092a2.5 2.5 0 013.374 3.373l1.091 1.092a4 4 0 00-5.557-5.557z"
                            clip-rule="evenodd"
                        />
                        <path
                            d="M10.748 13.93l2.523 2.523a10.003 10.003 0 01-3.27.547c-4.258 0-7.894-2.66-9.337-6.41a1.651 1.651 0 010-1.186A10.007 10.007 0 012.839 6.02L6.07 9.252a4 4 0 004.678 4.678z"
                        />
                    </svg>
                </button>
            </div>
            <span v-if="form.errors.password" id="pwd-err" class="field-error" role="alert">
                {{ form.errors.password }}
            </span>
        </div>

        <!-- Remember + Forgot -->
        <div class="auth-row">
            <label class="check-label">
                <input type="checkbox" v-model="form.remember" class="check-input" />
                <span class="check-box" aria-hidden="true" />
                <span class="check-text">Ingat saya</span>
            </label>
            <Link href="/forgot-password" class="forgot-link">Lupa Password?</Link>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-submit" :disabled="form.processing">
            <svg v-if="form.processing" class="spinner" viewBox="0 0 24 24" fill="none" width="16" height="16">
                <circle
                    cx="12"
                    cy="12"
                    r="10"
                    stroke="currentColor"
                    stroke-width="3"
                    stroke-dasharray="32"
                    stroke-dashoffset="12"
                    stroke-linecap="round"
                />
            </svg>
            {{ form.processing ? 'Memproses...' : 'Masuk ke Akun' }}
        </button>
    </form>

    <!-- Register link -->
    <p class="login-register">
        Belum punya akun?
        <Link :href="register()" class="register-link">Daftar Sekarang</Link>
    </p>
</template>

<script lang="ts" setup>
import { useToast } from '@/composables/bootstrap/useToast'
import AuthLayout from '@/layouts/auth.vue'
import { home, register } from '@/routes'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

defineOptions({ layout: AuthLayout })

defineProps<{
    meta: { title: string; description: string }
}>()

const form = useForm({
    username: '',
    password: '',
    remember: false,
})

const showPwd = ref(false)
const { show } = useToast()

const submit = () => {
    form.post('/login', {
        preserveScroll: true,
        onSuccess: (page) => {
            const name = (page.props.auth as { user: { name: string } })?.user?.name
            show({
                title: 'Selamat datang!',
                message: name ? `Hai, ${name}!` : undefined,
                variant: 'success',
            })
        },
        onError: (errors) => {
            // Hanya tampilkan toast untuk error non-422 (bukan validasi field)
            const isValidationError = 'email' in errors || 'password' in errors
            if (!isValidationError) {
                show({
                    title: 'Terjadi kesalahan',
                    message: 'Silakan coba beberapa saat lagi.',
                    variant: 'danger',
                })
            }
        },
    })
}
</script>
