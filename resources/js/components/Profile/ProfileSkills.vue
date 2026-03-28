<template>
    <div class="profile-card profile-animate mb-4 skills-card">
        <div class="skills-section">
            <p class="section-label">Instrumen</p>
            <div class="pill-group">
                <span v-for="item in instruments" :key="item.id" class="skill-pill pill-instrument">
                    {{ item.name }}
                </span>
                <span v-if="!instruments.length" class="empty-pill">Belum ada instrumen</span>
            </div>
        </div>

        <div class="skills-divider" />

        <div class="skills-section">
            <p class="section-label">Genre</p>
            <div class="pill-group">
                <span v-for="item in genres" :key="item.id" class="skill-pill pill-genre">
                    {{ item.name }}
                </span>
                <span v-if="!genres.length" class="empty-pill">Belum ada genre</span>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import type { Genre } from '@/types/models/genre'
import type { Instrument } from '@/types/models/instrument'

defineProps<{
    instruments: Instrument[]
    genres: Genre[]
}>()
</script>

<style scoped>
.skills-card {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 0;
}

.skills-section {
    padding: 0;
}

.skills-divider {
    height: 1px;
    background: rgba(var(--bs-body-color-rgb), 0.07);
    margin: 1.25rem 0;
}

.pill-group {
    display: flex;
    flex-wrap: wrap;
    gap: 0.4rem;
}

.empty-pill {
    font-size: 0.8rem;
    color: var(--bs-secondary-color);
    font-style: italic;
}
</style>
