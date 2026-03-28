<template>
    <div class="row align-items-center justify-content-between mb-3">
        <div class="col-lg-6">
            <p class="list-total">
                <strong>{{ total }}</strong> lowongan ditemukan
            </p>
        </div>
        <div class="col-lg-4">
            <div class="list-search-wrap">
                <i class="bi bi-search list-search-icon" />
                <input
                    type="search"
                    class="list-search"
                    :value="search"
                    placeholder="Cari lowongan..."
                    aria-label="Cari lowongan"
                    @input="$emit('update:search', ($event.target as HTMLInputElement).value)"
                />
            </div>
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
.list-total {
    margin: 0;
    font-size: 0.875rem;
    color: var(--bs-secondary-color);
}

.list-search-wrap {
    position: relative;
    flex: 1;
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
