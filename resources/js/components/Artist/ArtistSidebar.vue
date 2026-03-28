<template>
    <aside class="artist-card artist-animate sidebar-card">
        <!-- Cover art -->
        <div class="cover-wrap">
            <img :src="cover" :alt="name" class="cover-img" />
            <div class="cover-reflection" aria-hidden="true" />
        </div>

        <!-- Identity -->
        <div class="sidebar-body">
            <h2 class="sidebar-name">{{ name }}</h2>
            <p class="sidebar-location">
                <svg viewBox="0 0 16 16" fill="currentColor" width="12" height="12">
                    <path
                        fill-rule="evenodd"
                        d="M8 1a5 5 0 00-5 5c0 2.542 2.088 4.946 3.813 6.477.38.337.994.337 1.374 0C9.912 10.946 13 8.542 13 6a5 5 0 00-5-5zm0 6.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3z"
                        clip-rule="evenodd"
                    />
                </svg>
                {{ location }}
            </p>

            <!-- Genres -->
            <div v-if="genres.length" class="genre-group">
                <span v-for="g in genres" :key="g.id" class="genre-pill">{{ g.name }}</span>
            </div>

            <!-- Social links -->
            <div v-if="socials.length" class="social-row">
                <a
                    v-for="s in socials"
                    :key="s.label"
                    :href="s.href"
                    :title="s.label"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="social-btn"
                    :style="{ '--sc': s.color }"
                >
                    <i :class="s.icon" />
                </a>
            </div>
        </div>
    </aside>
</template>

<script lang="ts" setup>
interface Genre {
    id: number
    name: string
}
interface Social {
    label: string
    href: string
    icon: string
    color: string
}

defineProps<{
    name: string
    location: string | null
    cover: string
    genres: Genre[]
    socials: Social[]
}>()
</script>

<style scoped>
.sidebar-card {
    position: sticky;
    top: calc(var(--nb-height, 64px) + 1rem);
}

/* --- Cover --- */
.cover-wrap {
    position: relative;
    overflow: hidden;
}

.cover-img {
    width: 100%;
    aspect-ratio: 1;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}
.sidebar-card:hover .cover-img {
    transform: scale(1.03);
}

/* Bottom fade into card body */
.cover-reflection {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 80px;
    background: linear-gradient(to top, var(--bs-body-bg), transparent);
}

/* --- Body --- */
.sidebar-body {
    padding: 1.25rem 1.25rem 1.5rem;
}

.sidebar-name {
    font-size: 1.375rem;
    font-weight: 700;
    letter-spacing: -0.02em;
    margin: 0 0 0.2rem;
    color: var(--bs-body-color);
}

.sidebar-location {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 0.8rem;
    color: var(--bs-secondary-color);
    margin: 0 0 1rem;
}

.genre-group {
    display: flex;
    flex-wrap: wrap;
    gap: 0.35rem;
    margin-bottom: 1.25rem;
}

/* --- Social buttons --- */
.social-row {
    display: flex;
    flex-wrap: wrap;
    gap: 0.4rem;
}

.social-btn {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
    background: rgba(var(--bs-body-color-rgb), 0.06);
    color: var(--bs-body-color);
    text-decoration: none;
    border: 1px solid rgba(var(--bs-body-color-rgb), 0.08);
    transition:
        background 0.15s,
        color 0.15s,
        transform 0.15s;
}
.social-btn:hover {
    background: var(--sc, rgba(var(--bs-primary-rgb), 0.15));
    color: var(--sc, var(--bs-primary));
    transform: translateY(-2px);
    border-color: transparent;
}
</style>
