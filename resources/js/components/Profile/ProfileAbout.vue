<template>
    <div class="profile-card profile-animate mb-4 about-card">
        <p class="section-label">Tentang</p>

        <p v-if="about" class="about-text">{{ about }}</p>

        <div v-else class="about-empty">
            <svg viewBox="0 0 16 16" fill="currentColor" width="18" height="18" class="empty-icon">
                <path
                    fill-rule="evenodd"
                    d="M11.013 1.427a1.75 1.75 0 012.474 0l1.086 1.086a1.75 1.75 0 010 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 01-.927-.928l.929-3.25c.081-.286.235-.547.445-.758l8.61-8.61zm1.414 1.06a.25.25 0 00-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 000-.354l-1.086-1.086zM11.189 6.25L9.75 4.81l-6.286 6.287a.25.25 0 00-.064.108l-.558 1.953 1.953-.558a.249.249 0 00.108-.064l6.286-6.286z"
                    clip-rule="evenodd"
                />
            </svg>
            <span>Belum ada tentang yang ditambahkan.</span>
        </div>
    </div>
</template>

<script lang="ts" setup>
defineProps<{ about: string | null }>()
</script>

<style scoped>
.about-card {
    padding: 1.5rem;
}

.about-text {
    font-size: 0.9rem;
    color: var(--bs-body-color);
    line-height: 1.75;
    margin: 0;
}

.about-empty {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    color: var(--bs-secondary-color);
}

.empty-icon {
    color: var(--bs-secondary-color);
    opacity: 0.5;
    flex-shrink: 0;
}
</style>
