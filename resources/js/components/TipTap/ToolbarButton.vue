<template>
    <button
        type="button"
        class="btn btn-sm"
        :class="active ? 'btn-primary active' : 'btn-primary'"
        :disabled="disabled"
        :title="tooltip"
        v-bind="$attrs"
        @click.prevent="$emit('click')"
    >
        <slot />
    </button>
</template>

<script setup>
defineOptions({ inheritAttrs: false })

defineProps({
    active: {
        type: Boolean,
        default: false,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    tooltip: {
        type: String,
        default: '',
    },
})

defineEmits(['click'])
</script>
