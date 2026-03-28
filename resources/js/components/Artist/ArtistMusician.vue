<template>
    <ul class="member-list">
        <li v-for="m in musicians" :key="m.id" class="member-item">
            <!-- Avatar placeholder -->
            <span class="member-avatar" aria-hidden="true">
                <template v-if="m.name !== null">
                    {{ initials(m.name) }}
                </template>
                <template v-else> - </template>
            </span>

            <!-- Identity -->
            <div class="member-info">
                <template v-if="m.musician">
                    <Link v-if="m.musician?.user" :href="profile(m.musician.user.username)" class="member-name is-link">
                        {{ m.name }}
                    </Link>
                    <span v-else class="member-name">{{ m.name }}</span>
                </template>

                <template v-else>
                    <span class="member-name">{{ m.name }}</span>
                </template>

                <span class="member-tenure">
                    {{ tenure(m.joined_at, m.left_at) }}
                </span>
            </div>

            <!-- Instruments -->
            <div class="member-instruments">
                <span v-for="inst in m.instruments" :key="inst" class="inst-pill">
                    {{ inst }}
                </span>
            </div>
        </li>
    </ul>
</template>

<script lang="ts" setup>
import { profile } from '@/routes'
import type { ArtistMusician } from '@/types/models/pivots/artist_musician'
import { Link } from '@inertiajs/vue3'

defineProps<{ musicians: ArtistMusician[] }>()

const fmt = (date: string) => new Intl.DateTimeFormat('id-ID', { year: 'numeric' }).format(new Date(date))

const tenure = (joined: string | null, left: string | null): string => {
    const start = joined ? fmt(joined) : '?'
    const end = left ? fmt(left) : 'Sekarang'
    return `${start} – ${end}`
}

const initials = (name: string): string =>
    name
        .split(' ')
        .slice(0, 2)
        .map((w) => w[0])
        .join('')
        .toUpperCase()
</script>

<style scoped>
.member-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 0;
}

.member-item {
    display: flex;
    align-items: center;
    gap: 0.875rem;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(var(--bs-body-color-rgb), 0.06);
    transition: background 0.15s;
}
.member-item:last-child {
    border-bottom: none;
}
.member-item:hover {
    background: rgba(var(--bs-body-color-rgb), 0.02);
}

/* --- Avatar --- */
.member-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(var(--bs-primary-rgb), 0.12);
    color: var(--bs-primary);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7rem;
    font-weight: 700;
    flex-shrink: 0;
    letter-spacing: 0.02em;
}

/* --- Info --- */
.member-info {
    display: flex;
    flex-direction: column;
    gap: 0.1rem;
    flex: 1;
    min-width: 0;
}

.member-name {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--bs-body-color);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.member-name.is-link {
    color: var(--bs-primary);
    cursor: pointer;
}
.member-name.is-link:hover {
    text-decoration: underline;
}

.member-tenure {
    font-size: 0.75rem;
    color: var(--bs-secondary-color);
}

/* --- Instruments --- */
.member-instruments {
    display: flex;
    flex-wrap: wrap;
    gap: 0.3rem;
    justify-content: flex-end;
}

.inst-pill {
    font-size: 0.7rem;
    font-weight: 500;
    padding: 0.2rem 0.55rem;
    border-radius: 999px;
    background: rgba(13, 202, 240, 0.1);
    color: var(--bs-info);
    border: 1px solid rgba(13, 202, 240, 0.2);
    white-space: nowrap;
}

@media (max-width: 575px) {
    .member-instruments {
        display: none;
    }
}
</style>
