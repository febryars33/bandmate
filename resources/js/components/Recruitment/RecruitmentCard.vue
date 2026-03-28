<template>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center mt-2">
                    <div class="col-lg-8">
                        <div class="badge bg-primary-subtle text-primary rounded-3 small">Vokalis</div>
                        <h3 class="mb-0 mt-1">{{ recruitment.title }}</h3>
                        <div class="row mb-2">
                            <div class="col-lg-4">
                                <h6>saymenothing</h6>
                            </div>
                            <div class="col-lg-4">
                                <h6>Bandung, Jawa Barat</h6>
                            </div>
                        </div>
                        <p class="m-0 text-muted">
                            {{ recruitment.truncated_description }}
                        </p>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-grid">
                            <Link :href="show(recruitment.slug)" type="button" class="btn btn-primary mb-2">See Detail</Link>
                            <button type="button" class="btn btn-outline-primary">Apply Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { show } from '@/routes/recruitments'
import type { Recruitment } from '@/types/models/recruitment'
import { Link } from '@inertiajs/vue3'

defineProps<{ recruitment: Recruitment }>()
</script>
