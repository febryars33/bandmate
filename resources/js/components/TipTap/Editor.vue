<template>
    <div class="tiptap-editor border rounded" :class="{ 'border-primary': isFocused }">
        <!-- Toolbar -->
        <Toolbar :editor="editor" />

        <!-- Editor Content -->
        <EditorContent :editor="editor" class="tiptap-content px-3 py-2" @focus="isFocused = true" @blur="isFocused = false" />

        <!-- Footer: character count -->
        <div class="px-3 py-1 border-top bg-body-tertiary rounded-bottom d-flex justify-content-end">
            <small class="text-body-secondary"> {{ characterCount }} / {{ maxLength }} karakter </small>
        </div>
    </div>
</template>

<script setup>
import CharacterCount from '@tiptap/extension-character-count'
import Link from '@tiptap/extension-link'
import StarterKit from '@tiptap/starter-kit'
import { EditorContent, useEditor } from '@tiptap/vue-3'
import { computed, onBeforeUnmount, ref, watch } from 'vue'
import Toolbar from './Toolbar.vue'

// ─── Props & Emits ────────────────────────────────────────────────────────────
const props = defineProps({
    modelValue: {
        type: String,
        default: '',
    },
    maxLength: {
        type: Number,
        default: 1000,
    },
    placeholder: {
        type: String,
        default: 'Tulis bio kamu di sini...',
    },
})

const emit = defineEmits(['update:modelValue'])

// ─── State ────────────────────────────────────────────────────────────────────
const isFocused = ref(false)

// ─── Editor Setup ─────────────────────────────────────────────────────────────
const editor = useEditor({
    content: props.modelValue,
    extensions: [
        StarterKit.configure({
            // Disable tags yang tidak relevan untuk bio
            heading: false,
            blockquote: false,
            codeBlock: false,
            horizontalRule: false,
            code: false,
        }),
        Link.configure({
            openOnClick: false,
            HTMLAttributes: {
                rel: 'noopener noreferrer nofollow',
                target: '_blank',
            },
        }),
        CharacterCount.configure({
            limit: props.maxLength,
        }),
    ],
    editorProps: {
        attributes: {
            class: 'outline-0',
            'data-placeholder': props.placeholder,
        },
    },
    onUpdate: ({ editor }) => {
        emit('update:modelValue', editor.getHTML())
    },
})

// Sync jika modelValue berubah dari luar (reset form, dll)
watch(
    () => props.modelValue,
    (value) => {
        if (editor.value && editor.value.getHTML() !== value) {
            editor.value.commands.setContent(value ?? '', false)
        }
    },
)

// ─── Computed ─────────────────────────────────────────────────────────────────
const characterCount = computed(() => editor.value?.storage.characterCount.characters() ?? 0)

// ─── Cleanup ──────────────────────────────────────────────────────────────────
onBeforeUnmount(() => editor.value?.destroy())
</script>

<style scoped>
/* Hanya style yang benar-benar tidak bisa dilakukan Bootstrap */
.tiptap-content {
    min-height: 140px;
    max-height: 400px;
    overflow-y: auto;
    cursor: text;
}

/* Placeholder via CSS karena TipTap tidak support attribute placeholder native */
.tiptap-content :deep(.ProseMirror p.is-editor-empty:first-child::before) {
    content: attr(data-placeholder);
    color: var(--bs-secondary-color);
    pointer-events: none;
    float: left;
    height: 0;
}

/* Reset ProseMirror default margin agar sesuai Bootstrap spacing */
.tiptap-content :deep(.ProseMirror) {
    outline: none;
}

.tiptap-content :deep(.ProseMirror > * + *) {
    margin-top: 0.5rem;
}

.tiptap-content :deep(.ProseMirror p) {
    margin-bottom: 0;
}
</style>
