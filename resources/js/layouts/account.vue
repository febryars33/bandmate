<template>
    <BApp>

        <section class="pb-3 pb-md-4 pb-xl-5">
            <div class="container-lg">

                <slot name="page-header" />

                <!-- Page content -->
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <!-- Nav -->
                        <nav class="nav nav-pills position-sticky flex-column mb-8" id="accountNav" style="top: 32px">
                            <Link class="nav-link" href="/account" :class="{ 'active': $page.url === '/account' }">
                                General
                            </Link>
                            <!-- <a class="nav-link" href="#billing">Billing</a> -->
                            <Link class="nav-link" href="/account/security"
                                :class="{ 'active': $page.url === '/account/security' }">
                                Keamanan
                            </Link>
                            <!-- <a class="nav-link text-danger" href="#">Delete account</a> -->
                        </nav>
                    </div>
                    <div class="col-12 col-lg-9">
                        <slot />
                    </div>
                </div>
            </div>
        </section>
    </BApp>
</template>

<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
</script>
