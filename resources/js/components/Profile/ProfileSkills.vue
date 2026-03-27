<template>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Musical Skills</h5>

            <!-- Instruments -->
            <div class="mb-3">
                <h6>Instruments</h6>
                <span v-for="item in instruments" :key="item" class="badge bg-primary me-1">
                    {{ item }}
                </span>
            </div>

            <!-- Genres -->
            <div>
                <h6>Genres</h6>
                <span v-for="item in genres" :key="item" class="badge bg-secondary me-1">
                    {{ item }}
                </span>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
defineProps<{
    instruments: string[]
    genres: string[]
}>()
</script>
