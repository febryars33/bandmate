<template>
    <section class="artist-hero" ref="heroRef">
        <!-- Parallax layer -->
        <div class="hero-bg" :style="{ backgroundImage: `url(${bg})`, transform: `translateY(${offset}px)` }" aria-hidden="true" />
        <!-- Grain overlay -->
        <div class="hero-grain" aria-hidden="true" />
        <!-- Gradient scrim: dark bottom for legibility -->
        <div class="hero-scrim" aria-hidden="true" />

        <!-- Content -->
        <div class="container hero-content">
            <div class="hero-breadcrumb">
                <Link :href="artists.index()" class="hero-back">
                    <svg viewBox="0 0 16 16" fill="currentColor" width="13" height="13">
                        <path
                            fill-rule="evenodd"
                            d="M14 8a.75.75 0 01-.75.75H4.56l3.22 3.22a.75.75 0 11-1.06 1.06l-4.5-4.5a.75.75 0 010-1.06l4.5-4.5a.75.75 0 011.06 1.06L4.56 7.25h8.69A.75.75 0 0114 8z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    Band
                </Link>
                <span class="hero-sep">/</span>
                <span class="hero-current">{{ name }}</span>
            </div>

            <h1 class="hero-title">{{ name }}</h1>
            <p class="hero-location">
                <svg viewBox="0 0 16 16" fill="currentColor" width="13" height="13">
                    <path
                        fill-rule="evenodd"
                        d="M8 1a5 5 0 00-5 5c0 2.542 2.088 4.946 3.813 6.477.38.337.994.337 1.374 0C9.912 10.946 13 8.542 13 6a5 5 0 00-5-5zm0 6.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3z"
                        clip-rule="evenodd"
                    />
                </svg>
                {{ location }}
            </p>
        </div>
    </section>
</template>

<script lang="ts" setup>
import artists from '@/routes/artists'
import { Link } from '@inertiajs/vue3'
import { onMounted, onUnmounted, ref } from 'vue'

const props = defineProps<{
    name: string
    location: string | null
    bg: string
}>()

const heroRef = ref<HTMLElement | null>(null)
const offset = ref(0)

const onScroll = () => {
    if (!heroRef.value) return
    const rect = heroRef.value.getBoundingClientRect()
    // Parallax: move bg at 40% of scroll speed
    offset.value = Math.round(-rect.top * 0.4)
}

onMounted(() => window.addEventListener('scroll', onScroll, { passive: true }))
onUnmounted(() => window.removeEventListener('scroll', onScroll))
</script>

<style scoped>
.artist-hero {
    position: relative;
    min-height: 520px;
    display: flex;
    align-items: flex-end;
    overflow: hidden;
    margin-bottom: 0;
}

/* --- Background (parallax layer) --- */
.hero-bg {
    position: absolute;
    inset: -15% 0; /* extra height for parallax travel */
    background-size: cover;
    background-position: center top;
    will-change: transform;
}

/* --- SVG noise grain --- */
.hero-grain {
    position: absolute;
    inset: 0;
    opacity: 0.18;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
    background-size: 180px;
    pointer-events: none;
}

/* --- Gradient scrim --- */
.hero-scrim {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.4) 45%, rgba(0, 0, 0, 0.15) 100%);
}

/* --- Content --- */
.hero-content {
    position: relative;
    z-index: 2;
    padding-bottom: 3rem;
    color: #fff;
}

.hero-breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1.25rem;
    font-size: 0.8125rem;
}

.hero-back {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    transition: color 0.15s;
}
.hero-back:hover {
    color: #fff;
}

.hero-sep {
    color: rgba(255, 255, 255, 0.3);
}
.hero-current {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.8125rem;
}

.hero-title {
    font-size: clamp(2.5rem, 7vw, 5rem);
    font-weight: 900;
    letter-spacing: -0.03em;
    line-height: 1;
    margin: 0 0 0.75rem;
    color: #fff;
    text-shadow: 0 2px 20px rgba(0, 0, 0, 0.4);
    animation: fadeUp 0.6s cubic-bezier(0.22, 1, 0.36, 1) 0.1s both;
}

.hero-location {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.65);
    margin: 0;
    animation: fadeUp 0.6s cubic-bezier(0.22, 1, 0.36, 1) 0.22s both;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(16px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
