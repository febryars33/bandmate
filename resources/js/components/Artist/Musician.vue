<template>
    <ul class="list-group list-group-flush">
        <li v-for="musician in props.musicians" class="list-group-item" :key="musician.id">
            <div class="row">
                <div class="col-lg-6">
                    <h6 class="m-0 fw-bold">
                        <a v-if="musician.musician" role="button" class="link-body-emphasis">
                            {{ musician.name }}
                        </a>
                        <template v-else>
                            {{ musician.name }}
                        </template>
                    </h6>
                    <span class="text-muted small">
                        <template v-if="musician.joined_at">
                            {{ new Intl.DateTimeFormat('en-US', { year: 'numeric' }).format(new Date(musician.joined_at)) }}
                        </template>
                        -
                        <template v-if="musician.left_at">
                            {{ new Intl.DateTimeFormat('en-US', { year: 'numeric' }).format(new Date(musician.left_at)) }}
                        </template>
                        <template v-if="musician && musician.left_at === null"> Present </template>
                    </span>
                </div>
                <div class="col-lg-6 align-self-center">
                    <span
                        v-for="(instrument, index) in musician.instruments"
                        :key="instrument"
                        class="badge rounded-pill bg-info-subtle text-info border border-info-subtle"
                        :class="{ 'me-2': index !== musician.instruments.length - 1 }"
                    >
                        {{ instrument }}
                    </span>
                </div>
            </div>
            <!-- <div class="text-muted small">
                See also:
                <a role="button" class="link-primary"> Saosin </a>, <a role="button" class="link-primary"> Story Of The Year </a>,
                <a role="button" class="link-primary"> For Revenge </a>
            </div> -->
        </li>
    </ul>
</template>

<script lang="ts" setup>
import type { ArtistMusician } from '@/types/models/pivots/artist_musician'

interface Props {
    musicians: ArtistMusician[]
}

const props = defineProps<Props>()
</script>
