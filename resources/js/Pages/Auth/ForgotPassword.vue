<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta name="description" :content="meta.description" />
    </Head>

    <!-- Header -->
    <div class="auth-header">
        <div>
            <h3 class="auth-title">Lupa Password</h3>
            <p class="auth-sub">Kami akan kirimkan tautan reset ke email Anda</p>
        </div>
        <Link :href="login()" class="btn-back">
            <i class="bi bi-arrow-left" />
            Masuk
        </Link>
    </div>

    <!-- Status -->
    <div v-if="status" class="alert alert-success d-flex align-items-center gap-2 mb-3 py-2 px-3" role="alert">
        <i class="bi bi-check-circle-fill flex-shrink-0" />
        <small>{{ status }}</small>
    </div>

    <!-- Form -->
    <form class="auth-form" @submit.prevent="submit" novalidate>
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
                    autofocus
                    :aria-invalid="!!form.errors.email"
                    :aria-describedby="form.errors.email ? 'email-err' : undefined"
                />
            </div>
            <span v-if="form.errors.email" id="email-err" class="field-error" role="alert">
                {{ form.errors.email }}
            </span>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-submit" :disabled="form.processing">
            <span v-if="form.processing" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" />
            {{ form.processing ? 'Mengirim...' : 'Kirim Tautan Reset' }}
        </button>
    </form>

    <p class="login-register">
        Ingat password Anda?
        <Link :href="login()" class="register-link">Kembali Masuk</Link>
    </p>
</template>

<script lang="ts" setup>
import AuthLayout from '@/layouts/auth.vue'
import { login } from '@/routes'
import { Head, Link, useForm } from '@inertiajs/vue3'

defineOptions({ layout: AuthLayout })

defineProps<{
    meta: { title: string; description: string }
    status: string | null
}>()

const form = useForm({ email: '' })

const submit = () => {
    form.post('/forgot-password', { preserveScroll: true })
}
</script>
