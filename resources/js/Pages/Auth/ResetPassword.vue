<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta name="description" :content="meta.description" />
    </Head>

    <!-- Header -->
    <div class="auth-header">
        <div>
            <h3 class="auth-title">Reset Password</h3>
            <p class="auth-sub">Buat password baru untuk akun Anda</p>
        </div>
        <Link :href="login()" class="btn-back">
            <i class="bi bi-arrow-left" />
            Masuk
        </Link>
    </div>

    <!-- Form -->
    <form class="auth-form" @submit.prevent="submit" novalidate>
        <!-- Password -->
        <div class="field" :class="{ 'field--error': form.errors.password }">
            <label for="password" class="field-label">Password Baru</label>
            <div class="field-input-wrap">
                <i class="bi bi-lock field-icon" />
                <input
                    id="password"
                    v-model="form.password"
                    :type="showPwd ? 'text' : 'password'"
                    class="field-input"
                    placeholder="••••••••"
                    autocomplete="new-password"
                    autofocus
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
            <label for="password_confirmation" class="field-label">Konfirmasi Password Baru</label>
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
                    :aria-label="showPwdConfirm ? 'Sembunyikan konfirmasi' : 'Tampilkan konfirmasi'"
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
            {{ form.processing ? 'Memproses...' : 'Simpan Password Baru' }}
        </button>
    </form>
</template>

<script lang="ts" setup>
import { useToast } from '@/composables/bootstrap/useToast'
import AuthLayout from '@/layouts/auth.vue'
import { login } from '@/routes'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

defineOptions({ layout: AuthLayout })

const props = defineProps<{
    meta: { title: string; description: string }
    token: string
    email: string
}>()

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
})

const showPwd = ref(false)
const showPwdConfirm = ref(false)
const { show } = useToast()

const submit = () => {
    form.post('/reset-password', {
        preserveScroll: true,
        onSuccess: () => {
            show({
                title: 'Password berhasil diubah!',
                message: 'Silakan masuk dengan password baru Anda.',
                variant: 'success',
            })
        },
        onError: (errors) => {
            const isValidation = ['password', 'password_confirmation', 'email', 'token'].some((k) => k in errors)
            if (!isValidation) {
                show({
                    title: 'Terjadi kesalahan',
                    message: 'Silakan coba beberapa saat lagi.',
                    variant: 'danger',
                })
            }
            form.reset('password', 'password_confirmation')
        },
    })
}
</script>
