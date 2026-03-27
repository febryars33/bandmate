<template>
    <div class="app-layout">
        <header>
            <Navbar />
        </header>

        <main class="app-main flex-grow-1">
            <slot />
        </main>

        <Footer />
    </div>
</template>

<script lang="ts" setup>
import Footer from '@/components/Footer.vue'
import Navbar from '@/components/Navbar/Navbar.vue'
</script>

<style>
:root {
    --nb-height: 64px;
}

.app-layout {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.app-main {
    padding-top: calc(var(--nb-height) + 1.5rem);
}
</style>
