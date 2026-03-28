<template>
    <aside class="filter-panel">
        <div class="filter-header">
            <h3 class="filter-title">Filter Band</h3>
            <button v-if="hasActive" type="button" class="reset-btn" @click="$emit('reset')" title="Reset semua filter" aria-label="Reset filter">
                <svg viewBox="0 0 16 16" fill="currentColor" width="13" height="13">
                    <path
                        fill-rule="evenodd"
                        d="M2 2.75A.75.75 0 012.75 2h10.5a.75.75 0 010 1.5H2.75A.75.75 0 012 2.75zm0 10.5A.75.75 0 012.75 12h10.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75zm4-7A.75.75 0 016.75 5h2.5a.75.75 0 010 1.5h-2.5A.75.75 0 016 6.25zm.75 3.25a.75.75 0 000 1.5h2.5a.75.75 0 000-1.5h-2.5z"
                        clip-rule="evenodd"
                    />
                </svg>
                Reset
            </button>
        </div>

        <form @submit.prevent="$emit('apply')">
            <div class="filter-group">
                <label class="filter-label">Kota / Kabupaten</label>
                <MultiSelect
                    id="regency"
                    :fetchUrl="regencyUrl"
                    :search="true"
                    :paginate="true"
                    :modelValue="selectedRegencies"
                    :options="regencies"
                    placeholder="Pilih kota..."
                    :initialNextPageUrl="regencyUrl"
                    @update:modelValue="$emit('update:selectedRegencies', $event)"
                />
            </div>

            <div class="filter-group">
                <label class="filter-label">Genre</label>
                <MultiSelect
                    id="genre"
                    :fetchUrl="genreUrl"
                    :search="true"
                    :paginate="true"
                    :modelValue="selectedGenres"
                    :options="genres"
                    placeholder="Pilih genre..."
                    :initialNextPageUrl="genreUrl"
                    @update:modelValue="$emit('update:selectedGenres', $event)"
                />
            </div>

            <button type="submit" class="apply-btn">
                <svg viewBox="0 0 16 16" fill="currentColor" width="13" height="13">
                    <path
                        fill-rule="evenodd"
                        d="M.75 3a.75.75 0 000 1.5h14.5a.75.75 0 000-1.5H.75zm2 4a.75.75 0 000 1.5h10.5a.75.75 0 000-1.5H2.75zm1.75 4.75a.75.75 0 01.75-.75h7a.75.75 0 010 1.5h-7a.75.75 0 01-.75-.75z"
                        clip-rule="evenodd"
                    />
                </svg>
                Terapkan Filter
            </button>
        </form>
    </aside>
</template>

<script lang="ts" setup>
import MultiSelect from '@/components/MultiSelect.vue'
import type { Genre } from '@/types/models/genre'
import type { Regency } from '@/types/models/regency'

defineProps<{
    regencies: Regency[]
    genres: Genre[]
    regencyUrl: string
    genreUrl: string
    selectedRegencies: number[]
    selectedGenres: number[]
    hasActive: boolean
}>()

defineEmits<{
    apply: []
    reset: []
    'update:selectedRegencies': [value: number[]]
    'update:selectedGenres': [value: number[]]
}>()
</script>

<style scoped>
.filter-panel {
    position: sticky;
    top: calc(var(--nb-height, 64px) + 1rem);
    background: var(--bs-body-bg);
    border: 1px solid rgba(var(--bs-body-color-rgb), 0.07);
    border-radius: 16px;
    padding: 1.375rem;
    box-shadow:
        0 1px 3px rgba(0, 0, 0, 0.04),
        0 4px 16px rgba(0, 0, 0, 0.04);
}

.filter-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.25rem;
}

.filter-title {
    font-size: 1rem;
    font-weight: 700;
    letter-spacing: -0.01em;
    margin: 0;
    color: var(--bs-body-color);
}

.reset-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.3rem 0.65rem;
    border-radius: 8px;
    border: 1.5px solid rgba(var(--bs-danger-rgb), 0.3);
    background: rgba(var(--bs-danger-rgb), 0.06);
    color: var(--bs-danger);
    cursor: pointer;
    transition: all 0.15s ease;
    animation: popIn 0.2s cubic-bezier(0.34, 1.56, 0.64, 1) both;
}
.reset-btn:hover {
    background: rgba(var(--bs-danger-rgb), 0.12);
    border-color: var(--bs-danger);
}

@keyframes popIn {
    from {
        opacity: 0;
        transform: scale(0.85);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.filter-group {
    margin-bottom: 1.125rem;
}

.filter-label {
    display: block;
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.02em;
    color: var(--bs-body-color);
    margin-bottom: 0.4rem;
}

.apply-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    width: 100%;
    padding: 0.65rem 1rem;
    border-radius: 10px;
    border: none;
    background: var(--bs-primary);
    color: #fff;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 2px 10px rgba(var(--bs-primary-rgb), 0.3);
    margin-top: 0.5rem;
}
.apply-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 5px 16px rgba(var(--bs-primary-rgb), 0.4);
}
.apply-btn:active {
    transform: none;
}
</style>
