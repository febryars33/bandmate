<template>
    <Head>
        <title>{{ musician.real_name }} (@{{ user.username }})</title>
    </Head>

    <div class="container py-4">
        <!-- Header -->
        <ProfileHeader :profile="profile" :musician="musician" :user="user" />

        <!-- Stats -->
        <ProfileStats :profile="profile" />

        <!-- About -->
        <ProfileAbout :bio="profile.bio" />

        <!-- Skills -->
        <ProfileSkills :instruments="profile.instruments" :genres="profile.genres" />

        <!-- Experience -->
        <ProfileExperience :experiences="profile.experiences" />
    </div>
</template>

<script lang="ts" setup>
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
