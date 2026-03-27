<template>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <!-- Avatar -->
                <div class="col-md-2 text-center">
                    <img :src="profile.avatar" class="rounded-circle img-fluid" style="max-width: 120px" alt="avatar" />
                </div>

                <!-- Info -->
                <div class="col-md-7">
                    <h4 class="mb-0">{{ musician.real_name }}</h4>
                    <small class="text-muted">@{{ user.username }}</small>

                    <p class="mb-1 mt-2 fw-semibold">
                        {{ musician.bio }}
                    </p>

                    <p class="text-muted mb-0">📍 Bandung, Jawa Barat</p>
                </div>

                <!-- CTA -->
                <div class="col-md-3 text-md-end mt-3 mt-md-0">
                    <button class="btn btn-primary w-100 mb-2">Connect</button>

                    <span class="badge" :class="statusClass">
                        {{ statusLabel }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import type { Musician } from '@/types/models/musician'
import type { User } from '@/types/models/user'
import type { Profile } from '@/types/profile'
import { computed } from 'vue'

const props = defineProps<{
    profile: Profile
    musician: Musician
    user: User
}>()

const statusLabel = computed(() => {
    switch (props.profile.collaboration_status) {
        case 'open':
            return 'Open to Collaborate'
        case 'looking':
            return 'Looking for Members'
        default:
            return 'Not Available'
    }
})

const statusClass = computed(() => {
    switch (props.profile.collaboration_status) {
        case 'open':
            return 'bg-success'
        case 'looking':
            return 'bg-warning text-dark'
        default:
            return 'bg-secondary'
    }
})
</script>
