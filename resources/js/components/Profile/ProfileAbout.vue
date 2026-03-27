<template>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">About</h5>

            <p class="mb-0 text-muted">
                {{ bio || 'No bio provided.' }}
            </p>
        </div>
    </div>
</template>

<script lang="ts" setup>
defineProps<{
    bio: string
}>()
</script>
