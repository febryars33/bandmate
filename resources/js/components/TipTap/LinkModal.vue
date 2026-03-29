<template>
    <!-- Bootstrap Modal (no JS dependency, controlled by Vue) -->
    <Teleport to="body">
        <div
            v-if="visible"
            class="modal d-block"
            tabindex="-1"
            role="dialog"
            aria-modal="true"
            aria-labelledby="linkModalLabel"
            @keydown.esc="onCancel"
            @click.self="onCancel"
        >
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content shadow">
                    <!-- Header -->
                    <div class="modal-header py-2">
                        <h6 class="modal-title" id="linkModalLabel">
                            <i class="bi bi-link-45deg me-1"></i>
                            Tambah Link
                        </h6>
                        <button type="button" class="btn-close btn-sm" aria-label="Tutup" @click="onCancel" />
                    </div>

                    <!-- Body -->
                    <div class="modal-body">
                        <label for="linkUrl" class="form-label small fw-semibold"> URL </label>
                        <input
                            id="linkUrl"
                            ref="inputRef"
                            v-model="localUrl"
                            type="url"
                            class="form-control form-control-sm"
                            :class="{ 'is-invalid': showError }"
                            placeholder="https://contoh.com"
                            autocomplete="off"
                            @keydown.enter.prevent="onConfirm"
                        />
                        <div v-if="showError" class="invalid-feedback">Masukkan URL yang valid (diawali https://)</div>
                    </div>

                    <!-- Footer -->
                    <div class="modal-footer py-2 gap-2">
                        <!-- Tombol hapus link — hanya muncul jika sudah ada link -->
                        <button v-if="currentUrl" type="button" class="btn btn-sm btn-outline-danger me-auto" @click="onRemove">
                            <i class="bi bi-trash3 me-1"></i>Hapus
                        </button>

                        <button type="button" class="btn btn-sm btn-outline-secondary" @click="onCancel">Batal</button>

                        <button type="button" class="btn btn-sm btn-primary" @click="onConfirm">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Backdrop -->
        <div v-if="visible" class="modal-backdrop fade show" />
    </Teleport>
</template>

<script setup>
import { nextTick, ref, watch } from 'vue'

// ─── Props & Emits ────────────────────────────────────────────────────────────
const props = defineProps({
    visible: {
        type: Boolean,
        default: false,
    },
    currentUrl: {
        type: String,
        default: '',
    },
})

const emit = defineEmits(['update:visible', 'confirm', 'remove'])

// ─── State ────────────────────────────────────────────────────────────────────
const localUrl = ref('')
const showError = ref(false)
const inputRef = ref(null)

// Sync URL saat modal dibuka
watch(
    () => props.visible,
    async (isVisible) => {
        if (isVisible) {
            localUrl.value = props.currentUrl
            showError.value = false
            await nextTick()
            inputRef.value?.focus()
        }
    },
)

// ─── Validation ───────────────────────────────────────────────────────────────
function isValidUrl(url) {
    try {
        const parsed = new URL(url)
        return ['http:', 'https:', 'mailto:'].includes(parsed.protocol)
    } catch {
        return false
    }
}

// ─── Actions ──────────────────────────────────────────────────────────────────
function onConfirm() {
    const trimmed = localUrl.value.trim()

    if (!isValidUrl(trimmed)) {
        showError.value = true
        return
    }

    emit('confirm', trimmed)
    emit('update:visible', false)
}

function onRemove() {
    emit('remove')
    emit('update:visible', false)
}

function onCancel() {
    showError.value = false
    emit('update:visible', false)
}
</script>
