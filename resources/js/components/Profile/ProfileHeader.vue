<template>
    <div class="profile-card profile-animate mb-4">
        <!-- ─── Cover ──────────────────────────────────────────────────────── -->
        <div class="cover-bg" :style="coverStyle" aria-hidden="true">
            <div class="cover-overlay" />
        </div>

        <!-- ─── Body ───────────────────────────────────────────────────────── -->
        <div class="header-body">
            <!-- Avatar -->
            <div class="position-relative flex-shrink-0">
                <img :src="profile.avatar" :alt="`${musician.real_name} avatar`" class="avatar-img" />
                <span
                    class="avatar-status position-absolute bottom-0 end-0 border border-2 border-body rounded-circle"
                    :class="statusDotClass"
                    :title="statusLabel"
                />
            </div>

            <!-- Identity -->
            <div class="flex-grow-1 min-w-0 pb-1">
                <!-- Name row -->
                <div class="d-flex flex-wrap align-items-start justify-content-between gap-2 mb-2">
                    <div>
                        <h4 class="header-name mb-0">{{ musician.real_name }}</h4>
                        <span class="text-muted" style="font-size: 0.825rem"> @{{ user.username }} </span>
                    </div>
                </div>

                <!-- Bio — inline editable hanya untuk pemilik profil -->
                <template v-if="useAuth().check()">
                    <p
                        v-if="!bioEditActive"
                        class="header-bio mb-2"
                        :class="{ 'text-muted fst-italic': !musician.bio && isOwner }"
                        @click="isOwner && activateBioEdit()"
                        :role="isOwner ? 'button' : undefined"
                        :title="isOwner ? 'Klik untuk mengedit bio' : undefined"
                    >
                        <template v-if="musician.bio">
                            <SafeHtml :content="musician.bio" />
                        </template>
                        <template v-else-if="isOwner">Belum ada bio. Klik untuk menambahkan.</template>
                    </p>

                    <!-- Input bio — auto-focus saat aktif, hilang saat blur / Enter / Esc -->
                    <div v-else class="col-lg-6">
                        <input
                            ref="bioInputRef"
                            v-model="bioValue"
                            type="text"
                            class="form-control form-control-sm mb-2 col-lg-6"
                            placeholder="Tulis bio singkat..."
                            maxlength="160"
                            @blur="deactivateBioEdit"
                            @keydown.enter="deactivateBioEdit"
                            @keydown.esc="cancelBioEdit"
                        />
                    </div>
                </template>

                <!-- Meta -->
                <div class="d-flex flex-wrap gap-3">
                    <span class="d-inline-flex align-items-center gap-1" style="font-size: 0.8rem">
                        <i class="bi bi-geo-alt-fill text-danger" />
                        Bandung, Jawa Barat
                    </span>
                    <span class="text-muted" v-if="musician.created_at">
                        Bergabung sejak
                        {{
                            new Intl.DateTimeFormat('en-US', { year: 'numeric' }).format(
                                musician.created_at ? new Date(musician.created_at) : new Date(),
                            )
                        }}
                    </span>
                </div>
            </div>

            <!-- CTA — hanya tampil untuk non-owner -->
            <!-- <div class="header-cta pb-1" v-if="!isOwner">
                <button class="btn btn-primary btn-follow w-100">Ikuti</button>
            </div> -->
        </div>
    </div>
</template>

<script lang="ts" setup>
import { useAuth } from '@/composables/useAuth'
import { update } from '@/routes/profile'
import type { Musician } from '@/types/models/musician'
import type { User } from '@/types/models/user'
import type { Profile } from '@/types/profile'
import { useForm, usePage } from '@inertiajs/vue3'
import { computed, nextTick, ref } from 'vue'
import SafeHtml from '../SafeHtml.vue'

// ─── Props ────────────────────────────────────────────────────────────────────
const props = defineProps<{
    username: string
    profile: Profile
    musician: Musician
    user: User
}>()

// ─── Auth / Ownership ─────────────────────────────────────────────────────────
const page = usePage()

const isOwner = computed(() => props.username === page.props.auth.user.username)

// ─── Cover ────────────────────────────────────────────────────────────────────
const coverStyle = computed(() => ({
    backgroundImage: `url(${props.profile.avatar})`,
}))

// ─── Collaboration Status ─────────────────────────────────────────────────────
const STATUS_LABELS: Record<string, string> = {
    open: 'Open to Collaborate',
    looking: 'Looking for Members',
}

const STATUS_DOTS: Record<string, string> = {
    open: 'bg-success',
    looking: 'bg-warning',
}

const statusLabel = computed(() => STATUS_LABELS[props.profile.collaboration_status] ?? 'Not Available')

const statusDotClass = computed(() => STATUS_DOTS[props.profile.collaboration_status] ?? 'bg-secondary')

// ─── Bio Inline Edit ──────────────────────────────────────────────────────────
const bioEditActive = ref(false)
const bioInputRef = ref<HTMLInputElement | null>(null)
const bioValue = ref(props.musician.bio ?? '')
const bioSnapshot = ref('')

async function activateBioEdit() {
    bioSnapshot.value = bioValue.value
    bioEditActive.value = true
    await nextTick()
    bioInputRef.value?.focus()
}

function deactivateBioEdit() {
    if (bioValue.value !== bioSnapshot.value) {
        // TODO: emit ke parent atau panggil Inertia form.patch di sini
        // emit('update:bio', bioValue.value)
        useForm({
            _patch: true,
            fields: {
                bio: bioValue.value,
            },
        }).patch(update(props.username).url)
    }
    bioEditActive.value = false
}

function cancelBioEdit() {
    bioValue.value = bioSnapshot.value // revert ke nilai semula
    bioEditActive.value = false
}
</script>

<style scoped>
/* ─── Cover ──────────────────────────────────────────────────────────────── */
.cover-bg {
    height: 120px;
    background-size: cover;
    background-position: center 30%;
    filter: blur(18px) saturate(1.4);
    transform: scale(1.05);
    position: relative;
    overflow: hidden;
}

.cover-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(var(--bs-body-bg-rgb), 0) 0%, rgba(var(--bs-body-bg-rgb), 0.7) 100%);
}

/* ─── Body ───────────────────────────────────────────────────────────────── */
.header-body {
    display: flex;
    flex-wrap: wrap;
    gap: 1.25rem;
    padding: 0 1.5rem 1.5rem;
    margin-top: -44px;
    position: relative;
    align-items: flex-end;
}

/* ─── Avatar ─────────────────────────────────────────────────────────────── */
.avatar-img {
    width: 88px;
    height: 88px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--bs-body-bg);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
}

/* dot size tidak bisa murni Bootstrap — perlu custom */
.avatar-status {
    width: 14px;
    height: 14px;
}

/* ─── Typography ─────────────────────────────────────────────────────────── */
.header-name {
    font-size: 1.4rem;
    font-weight: 700;
    letter-spacing: -0.02em;
    line-height: 1.2;
    color: var(--bs-body-color);
}

.header-bio {
    font-size: 0.875rem;
    line-height: 1.5;
}

.header-bio[role='button'] {
    cursor: text;
}

/* ─── CTA ────────────────────────────────────────────────────────────────── */
.header-cta {
    min-width: 120px;
}

.btn-follow {
    font-weight: 600;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(var(--bs-primary-rgb), 0.3);
    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease;
}

.btn-follow:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(var(--bs-primary-rgb), 0.4);
}

/* ─── Responsive ─────────────────────────────────────────────────────────── */
@media (max-width: 767px) {
    .header-body {
        margin-top: -36px;
    }
    .avatar-img {
        width: 72px;
        height: 72px;
    }
    .header-cta {
        width: 100%;
    }
}
</style>
