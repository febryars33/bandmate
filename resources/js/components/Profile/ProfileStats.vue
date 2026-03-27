<template>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row text-center">
                <div class="col">
                    <h5 class="mb-0">{{ profile.connections_count }}</h5>
                    <small class="text-muted">Connections</small>
                </div>

                <div class="col">
                    <h5 class="mb-0">{{ profile.projects_count }}</h5>
                    <small class="text-muted">Projects</small>
                </div>

                <div class="col">
                    <h5 class="mb-0">{{ profile.experiences.length }}</h5>
                    <small class="text-muted">Experiences</small>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import type { Profile } from '@/types/profile'

defineProps<{
    profile: Profile
}>()
</script>
