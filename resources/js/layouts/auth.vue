<template>
    <div class="auth-root">
        <!-- Toast -->
        <AppToast />

        <div class="auth-card">
            <!-- Left: Brand Panel -->
            <div class="auth-brand" aria-hidden="true">
                <div class="brand-noise" />
                <div class="brand-content">
                    <div class="brand-logo">
                        <svg viewBox="0 0 40 40" fill="none" width="40" height="40">
                            <circle cx="20" cy="20" r="20" fill="rgba(255,255,255,0.15)" />
                            <path d="M13 27V15l7-4 7 4v12l-7 4-7-4z" fill="rgba(255,255,255,0.9)" />
                        </svg>
                        <span class="brand-name">BandMate</span>
                    </div>
                    <blockquote class="brand-quote">
                        <p>"Musik adalah bahasa universal umat manusia."</p>
                        <footer>— Henry Wadsworth Longfellow</footer>
                    </blockquote>
                    <div class="brand-dots"><span /><span /><span /></div>
                </div>
            </div>

            <!-- Right: Form Slot -->
            <div class="auth-form-wrap">
                <!-- Mobile logo -->
                <div class="auth-mobile-logo d-lg-none">
                    <svg viewBox="0 0 32 32" fill="none" width="28" height="28">
                        <circle cx="16" cy="16" r="16" fill="var(--bs-primary)" />
                        <path d="M10 22V12l6-3.5 6 3.5v10l-6 3.5-6-3.5z" fill="#fff" />
                    </svg>
                    <span>BandMate</span>
                </div>

                <slot />
            </div>
        </div>

        <p class="auth-footer">© {{ year }} BandMate. All rights reserved.</p>
    </div>
</template>

<script lang="ts" setup>
import AppToast from '@/components/Bootstrap/Toast.vue'

const year = new Date().getFullYear()
</script>

<style>
/* Auth global reset */
body {
    background: var(--bs-tertiary-bg) !important;
}
</style>

<style scoped>
/* ── Root ── */
.auth-root {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    gap: 1.25rem;
}

/* ── Card ── */
.auth-card {
    width: 100%;
    max-width: 900px;
    display: grid;
    grid-template-columns: 1fr;
    border-radius: 20px;
    overflow: hidden;
    box-shadow:
        0 0 0 1px rgba(var(--bs-body-color-rgb), 0.06),
        0 20px 60px rgba(0, 0, 0, 0.1),
        0 4px 16px rgba(0, 0, 0, 0.06);
    background: var(--bs-body-bg);
    animation: cardIn 0.45s cubic-bezier(0.34, 1.2, 0.64, 1) both;
}

@media (min-width: 992px) {
    .auth-card {
        grid-template-columns: 5fr 7fr;
    }
}

@keyframes cardIn {
    from {
        opacity: 0;
        transform: translateY(20px) scale(0.98);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* ── Brand panel (left) ── */
.auth-brand {
    display: none;
    position: relative;
    background: var(--bs-primary);
    padding: 3rem 2.5rem;
    overflow: hidden;
}

@media (min-width: 992px) {
    .auth-brand {
        display: flex;
        align-items: center;
        justify-content: center;
    }
}

/* Subtle noise texture */
.brand-noise {
    position: absolute;
    inset: 0;
    opacity: 0.06;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
    background-size: 180px;
    pointer-events: none;
}

/* Decorative circle */
.auth-brand::before {
    content: '';
    position: absolute;
    width: 320px;
    height: 320px;
    border-radius: 50%;
    border: 1px solid rgba(255, 255, 255, 0.12);
    top: -80px;
    right: -80px;
}
.auth-brand::after {
    content: '';
    position: absolute;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    border: 1px solid rgba(255, 255, 255, 0.08);
    bottom: -60px;
    left: -60px;
}

.brand-content {
    position: relative;
    z-index: 1;
    color: #fff;
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.brand-logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.brand-name {
    font-size: 1.5rem;
    font-weight: 700;
    letter-spacing: -0.02em;
    color: #fff;
}

.brand-quote {
    margin: 0;
    padding: 1.25rem;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(8px);
}

.brand-quote p {
    margin: 0 0 0.5rem;
    font-size: 0.875rem;
    line-height: 1.6;
    font-style: italic;
    color: rgba(255, 255, 255, 0.9);
}

.brand-quote footer {
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.6);
}

.brand-dots {
    display: flex;
    gap: 6px;
}
.brand-dots span {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.4);
}
.brand-dots span:first-child {
    background: rgba(255, 255, 255, 0.9);
    width: 18px;
    border-radius: 3px;
}

/* ── Form side (right) ── */
.auth-form-wrap {
    padding: 2.5rem 2rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 0;
}

@media (min-width: 768px) {
    .auth-form-wrap {
        padding: 3rem 3rem;
    }
}

/* Mobile logo */
.auth-mobile-logo {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1.75rem;
    font-size: 1.125rem;
    font-weight: 700;
    letter-spacing: -0.01em;
    color: var(--bs-body-color);
}

/* ── Footer ── */
.auth-footer {
    font-size: 0.75rem;
    color: var(--bs-secondary-color);
    margin: 0;
}
</style>
