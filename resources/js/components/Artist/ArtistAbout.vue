<template>
    <div class="artist-card artist-animate about-card">
        <p class="section-eyebrow">Tentang Band</p>
        <p class="about-text">{{ about || 'Belum ada deskripsi.' }}</p>
    </div>
</template>

<script lang="ts" setup>
defineProps<{ about: string }>()
</script>

<style scoped>
.about-card {
    padding: 1.5rem;
}

.about-text {
    font-size: 0.9375rem;
    line-height: 1.8;
    color: var(--bs-body-color);
    margin: 0;
    white-space: pre-line;
}
</style>
