<!-- /resources/js/components/Artist/ArtistListHeader.vue -->
<template>
    <div class="list-header">
        <p class="list-total">
            <strong>{{ total }}</strong> band ditemukan
        </p>
        <div class="list-search-wrap">
            <svg class="list-search-icon" viewBox="0 0 16 16" fill="currentColor" width="14" height="14">
                <path
                    fill-rule="evenodd"
                    d="M9.965 11.026a5 5 0 111.06-1.06l2.755 2.754a.75.75 0 11-1.06 1.06l-2.755-2.754zM10.5 7a3.5 3.5 0 11-7 0 3.5 3.5 0 017 0z"
                    clip-rule="evenodd"
                />
            </svg>
            <input
                type="search"
                class="list-search"
                :value="search"
                placeholder="Cari band..."
                aria-label="Cari band"
                @input="$emit('update:search', ($event.target as HTMLInputElement).value)"
            />
        </div>
    </div>
</template>

<script lang="ts" setup>
defineProps<{
    total: number
    search: string
}>()

defineEmits<{
    'update:search': [value: string]
}>()
</script>

<style scoped>
.list-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1.25rem;
    flex-wrap: wrap;
}

.list-total {
    margin: 0;
    font-size: 0.875rem;
    color: var(--bs-secondary-color);
}

.list-search-wrap {
    position: relative;
    flex: 1;
    max-width: 320px;
}

.list-search-icon {
    position: absolute;
    left: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--bs-secondary-color);
    pointer-events: none;
}

.list-search {
    width: 100%;
    padding: 0.5rem 0.75rem 0.5rem 2.25rem;
    border-radius: 10px;
    border: 1.5px solid rgba(var(--bs-body-color-rgb), 0.15);
    background: var(--bs-body-bg);
    color: var(--bs-body-color);
    font-size: 0.875rem;
    outline: none;
    transition:
        border-color 0.15s,
        box-shadow 0.15s;
    -webkit-appearance: none;
}

.list-search:focus {
    border-color: var(--bs-primary);
    box-shadow: 0 0 0 3px rgba(var(--bs-primary-rgb), 0.12);
}
</style>
