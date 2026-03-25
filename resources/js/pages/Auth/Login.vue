<template>
    <div class="container">
        <BForm @submit.prevent="submit">
            <BFormGroup class="mb-3" id="input-group-1" label="Email address:" label-for="input-1">
                <BFormInput id="input-1" v-model="form.email" type="email" :class="{ 'is-invalid': form.errors.email }" />
                <BFormInvalidFeedback :state="!form.errors.email" :text="form.errors.email" />
            </BFormGroup>

            <BFormGroup class="mb-3" id="input-group-2" label="Password:" label-for="password">
                <BFormInput id="password" v-model="form.password" type="password" :class="{ 'is-invalid': form.errors.password }" />
                <BFormInvalidFeedback :state="!form.errors.password" :text="form.errors.password" />
            </BFormGroup>

            <div class="d-grid">
                <BButton type="submit" variant="primary" :disabled="form.processing">
                    <BSpinner v-if="form.processing" small />
                    {{ form.processing ? 'Loading...' : 'Login' }}
                </BButton>
            </div>
        </BForm>

        <Link href="/" class="link-primary text-decoration-none">Forgot password</Link>
    </div>
</template>

<script lang="ts" setup>
import index from '@/actions/App/Http/Controllers/HomeController'
import Auth from '@/layouts/auth.vue'
import { Link, router, useForm } from '@inertiajs/vue3'
import { useToast } from 'bootstrap-vue-next'

defineOptions({
    layout: Auth,
})

const form = useForm('post', '/login', {
    email: '',
    password: '',
})

const { create } = useToast()

const submit = () => {
    form.submit({
        onSuccess: () => {
            router.visit(index.url())
        },
        onError: () => {
            create({
                variant: 'danger',
                pos: 'bottom-center',
                body: 'Login gagal.',
                noProgress: true,
            })
        },
    })
}
</script>
