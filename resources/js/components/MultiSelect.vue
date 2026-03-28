<template>
    <div ref="root" class="ms-wrap" :class="{ 'ms-wrap--open': open }">
        <!-- Trigger -->
        <button type="button" :id="id" class="ms-trigger" :aria-expanded="open" :aria-haspopup="true" @click="toggle">
            <span class="ms-label" :class="{ 'ms-label--placeholder': !hasSelection }">
                {{ label }}
            </span>
            <svg class="ms-chevron" viewBox="0 0 16 16" fill="currentColor" width="12" height="12">
                <path
                    fill-rule="evenodd"
                    d="M4.22 6.22a.75.75 0 011.06 0L8 8.94l2.72-2.72a.75.75 0 111.06 1.06l-3.25 3.25a.75.75 0 01-1.06 0L4.22 7.28a.75.75 0 010-1.06z"
                    clip-rule="evenodd"
                />
            </svg>
        </button>

        <!-- Dropdown panel -->
        <Transition name="ms-drop">
            <div v-if="open" class="ms-dropdown" role="listbox" :aria-multiselectable="true">
                <!-- Search -->
                <div v-if="search" class="ms-search-wrap">
                    <input ref="searchRef" type="search" class="ms-search" v-model="query" placeholder="Cari..." @click.stop aria-label="Cari opsi" />
                </div>

                <!-- Options -->
                <ul class="ms-options">
                    <li
                        v-for="opt in opts"
                        :key="opt.id"
                        class="ms-option"
                        role="option"
                        :aria-selected="modelValue.includes(opt.id)"
                        @click="pick(opt.id)"
                    >
                        <span class="ms-checkbox" :class="{ 'ms-checkbox--checked': modelValue.includes(opt.id) }" aria-hidden="true">
                            <svg v-if="modelValue.includes(opt.id)" viewBox="0 0 12 12" fill="currentColor" width="9" height="9">
                                <path
                                    fill-rule="evenodd"
                                    d="M10.28 2.28L3.989 8.575 1.695 6.28A1 1 0 00.28 7.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 2.28z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </span>
                        <span class="ms-opt-label">{{ opt.name }}</span>
                    </li>

                    <!-- Infinite scroll sentinel -->
                    <li v-if="nextPage" ref="sentinel" class="ms-sentinel">
                        <span class="ms-spinner" role="status" aria-label="Memuat..." />
                    </li>

                    <!-- Empty -->
                    <li v-if="!opts.length && !loading" class="ms-empty">Data tidak ditemukan</li>
                </ul>
            </div>
        </Transition>
    </div>
</template>

<script setup lang="ts">
import { onClickOutside, useDebounceFn, useIntersectionObserver } from '@vueuse/core'
import axios from 'axios'
import { computed, nextTick, ref, watch } from 'vue'

// ─── Types ────────────────────────────────────────────────────────────────────

interface Option {
    id: number
    name: string
}

interface Props {
    modelValue: number[]
    options: Option[]
    initialNextPageUrl?: string | null
    placeholder: string
    fetchUrl: string
    id: string
    search?: boolean
    paginate?: boolean
}

// ─── Props & Emits ────────────────────────────────────────────────────────────

const props = defineProps<Props>()
const emit = defineEmits<{ 'update:modelValue': [value: number[]] }>()

// ─── State ────────────────────────────────────────────────────────────────────

const opts = ref<Option[]>([...props.options])
const nextPage = ref<string | null>(props.initialNextPageUrl ?? null)
const query = ref('')
const loading = ref(false)
const open = ref(false)
const root = ref<HTMLElement | null>(null)
const sentinel = ref<HTMLElement | null>(null)
const searchRef = ref<HTMLInputElement | null>(null)

// ─── Computed ─────────────────────────────────────────────────────────────────

const hasSelection = computed(() => props.modelValue.length > 0)
const label = computed(() => (hasSelection.value ? `${props.modelValue.length} dipilih` : props.placeholder))

// ─── Dropdown ─────────────────────────────────────────────────────────────────

const toggle = () => {
    open.value = !open.value
    if (open.value && props.search) nextTick(() => searchRef.value?.focus())
}

onClickOutside(root, () => {
    open.value = false
})

// ─── Fetch ────────────────────────────────────────────────────────────────────

const fetchOpts = async (url: string, append = false) => {
    if (loading.value) return
    loading.value = true
    try {
        const { data } = await axios.get(url, {
            params: { search: query.value },
            headers: { Accept: 'application/json' },
        })
        opts.value = append ? [...opts.value, ...data.data] : data.data
        nextPage.value = data.next_page_url
    } catch (e) {
        console.error('MultiSelect fetch error:', e)
    } finally {
        loading.value = false
    }
}

// ─── Search debounce ─────────────────────────────────────────────────────────

const debouncedSearch = useDebounceFn(() => fetchOpts(props.fetchUrl), 300)
watch(query, () => {
    if (props.search) debouncedSearch()
})

// ─── Infinite scroll ─────────────────────────────────────────────────────────

const canLoadMore = computed(() => props.paginate && !!nextPage.value && !loading.value)

useIntersectionObserver(sentinel, ([{ isIntersecting }]) => {
    if (isIntersecting && canLoadMore.value) fetchOpts(nextPage.value!, true)
})

// ─── Selection ────────────────────────────────────────────────────────────────

const pick = (id: number) => {
    const next = props.modelValue.includes(id) ? props.modelValue.filter((v) => v !== id) : [...props.modelValue, id]
    emit('update:modelValue', next)
}
</script>

<style scoped>
/* ── Wrapper ── */
.ms-wrap {
    position: relative;
}

/* ── Trigger ── */
.ms-trigger {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
    padding: 0.55rem 0.875rem;
    border-radius: 10px;
    border: 1.5px solid rgba(var(--bs-body-color-rgb), 0.15);
    background: var(--bs-body-bg);
    color: var(--bs-body-color);
    font-size: 0.875rem;
    cursor: pointer;
    transition:
        border-color 0.15s,
        box-shadow 0.15s;
    text-align: left;
    outline: none;
}
.ms-trigger:focus,
.ms-wrap--open .ms-trigger {
    border-color: var(--bs-primary);
    box-shadow: 0 0 0 3px rgba(var(--bs-primary-rgb), 0.12);
}

.ms-label {
    flex: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.ms-label--placeholder {
    color: var(--bs-secondary-color);
    opacity: 0.75;
}

.ms-chevron {
    flex-shrink: 0;
    color: var(--bs-secondary-color);
    transition: transform 0.2s ease;
}
.ms-wrap--open .ms-chevron {
    transform: rotate(180deg);
}

/* ── Dropdown ── */
.ms-dropdown {
    position: absolute;
    top: calc(100% + 4px);
    left: 0;
    right: 0;
    z-index: 1050;
    background: var(--bs-body-bg);
    border: 1.5px solid rgba(var(--bs-body-color-rgb), 0.1);
    border-radius: 12px;
    box-shadow:
        0 4px 24px rgba(0, 0, 0, 0.12),
        0 1px 4px rgba(0, 0, 0, 0.06);
    overflow: hidden;
}

/* ── Search ── */
.ms-search-wrap {
    padding: 0.5rem;
    border-bottom: 1px solid rgba(var(--bs-body-color-rgb), 0.07);
    position: sticky;
    top: 0;
    background: var(--bs-body-bg);
    z-index: 1;
}

.ms-search {
    width: 100%;
    padding: 0.4rem 0.75rem;
    border-radius: 8px;
    border: 1.5px solid rgba(var(--bs-body-color-rgb), 0.12);
    background: var(--bs-tertiary-bg);
    color: var(--bs-body-color);
    font-size: 0.8125rem;
    outline: none;
    transition: border-color 0.15s;
    -webkit-appearance: none;
}
.ms-search:focus {
    border-color: var(--bs-primary);
}

/* ── Options list ── */
.ms-options {
    list-style: none;
    margin: 0;
    padding: 0.375rem;
    max-height: 220px;
    overflow-y: auto;
}

.ms-option {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    padding: 0.45rem 0.75rem;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.12s;
    font-size: 0.875rem;
    color: var(--bs-body-color);
    user-select: none;
}
.ms-option:hover {
    background: rgba(var(--bs-body-color-rgb), 0.05);
}
.ms-option[aria-selected='true'] {
    background: rgba(var(--bs-primary-rgb), 0.06);
}

/* Custom checkbox */
.ms-checkbox {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
    border-radius: 4px;
    border: 1.5px solid rgba(var(--bs-body-color-rgb), 0.2);
    background: var(--bs-body-bg);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.12s;
}
.ms-checkbox--checked {
    background: var(--bs-primary);
    border-color: var(--bs-primary);
    color: #fff;
}

.ms-opt-label {
    flex: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Spinner sentinel */
.ms-sentinel {
    display: flex;
    justify-content: center;
    padding: 0.5rem 0;
}
.ms-spinner {
    display: inline-block;
    width: 16px;
    height: 16px;
    border: 2px solid rgba(var(--bs-primary-rgb), 0.2);
    border-top-color: var(--bs-primary);
    border-radius: 50%;
    animation: spin 0.6s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.ms-empty {
    text-align: center;
    padding: 1rem;
    font-size: 0.8125rem;
    color: var(--bs-secondary-color);
}

/* ── Open/close transition ── */
.ms-drop-enter-active {
    transition:
        opacity 0.15s ease,
        transform 0.15s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.ms-drop-leave-active {
    transition:
        opacity 0.1s ease,
        transform 0.1s ease;
}
.ms-drop-enter-from {
    opacity: 0;
    transform: translateY(-6px) scale(0.98);
}
.ms-drop-leave-to {
    opacity: 0;
    transform: translateY(-4px) scale(0.98);
}
</style>
