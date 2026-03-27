<template>
    <div ref="root" class="dropdown" :class="{ show: open }">
        <div :id="id" class="form-select d-flex align-items-center cursor-pointer shadow-sm" :aria-expanded="open" @click="toggle">
            <span class="text-truncate me-2" :class="{ 'text-muted': !hasSelection }">
                {{ label }}
            </span>
        </div>

        <ul class="dropdown-menu w-100 shadow-sm p-0 dropdown-options" :class="{ show: open }">
            <div v-if="search" class="p-2 bg-body-tertiary sticky-top">
                <input type="search" class="form-control form-control-sm" v-model="query" placeholder="Cari..." @click.stop />
            </div>

            <li v-for="opt in opts" :key="opt.id" class="px-2 py-1">
                <div class="dropdown-item rounded px-2 py-1 cursor-pointer" @click="pick(opt.id)">
                    <div class="form-check m-0">
                        <input class="form-check-input" type="checkbox" :checked="modelValue.includes(opt.id)" @click.stop />
                        <label class="form-check-label w-100 cursor-pointer">{{ opt.name }}</label>
                    </div>
                </div>
            </li>

            <div ref="sentinel" v-if="nextPage" class="text-center py-2">
                <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
            </div>

            <li v-if="opts.length === 0 && !loading" class="dropdown-item disabled text-center py-3">Data tidak ditemukan</li>
        </ul>
    </div>
</template>

<script setup lang="ts">
import { onClickOutside, useDebounceFn, useIntersectionObserver } from '@vueuse/core'
import axios from 'axios'
import { computed, ref, watch } from 'vue'

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

// ─── Computed ─────────────────────────────────────────────────────────────────

const hasSelection = computed(() => props.modelValue.length > 0)
const label = computed(() => (hasSelection.value ? `${props.modelValue.length} item dipilih` : props.placeholder))

// ─── Dropdown ─────────────────────────────────────────────────────────────────

const toggle = () => (open.value = !open.value)
const close = () => (open.value = false)

onClickOutside(root, close)

// ─── Fetch ────────────────────────────────────────────────────────────────────

const fetch = async (url: string, append = false) => {
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
        console.error('MultiSelect fetch failed:', e)
    } finally {
        loading.value = false
    }
}

// ─── Search ───────────────────────────────────────────────────────────────────

const debouncedSearch = useDebounceFn(() => fetch(props.fetchUrl), 300)

watch(query, () => {
    if (props.search) debouncedSearch()
})

// ─── Infinite Scroll ─────────────────────────────────────────────────────────

const canLoadMore = computed(() => props.paginate && !!nextPage.value && !loading.value)

useIntersectionObserver(sentinel, ([{ isIntersecting }]) => {
    if (isIntersecting && canLoadMore.value) fetch(nextPage.value!, true)
})

// ─── Selection ────────────────────────────────────────────────────────────────

const pick = (id: number) => {
    const next = props.modelValue.includes(id) ? props.modelValue.filter((v) => v !== id) : [...props.modelValue, id]

    emit('update:modelValue', next)
}
</script>

<style scoped>
.dropdown-options {
    max-height: 250px;
    overflow-y: auto;
}
</style>
