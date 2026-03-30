<template>
    <div class="profile-card profile-animate p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <p class="section-label m-0">Tentang</p>
            <button
                v-if="isOwner"
                type="button"
                class="btn btn-sm btn-secondary rounded-circle d-inline-flex align-items-center justify-content-center"
                style="width: 35px; height: 35px"
                :class="{ active: toggle }"
                @click="toggle = !toggle"
            >
                <i class="bi bi-pencil" />
            </button>
        </div>

        <template v-if="!toggle">
            <p v-if="musician.about" class="small text-body lh-lg m-0 about-text">
                <SafeHtml :content="musician.about" />
            </p>

            <div v-else class="d-flex align-items-center gap-2 small text-muted">
                <i class="bi bi-pencil text-muted opacity-50 flex-shrink-0" />
                <span>Belum ada tentang yang ditambahkan.</span>
            </div>
        </template>

        <form v-if="isOwner && toggle" @submit.prevent="save">
            <Editor v-model="form.fields.about" class="mb-2" />

            <button type="submit" class="btn btn-sm btn-primary me-2" :disabled="form.processing">
                <span v-if="form.processing" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" />
                Simpan
            </button>
            <button type="button" class="btn btn-sm btn-secondary" @click="cancel">Batal</button>
        </form>
    </div>
</template>

<script lang="ts" setup>
import { useAuth } from '@/composables/useAuth'
import { update } from '@/routes/profile'
import type { Musician } from '@/types/models/musician'
import { useForm } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import SafeHtml from '../SafeHtml.vue'
import Editor from '../TipTap/Editor.vue'

const props = defineProps<{
    musician: Musician
    username: string
}>()

const auth = useAuth()

const isOwner = computed(() => auth.check() && props.username === auth.user.value.username)

const toggle = ref(false)

const form = useForm({
    _patch: true,
    fields: {
        about: props.musician.about,
    },
})

const save = () => {
    form.patch(update(props.username).url, {
        preserveScroll: true,
        onSuccess: () => (toggle.value = false),
    })
}

const cancel = () => {
    toggle.value = false
    form.reset()
}
</script>

<style scoped>
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
</style>
