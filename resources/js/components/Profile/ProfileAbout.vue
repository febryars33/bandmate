<template>
    <div class="profile-card profile-animate mb-4 about-card">
        <div class="d-flex justify-content-between mb-2">
            <p class="section-label m-0">Tentang</p>
            <button
                v-if="username === $page.props.auth.user.username"
                type="button"
                class="btn btn-sm btn-primary"
                @click="toggle = !toggle"
                :class="{ active: toggle }"
            >
                <i class="bi bi-pencil" />
            </button>
        </div>

        <template v-if="!toggle">
            <p v-if="musician.about" class="about-text">
                <SafeHtml :content="musician.about" />
            </p>

            <div v-else class="about-empty">
                <i class="bi bi-pencil empty-icon" />
                <span>Belum ada tentang yang ditambahkan.</span>
            </div>
        </template>
        <template v-if="username === $page.props.auth.user.username">
            <form v-if="toggle" @submit.prevent="check">
                <Editor v-model="form.fields.about" class="mb-2" />

                <button type="submit" class="btn btn-sm btn-primary me-2" :disabled="form.processing">
                    <span v-if="form.processing" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" />
                    Simpan
                </button>
                <button type="button" class="btn btn-sm btn-secondary" @click="toggle = !toggle">Batal</button>
            </form>
        </template>
    </div>
</template>

<script lang="ts" setup>
import { update } from '@/routes/profile'
import type { Musician } from '@/types/models/musician'
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import SafeHtml from '../SafeHtml.vue'
import Editor from '../TipTap/Editor.vue'

const props = defineProps<{
    about: string | null
    musician: Musician
    username: string
}>()

const form = useForm({
    _patch: true,
    fields: {
        about: props.musician.about,
    },
})

const toggle = ref(false)

const check = () => {
    // console.log(form.content)
    form.patch(update(props.username).url, {
        preserveScroll: true,
        onSuccess: () => {
            toggle.value = false
        },
    })
}

const cancel = () => {
    toggle.value = false
    form.reset()
}
</script>

<style scoped>
.about-card {
    padding: 1.5rem;
}

.about-text {
    font-size: 0.9rem;
    color: var(--bs-body-color);
    line-height: 1.75;
    margin: 0;
}

.about-empty {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    color: var(--bs-secondary-color);
}

.empty-icon {
    color: var(--bs-secondary-color);
    opacity: 0.5;
    flex-shrink: 0;
}
</style>
