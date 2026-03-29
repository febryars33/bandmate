<template>
    <div v-if="editor" class="d-flex flex-wrap gap-1 p-2 border-bottom bg-body-tertiary rounded-top" role="toolbar" aria-label="Text formatting">
        <!-- Group: Inline Format -->
        <div class="btn-group btn-group-sm" role="group" aria-label="Inline formatting">
            <ToolbarButton
                :active="editor.isActive('bold')"
                :disabled="!editor.can().toggleBold()"
                tooltip="Bold (Ctrl+B)"
                aria-label="Bold"
                @click="editor.chain().focus().toggleBold().run()"
            >
                <i class="bi bi-type-bold"></i>
            </ToolbarButton>

            <ToolbarButton
                :active="editor.isActive('italic')"
                :disabled="!editor.can().toggleItalic()"
                tooltip="Italic (Ctrl+I)"
                aria-label="Italic"
                @click="editor.chain().focus().toggleItalic().run()"
            >
                <i class="bi bi-type-italic"></i>
            </ToolbarButton>

            <ToolbarButton
                :active="editor.isActive('strike')"
                :disabled="!editor.can().toggleStrike()"
                tooltip="Strikethrough"
                aria-label="Strikethrough"
                @click="editor.chain().focus().toggleStrike().run()"
            >
                <i class="bi bi-type-strikethrough"></i>
            </ToolbarButton>
        </div>

        <!-- Divider -->
        <div class="vr my-1"></div>

        <!-- Group: List -->
        <div class="btn-group btn-group-sm" role="group" aria-label="Lists">
            <ToolbarButton
                :active="editor.isActive('bulletList')"
                tooltip="Bullet List"
                aria-label="Bullet list"
                @click="editor.chain().focus().toggleBulletList().run()"
            >
                <i class="bi bi-list-ul"></i>
            </ToolbarButton>

            <ToolbarButton
                :active="editor.isActive('orderedList')"
                tooltip="Numbered List"
                aria-label="Numbered list"
                @click="editor.chain().focus().toggleOrderedList().run()"
            >
                <i class="bi bi-list-ol"></i>
            </ToolbarButton>
        </div>

        <!-- Divider -->
        <div class="vr my-1"></div>

        <!-- Group: Link -->
        <div class="btn-group btn-group-sm" role="group" aria-label="Link">
            <ToolbarButton :active="editor.isActive('link')" tooltip="Insert / Edit Link" aria-label="Link" @click="onLinkClick">
                <i class="bi bi-link-45deg"></i>
            </ToolbarButton>

            <ToolbarButton
                v-if="editor.isActive('link')"
                tooltip="Remove Link"
                aria-label="Remove link"
                @click="editor.chain().focus().unsetLink().run()"
            >
                <i class="bi bi-link"></i>
            </ToolbarButton>
        </div>

        <!-- Divider -->
        <div class="vr my-1"></div>

        <!-- Group: History -->
        <div class="btn-group btn-group-sm" role="group" aria-label="History">
            <ToolbarButton :disabled="!editor.can().undo()" tooltip="Undo (Ctrl+Z)" aria-label="Undo" @click="editor.chain().focus().undo().run()">
                <i class="bi bi-arrow-counterclockwise"></i>
            </ToolbarButton>

            <ToolbarButton :disabled="!editor.can().redo()" tooltip="Redo (Ctrl+Y)" aria-label="Redo" @click="editor.chain().focus().redo().run()">
                <i class="bi bi-arrow-clockwise"></i>
            </ToolbarButton>
        </div>
    </div>

    <!-- Link Modal -->
    <LinkModal v-model:visible="showLinkModal" :current-url="currentLinkUrl" @confirm="onLinkConfirm" @remove="onLinkRemove" />
</template>

<script setup>
import { computed, ref } from 'vue'
import LinkModal from './LinkModal.vue'
import ToolbarButton from './ToolbarButton.vue'

// ─── Props ────────────────────────────────────────────────────────────────────
const props = defineProps({
    editor: {
        type: Object,
        required: true,
    },
})

// ─── Link Modal State ─────────────────────────────────────────────────────────
const showLinkModal = ref(false)

const currentLinkUrl = computed(() => props.editor?.getAttributes('link').href ?? '')

function onLinkClick() {
    showLinkModal.value = true
}

function onLinkConfirm(url) {
    if (!url) return
    props.editor.chain().focus().setLink({ href: url }).run()
    showLinkModal.value = false
}

function onLinkRemove() {
    props.editor.chain().focus().unsetLink().run()
    showLinkModal.value = false
}
</script>
