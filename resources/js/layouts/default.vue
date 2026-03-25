<template>
    <BApp>
        <header>
            <Navbar />
        </header>

        <main id="wrapper" class="flex-grow-1 py-4 py-lg-5">
            <slot />
        </main>

        <Footer />
    </BApp>
</template>

<script lang="ts" setup>
import Footer from '@/components/Footer.vue'
import Navbar from '@/components/Navbar.vue'
</script>
