<template>
    <div class="profile-card profile-animate mb-4">
        <!-- Cover band: blurred avatar sebagai background artistik -->
        <div class="cover-bg" :style="coverStyle" aria-hidden="true">
            <div class="cover-overlay" />
        </div>

        <!-- Main content row -->
        <div class="header-body">
            <!-- Avatar -->
            <div class="avatar-wrap">
                <img :src="profile.avatar" :alt="`${musician.real_name} avatar`" class="avatar-img" />
                <span class="avatar-status" :class="statusDot" :title="statusLabel" />
            </div>

            <!-- Identity -->
            <div class="header-info">
                <div class="header-top">
                    <div>
                        <h4 class="header-name">{{ musician.real_name }}</h4>
                        <span class="header-handle">@{{ user.username }}</span>
                    </div>
                    <!-- <span class="status-badge" :class="statusBadge">{{ statusLabel }}</span> -->
                </div>

                <p class="header-bio">{{ musician.bio }}</p>

                <div class="header-meta">
                    <span class="meta-item">
                        <!-- Pin icon -->
                        <i class="bi bi-geo-alt-fill" />
                        Bandung, Jawa Barat
                    </span>
                </div>
            </div>

            <!-- CTA -->
            <div class="header-cta">
                <button class="btn-follow">Ikuti</button>
                <!-- <button class="btn-message">Pesan</button> -->
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import type { Musician } from '@/types/models/musician'
import type { User } from '@/types/models/user'
import type { Profile } from '@/types/profile'
import { computed } from 'vue'

const props = defineProps<{
    profile: Profile
    musician: Musician
    user: User
}>()

const coverStyle = computed(() => ({
    backgroundImage: `url(${props.profile.avatar})`,
}))

const statusLabel = computed(() => {
    const map: Record<string, string> = {
        open: 'Open to Collaborate',
        looking: 'Looking for Members',
    }
    return map[props.profile.collaboration_status] ?? 'Not Available'
})

const statusBadge = computed(() => {
    const map: Record<string, string> = {
        open: 'badge--open',
        looking: 'badge--looking',
    }
    return map[props.profile.collaboration_status] ?? 'badge--closed'
})

const statusDot = computed(() => {
    const map: Record<string, string> = {
        open: 'dot--open',
        looking: 'dot--looking',
    }
    return map[props.profile.collaboration_status] ?? 'dot--closed'
})
</script>

<style scoped>
/* --- Cover background --- */
.cover-bg {
    height: 120px;
    background-size: cover;
    background-position: center 30%;
    filter: blur(18px) saturate(1.4);
    transform: scale(1.05);
    position: relative;
}

.cover-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(var(--bs-body-bg-rgb, 255, 255, 255), 0) 0%, rgba(var(--bs-body-bg-rgb, 255, 255, 255), 0.7) 100%);
}

/* --- Header body --- */
.header-body {
    display: flex;
    flex-wrap: wrap;
    gap: 1.25rem;
    padding: 0 1.5rem 1.5rem;
    margin-top: -44px;
    position: relative;
    align-items: flex-end;
}

/* --- Avatar --- */
.avatar-wrap {
    position: relative;
    flex-shrink: 0;
}

.avatar-img {
    width: 88px;
    height: 88px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--bs-body-bg);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
}

.avatar-status {
    position: absolute;
    bottom: 4px;
    right: 4px;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    border: 2px solid var(--bs-body-bg);
}

.dot--open {
    background: #22c55e;
}
.dot--looking {
    background: #f59e0b;
}
.dot--closed {
    background: #94a3b8;
}

/* --- Info --- */
.header-info {
    flex: 1;
    min-width: 0;
    padding-bottom: 4px;
}

.header-top {
    display: flex;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 0.5rem;
    justify-content: space-between;
    margin-bottom: 0.5rem;
}

.header-name {
    font-size: 1.4rem;
    font-weight: 700;
    letter-spacing: -0.02em;
    margin: 0;
    color: var(--bs-body-color);
    line-height: 1.2;
}

.header-handle {
    font-size: 0.825rem;
    color: var(--bs-secondary-color);
}

.header-bio {
    font-size: 0.875rem;
    color: var(--bs-body-color);
    margin: 0 0 0.5rem;
    line-height: 1.5;
}

.header-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.meta-item {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 0.8rem;
    color: var(--bs-secondary-color);
}

/* --- Status badge --- */
.status-badge {
    display: inline-flex;
    align-items: center;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.02em;
    padding: 0.25rem 0.7rem;
    border-radius: 999px;
    white-space: nowrap;
    flex-shrink: 0;
}

.badge--open {
    background: rgba(34, 197, 94, 0.12);
    color: #16a34a;
    border: 1px solid rgba(34, 197, 94, 0.25);
}
.badge--looking {
    background: rgba(245, 158, 11, 0.12);
    color: #b45309;
    border: 1px solid rgba(245, 158, 11, 0.25);
}
.badge--closed {
    background: rgba(148, 163, 184, 0.12);
    color: var(--bs-secondary-color);
    border: 1px solid rgba(148, 163, 184, 0.2);
}

/* --- CTA --- */
.header-cta {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    min-width: 120px;
    padding-bottom: 4px;
}

.btn-follow,
.btn-message {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    font-size: 0.875rem;
    font-weight: 600;
    padding: 0.55rem 1rem;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
    width: 100%;
}

.btn-follow {
    background: var(--bs-primary);
    color: #fff;
    box-shadow: 0 2px 10px rgba(var(--bs-primary-rgb), 0.3);
}
.btn-follow:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(var(--bs-primary-rgb), 0.4);
}

.btn-message {
    background: transparent;
    color: var(--bs-body-color);
    border: 1.5px solid rgba(var(--bs-body-color-rgb), 0.15);
}
.btn-message:hover {
    background: rgba(var(--bs-body-color-rgb), 0.05);
    border-color: rgba(var(--bs-body-color-rgb), 0.25);
}

@media (max-width: 767px) {
    .header-body {
        margin-top: -36px;
    }
    .avatar-img {
        width: 72px;
        height: 72px;
    }
    .header-cta {
        flex-direction: row;
        min-width: unset;
        width: 100%;
    }
    .btn-follow,
    .btn-message {
        flex: 1;
    }
}
</style>
