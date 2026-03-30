<template>
    <BApp>
        <div class="app-layout">
            <!-- <header>
                <Navbar />
            </header> -->

            <!-- min-vh-100 d-flex flex-column -->
            <main class="app-main flex-grow-1">
                <slot />
            </main>

            <!-- <Footer /> -->
        </div>
    </BApp>
</template>

<script lang="ts" setup></script>

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
