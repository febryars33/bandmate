<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta type="description" :content="meta.description" />
    </Head>

    <div>
        <Hero />

        <RecruitmentComponent :recruitments="recruitments" />

        <MusicianComponent :musicians="musicians" />

        <!-- <Event /> -->
    </div>
</template>

<script lang="ts" setup>
import Hero from '@/components/Home/Hero.vue'
import MusicianComponent from '@/components/Home/Musician.vue'
import RecruitmentComponent from '@/components/Home/Recruitment.vue'
import type { Musician } from '@/types/models/musician'
import type { Recruitment } from '@/types/models/recruitment'
import { Head } from '@inertiajs/vue3'

defineProps<{
    recruitments: Recruitment[]
    musicians: Musician[]
    meta: {
        title: string
        description: string
    }
}>()
</script>
