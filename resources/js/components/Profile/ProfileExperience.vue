<template>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Experience</h5>

            <div v-for="exp in experiences" :key="exp.id" class="mb-3 pb-3 border-bottom">
                <h6 class="mb-0">{{ exp.band_name }}</h6>

                <small class="text-muted">
                    {{ exp.role }} • {{ exp.start_year }} -
                    {{ exp.end_year ?? 'Present' }}
                </small>

                <p class="mb-0 mt-1 text-muted">
                    {{ exp.description || '-' }}
                </p>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import type { Experience } from '@/types/profile'

defineProps<{
    experiences: Experience[]
}>()
</script>
