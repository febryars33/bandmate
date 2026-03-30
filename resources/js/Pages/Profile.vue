<template>
    <Head>
        <title>{{ musician.real_name }} (@{{ user.username }})</title>
    </Head>

    <div class="container py-4 py-lg-5 profile-page">
        <!-- <ProfileHeader :profile="profile" :musician="musician" :user="user" :username="user.username" />

        <div class="row">
            <div class="col-lg-3">
                <ProfileStats :profile="profile" />
                <ProfileSkills :instruments="musician.instruments" :genres="musician.genres" />
            </div>
            <div class="col-lg-9">
                <ProfileAbout :about="musician.about" :musician="musician" :username="user.username" />
                <ProfileExperience :experiences="profile.experiences" />
            </div>
        </div> -->
    </div>
</template>

<script lang="ts" setup>
import '@/components/Profile/profile.css'
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
