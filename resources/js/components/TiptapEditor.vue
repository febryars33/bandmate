<template>
    <div v-if="editor">
        <!-- Basic Menu (Optional) -->
        <button
            type="button"
            class="btn btn-sm btn-outline-primary"
            @click="editor.chain().focus().toggleBold().run()"
            :disabled="!editor.can().chain().focus().toggleBold().run()"
        >
            Bold
        </button>

        <!-- Editor Content Area -->
        <editor-content :editor="editor" />
    </div>
</template>

<script setup>
import StarterKit from '@tiptap/starter-kit'
import { EditorContent, useEditor } from '@tiptap/vue-3'

const props = defineProps({
    modelValue: String,
})

const emit = defineEmits(['update:modelValue'])

const editor = useEditor({
    content: props.modelValue,
    extensions: [StarterKit],
    onUpdate: ({ editor }) => {
        // Sync editor content back to Inertia/Vue parent
        emit('update:modelValue', editor.getHTML())
    },
})
</script>
