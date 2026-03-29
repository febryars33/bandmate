<!-- resources/js/Components/SafeHtml.vue -->
<script setup lang="ts">
import { useSafeHtml } from '@/composables/useSafeHtml'
import { computed } from 'vue'

const props = defineProps<{
    content: string
    tag?: string // wrapper tag, default 'div'
}>()

const { sanitize } = useSafeHtml()
const safeContent = computed(() => sanitize(props.content))
</script>

<template>
    <component :is="tag ?? 'div'" v-html="safeContent" />
</template>
