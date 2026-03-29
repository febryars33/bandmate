<template>
    <Head>
        <title>{{ musician.real_name }} (@{{ user.username }})</title>
    </Head>

    <div class="container py-4 py-lg-5 profile-page">
        <!-- Hero header — full width -->
        <ProfileHeader :profile="profile" :musician="musician" :user="user" :username="user.username" />

        <!-- Two-column grid below header -->
        <div class="profile-grid">
            <!-- Left column: Stats + About + Skills -->
            <aside class="profile-aside">
                <ProfileStats :profile="profile" />
                <ProfileSkills :instruments="musician.instruments" :genres="musician.genres" />
            </aside>

            <!-- Right column: Experience (wider) -->
            <section class="profile-main">
                <ProfileAbout :about="musician.about" :musician="musician" :username="user.username" />
                <ProfileExperience :experiences="profile.experiences" />
            </section>
        </div>
    </div>
</template>

<script lang="ts" setup>
import '@/components/Profile/profile.css'
import ProfileAbout from '@/components/Profile/ProfileAbout.vue'
import ProfileExperience from '@/components/Profile/ProfileExperience.vue'
import ProfileHeader from '@/components/Profile/ProfileHeader.vue'
import ProfileSkills from '@/components/Profile/ProfileSkills.vue'
import ProfileStats from '@/components/Profile/ProfileStats.vue'
import type { Musician } from '@/types/models/musician'
import type { User } from '@/types/models/user'
import type { Profile } from '@/types/profile'
import { Head } from '@inertiajs/vue3'

defineProps<{
    profile: Profile
    musician: Musician
    user: User
}>()
</script>

<style scoped>
.profile-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 0;
}

@media (min-width: 768px) {
    .profile-grid {
        grid-template-columns: 320px 1fr;
        gap: 0 1.25rem;
        align-items: start;
    }
}
</style>
