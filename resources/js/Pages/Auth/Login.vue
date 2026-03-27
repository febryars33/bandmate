<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta name="description" :content="meta.description" />
    </Head>

    <!-- Header -->
    <div class="login-header">
        <div>
            <h3 class="login-title">Masuk</h3>
            <p class="login-sub">Selamat datang kembali 👋</p>
        </div>
        <Link :href="home()" class="btn-back">
            <svg viewBox="0 0 16 16" fill="currentColor" width="14" height="14">
                <path
                    fill-rule="evenodd"
                    d="M14 8a.75.75 0 01-.75.75H4.56l3.22 3.22a.75.75 0 11-1.06 1.06l-4.5-4.5a.75.75 0 010-1.06l4.5-4.5a.75.75 0 011.06 1.06L4.56 7.25h8.69A.75.75 0 0114 8z"
                    clip-rule="evenodd"
                />
            </svg>
            Beranda
        </Link>
    </div>

    <!-- Form -->
    <form class="login-form" @submit.prevent="submit" novalidate>
        <!-- Email -->
        <div class="field" :class="{ 'field--error': form.errors.email }">
            <label for="email" class="field-label">Email</label>
            <div class="field-input-wrap">
                <svg class="field-icon" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                    <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                    <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                </svg>
                <input
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="field-input"
                    placeholder="nama@email.com"
                    autocomplete="email"
                    autofocus
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
                <svg class="field-icon" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                    <path
                        fill-rule="evenodd"
                        d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                        clip-rule="evenodd"
                    />
                </svg>
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
        <div class="login-row">
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
        <Link href="/register" class="register-link">Daftar Sekarang</Link>
    </p>
</template>

<script lang="ts" setup>
import { useToast } from '@/composables/bootstrap/useToast'
import AuthLayout from '@/layouts/auth.vue'
import { home } from '@/routes'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

defineOptions({ layout: AuthLayout })

defineProps<{
    meta: { title: string; description: string }
}>()

const form = useForm({
    email: '',
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

<style scoped>
/* ── Header ── */
.login-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.75rem;
    gap: 1rem;
}

.login-title {
    font-size: 1.5rem;
    font-weight: 700;
    letter-spacing: -0.02em;
    margin: 0 0 0.25rem;
    color: var(--bs-body-color);
}

.login-sub {
    margin: 0;
    font-size: 0.875rem;
    color: var(--bs-secondary-color);
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    font-size: 0.8125rem;
    font-weight: 500;
    color: var(--bs-secondary-color);
    text-decoration: none;
    padding: 0.375rem 0.75rem;
    border-radius: 8px;
    border: 1px solid rgba(var(--bs-body-color-rgb), 0.12);
    transition: all 0.15s ease;
    white-space: nowrap;
    flex-shrink: 0;
}

.btn-back:hover {
    color: var(--bs-body-color);
    border-color: rgba(var(--bs-body-color-rgb), 0.24);
    background: rgba(var(--bs-body-color-rgb), 0.04);
}

/* ── Form ── */
.login-form {
    display: flex;
    flex-direction: column;
    gap: 1.125rem;
}

/* ── Field ── */
.field {
    display: flex;
    flex-direction: column;
    gap: 0.375rem;
}

.field-label {
    font-size: 0.8125rem;
    font-weight: 600;
    color: var(--bs-body-color);
    letter-spacing: 0.01em;
}

.field-input-wrap {
    position: relative;
    display: flex;
    align-items: center;
}

.field-icon {
    position: absolute;
    left: 0.75rem;
    color: var(--bs-secondary-color);
    pointer-events: none;
    flex-shrink: 0;
}

.field-input {
    width: 100%;
    padding: 0.65rem 0.875rem 0.65rem 2.5rem;
    font-size: 0.9rem;
    border: 1.5px solid rgba(var(--bs-body-color-rgb), 0.15);
    border-radius: 10px;
    background: var(--bs-body-bg);
    color: var(--bs-body-color);
    transition:
        border-color 0.15s,
        box-shadow 0.15s;
    outline: none;
    -webkit-appearance: none;
}

.field-input::placeholder {
    color: var(--bs-secondary-color);
    opacity: 0.6;
}

.field-input:focus {
    border-color: var(--bs-primary);
    box-shadow: 0 0 0 3px rgba(var(--bs-primary-rgb), 0.12);
}

.field--error .field-input {
    border-color: var(--bs-danger);
}
.field--error .field-input:focus {
    box-shadow: 0 0 0 3px rgba(var(--bs-danger-rgb), 0.12);
}

.field-pwd-toggle {
    position: absolute;
    right: 0.75rem;
    background: none;
    border: none;
    color: var(--bs-secondary-color);
    cursor: pointer;
    padding: 0;
    line-height: 1;
    transition: color 0.15s;
}
.field-pwd-toggle:hover {
    color: var(--bs-body-color);
}

.field-error {
    font-size: 0.775rem;
    color: var(--bs-danger);
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

/* ── Row (remember + forgot) ── */
.login-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: -0.25rem;
}

/* Custom checkbox */
.check-label {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    user-select: none;
}

.check-input {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.check-box {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
    border: 1.5px solid rgba(var(--bs-body-color-rgb), 0.25);
    border-radius: 4px;
    background: var(--bs-body-bg);
    transition: all 0.15s;
    position: relative;
}

.check-input:checked + .check-box {
    background: var(--bs-primary);
    border-color: var(--bs-primary);
}

.check-input:checked + .check-box::after {
    content: '';
    position: absolute;
    left: 4px;
    top: 1.5px;
    width: 5px;
    height: 9px;
    border: 1.5px solid #fff;
    border-top: none;
    border-left: none;
    transform: rotate(45deg);
}

.check-input:focus-visible + .check-box {
    box-shadow: 0 0 0 3px rgba(var(--bs-primary-rgb), 0.2);
}

.check-text {
    font-size: 0.8125rem;
    color: var(--bs-secondary-color);
}

.forgot-link {
    font-size: 0.8125rem;
    font-weight: 600;
    color: var(--bs-primary);
    text-decoration: none;
    transition: opacity 0.15s;
}
.forgot-link:hover {
    opacity: 0.8;
}

/* ── Submit button ── */
.btn-submit {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
    padding: 0.75rem;
    font-size: 0.9375rem;
    font-weight: 600;
    color: #fff;
    background: var(--bs-primary);
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 2px 12px rgba(var(--bs-primary-rgb), 0.35);
    margin-top: 0.25rem;
}

.btn-submit:hover:not(:disabled) {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(var(--bs-primary-rgb), 0.45);
}

.btn-submit:active:not(:disabled) {
    transform: translateY(0);
}

.btn-submit:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

/* Spinner animation */
.spinner {
    animation: spin 0.8s linear infinite;
}
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

/* ── Register link ── */
.login-register {
    margin: 1.25rem 0 0;
    text-align: center;
    font-size: 0.8125rem;
    color: var(--bs-secondary-color);
}

.register-link {
    font-weight: 700;
    color: var(--bs-primary);
    text-decoration: none;
    transition: opacity 0.15s;
}
.register-link:hover {
    opacity: 0.8;
}
</style>
