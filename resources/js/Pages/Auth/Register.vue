<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta name="description" :content="meta.description" />
    </Head>

    <!-- Header -->
    <div class="auth-header">
        <div>
            <h3 class="auth-title">Daftar</h3>
            <p class="auth-sub">Bergabung dengan komunitas musisi Indonesia 🎸</p>
        </div>
        <Link :href="home()" class="btn-back">
            <i class="bi bi-arrow-left" />
            Beranda
        </Link>
    </div>

    <!-- Form -->
    <form class="auth-form" @submit.prevent="submit" novalidate>
        <!-- Name -->
        <div class="field" :class="{ 'field--error': form.errors.name }">
            <label for="name" class="field-label">Nama Lengkap</label>
            <div class="field-input-wrap">
                <i class="bi bi-person field-icon" />
                <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="field-input"
                    placeholder="Nama Anda"
                    autocomplete="name"
                    autofocus
                    :aria-invalid="!!form.errors.name"
                    :aria-describedby="form.errors.name ? 'name-err' : undefined"
                />
            </div>
            <span v-if="form.errors.name" id="name-err" class="field-error" role="alert">
                {{ form.errors.name }}
            </span>
        </div>

        <!-- Username -->
        <div class="field" :class="{ 'field--error': form.errors.username }">
            <label for="username" class="field-label">Username</label>
            <div class="field-input-wrap">
                <i class="bi bi-envelope field-icon" />
                <input
                    id="username"
                    v-model="form.username"
                    type="username"
                    class="field-input"
                    placeholder="john"
                    autocomplete="username"
                    :aria-invalid="!!form.errors.username"
                    :aria-describedby="form.errors.username ? 'username-err' : undefined"
                />
            </div>
            <span v-if="form.errors.username" id="username-err" class="field-error" role="alert">
                {{ form.errors.username }}
            </span>
        </div>

        <!-- Email -->
        <div class="field" :class="{ 'field--error': form.errors.email }">
            <label for="email" class="field-label">Email</label>
            <div class="field-input-wrap">
                <i class="bi bi-envelope field-icon" />
                <input
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="field-input"
                    placeholder="nama@email.com"
                    autocomplete="email"
                    :aria-invalid="!!form.errors.email"
                    :aria-describedby="form.errors.email ? 'email-err' : undefined"
                />
            </div>
            <span v-if="form.errors.email" id="email-err" class="field-error" role="alert">
                {{ form.errors.email }}
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
                    autocomplete="new-password"
                    :aria-invalid="!!form.errors.password"
                    :aria-describedby="form.errors.password ? 'pwd-err' : undefined"
                />
                <button
                    type="button"
                    class="field-pwd-toggle"
                    @click="showPwd = !showPwd"
                    :aria-label="showPwd ? 'Sembunyikan password' : 'Tampilkan password'"
                >
                    <i :class="showPwd ? 'bi bi-eye-slash' : 'bi bi-eye'" />
                </button>
            </div>
            <span v-if="form.errors.password" id="pwd-err" class="field-error" role="alert">
                {{ form.errors.password }}
            </span>
        </div>

        <!-- Confirm Password -->
        <div class="field" :class="{ 'field--error': form.errors.password_confirmation }">
            <label for="password_confirmation" class="field-label">Konfirmasi Password</label>
            <div class="field-input-wrap">
                <i class="bi bi-shield-lock field-icon" />
                <input
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    :type="showPwdConfirm ? 'text' : 'password'"
                    class="field-input"
                    placeholder="••••••••"
                    autocomplete="new-password"
                    :aria-invalid="!!form.errors.password_confirmation"
                    :aria-describedby="form.errors.password_confirmation ? 'pwd-confirm-err' : undefined"
                />
                <button
                    type="button"
                    class="field-pwd-toggle"
                    @click="showPwdConfirm = !showPwdConfirm"
                    :aria-label="showPwdConfirm ? 'Sembunyikan konfirmasi password' : 'Tampilkan konfirmasi password'"
                >
                    <i :class="showPwdConfirm ? 'bi bi-eye-slash' : 'bi bi-eye'" />
                </button>
            </div>
            <span v-if="form.errors.password_confirmation" id="pwd-confirm-err" class="field-error" role="alert">
                {{ form.errors.password_confirmation }}
            </span>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-submit" :disabled="form.processing">
            <span v-if="form.processing" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" />
            {{ form.processing ? 'Memproses...' : 'Buat Akun' }}
        </button>
    </form>

    <!-- Login link -->
    <p class="login-register">
        Sudah punya akun?
        <Link :href="login()" class="register-link">Masuk Sekarang</Link>
    </p>
</template>

<script lang="ts" setup>
import { useToast } from '@/composables/bootstrap/useToast'
import AuthLayout from '@/layouts/auth.vue'
import { home, login } from '@/routes'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

defineOptions({ layout: AuthLayout })

defineProps<{
    meta: { title: string; description: string }
}>()

const form = useForm({
    username: '',
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
})

const showPwd = ref(false)
const showPwdConfirm = ref(false)
const { show } = useToast()

const submit = () => {
    form.post('/register', {
        preserveScroll: true,
        onSuccess: () => {
            show({
                title: 'Akun berhasil dibuat!',
                message: 'Selamat bergabung di BandMate 🎸',
                variant: 'success',
            })
        },
        // onError: (errors) => {
        //     const isValidation = ['name', 'email', 'password', 'password_confirmation'].some((k) => k in errors)
        //     if (!isValidation) {
        //         show({
        //             title: 'Terjadi kesalahan',
        //             message: 'Silakan coba beberapa saat lagi.',
        //             variant: 'danger',
        //         })
        //     }
        // },
    })
}
</script>
