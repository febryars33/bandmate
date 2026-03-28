<template>
    <div class="container py-5">
        <Link class="text-primary text-decoration-none small fw-bold d-flex align-items-center" :href="events.index()">
            <i class="bi bi-arrow-left ms-3" />
            Kembali ke Daftar Event
        </Link>
        <div class="row g-4 mt-1">
            <div class="col-12">
                <div class="card overflow-hidden shadow-sm border-0 rounded-5">
                    <div class="position-relative" style="height: 500px">
                        <img
                            alt="Event Banner"
                            class="w-100 h-100 object-fit-cover"
                            referrerpolicy="no-referrer"
                            src="https://picsum.photos/seed/event13/1200/600"
                        />
                        <div
                            class="position-absolute bottom-0 start-0 w-100 p-4 p-md-5 bg-gradient-to-t from-black/80 via-black/40 to-transparent text-white"
                        >
                            <div class="d-flex gap-2 mb-3">
                                <span class="badge bg-primary px-3 py-2 rounded-3 small fw-bold">Festival</span
                                ><span class="badge bg-warning px-3 py-2 rounded-3 small fw-bold">Upcoming</span>
                            </div>
                            <h1 class="display-4 fw-bold mb-3 tracking-tight">Hammersonic Fest 2026</h1>
                            <div class="d-flex flex-wrap gap-4 opacity-90">
                                <p class="mb-0 d-flex align-items-center">
                                    <i class="bi bi-calendar me-2 text-primary" />
                                    15 Mei 2026 · 10:00 WIB
                                </p>
                                <p class="mb-0 d-flex align-items-center">
                                    <i class="bi bi-geo-alt-fill me-2 text-primary" />
                                    Carnaval Circuit Ancol, Jakarta
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card p-4 mb-4 shadow-sm border-0 rounded-4">
                    <h5 class="fw-bold mb-4 small text-uppercase">Deskripsi Event</h5>
                    <p class="mb-5">
                        Hammersonic Fest adalah festival musik metal terbesar di Asia Tenggara yang diadakan setiap tahun di Jakarta, Indonesia.
                        Festival ini telah menjadi kiblat bagi para pecinta musik keras di seluruh wilayah Asia dan sekitarnya. Tahun 2026 ini,
                        Hammersonic kembali hadir dengan konsep yang lebih megah dan line-up internasional yang spektakuler.
                    </p>
                    <h5 class="fw-bold mb-4 small text-uppercase">Line-up Artists</h5>
                    <div class="row g-3 mb-5">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border-0 rounded-4 shadow-sm">
                                <div class="me-3 shadow-sm rounded-circle overflow-hidden" style="width: 56px; height: 56px">
                                    <img
                                        alt="Slipknot"
                                        class="w-100 h-100 object-fit-cover"
                                        referrerpolicy="no-referrer"
                                        src="https://picsum.photos/seed/artist0/100/100"
                                    />
                                </div>
                                <h6 class="fw-bold mb-0">Slipknot</h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border-0 rounded-4 shadow-sm">
                                <div class="me-3 shadow-sm rounded-circle overflow-hidden" style="width: 56px; height: 56px">
                                    <img
                                        alt="Lamb of God"
                                        class="w-100 h-100 object-fit-cover"
                                        referrerpolicy="no-referrer"
                                        src="https://picsum.photos/seed/artist1/100/100"
                                    />
                                </div>
                                <h6 class="fw-bold mb-0">Lamb of God</h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border-0 rounded-4 shadow-sm">
                                <div class="me-3 shadow-sm rounded-circle overflow-hidden" style="width: 56px; height: 56px">
                                    <img
                                        alt="Burgerkill"
                                        class="w-100 h-100 object-fit-cover"
                                        referrerpolicy="no-referrer"
                                        src="https://picsum.photos/seed/artist2/100/100"
                                    />
                                </div>
                                <h6 class="fw-bold mb-0">Burgerkill</h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border-0 rounded-4 shadow-sm">
                                <div class="me-3 shadow-sm rounded-circle overflow-hidden" style="width: 56px; height: 56px">
                                    <img
                                        alt="Deadsquad"
                                        class="w-100 h-100 object-fit-cover"
                                        referrerpolicy="no-referrer"
                                        src="https://picsum.photos/seed/artist3/100/100"
                                    />
                                </div>
                                <h6 class="fw-bold mb-0">Deadsquad</h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border-0 rounded-4 shadow-sm">
                                <div class="me-3 shadow-sm rounded-circle overflow-hidden" style="width: 56px; height: 56px">
                                    <img
                                        alt="Seringai"
                                        class="w-100 h-100 object-fit-cover"
                                        referrerpolicy="no-referrer"
                                        src="https://picsum.photos/seed/artist4/100/100"
                                    />
                                </div>
                                <h6 class="fw-bold mb-0">Seringai</h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border-0 rounded-4 shadow-sm">
                                <div class="me-3 shadow-sm rounded-circle overflow-hidden" style="width: 56px; height: 56px">
                                    <img
                                        alt="Voice of Baceprot"
                                        class="w-100 h-100 object-fit-cover"
                                        referrerpolicy="no-referrer"
                                        src="https://picsum.photos/seed/artist5/100/100"
                                    />
                                </div>
                                <h6 class="fw-bold mb-0">Voice of Baceprot</h6>
                            </div>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-4 small text-uppercase">Penyelenggara</h5>
                    <div class="d-flex align-items-center p-4 rounded-4 border-0 mb-2 shadow-sm">
                        <div class="me-3 shadow-sm rounded-circle overflow-hidden" style="width: 56px; height: 56px">
                            <img
                                alt="Organizer"
                                class="w-100 h-100 object-fit-cover"
                                referrerpolicy="no-referrer"
                                src="https://picsum.photos/seed/organizer/100/100"
                            />
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Ravel Entertainment</h6>
                            <p class="small mb-0">Event Organizer · Jakarta</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px">
                    <div class="card p-4 shadow-lg border-0 rounded-4">
                        <h5 class="fw-bold mb-4 d-flex align-items-center">
                            <i class="bi bi-shield-check text-primary me-2" />
                            Informasi Tiket
                        </h5>
                        <div class="p-4 bg-primary-subtle rounded-4 mb-4 border-0">
                            <p class="text-primary small mb-2 fw-bold text-uppercase">Tiket tersedia melalui partner resmi</p>
                            <h3 class="fw-bold text-primary mb-0">Mulai Rp 850.000</h3>
                        </div>
                        <button class="btn btn-primary btn-lg w-100 mb-4 d-flex align-items-center justify-content-center fw-bold py-3 shadow-sm">
                            Beli Tiket
                            <i class="bi bi-shield-check ms-2" />
                        </button>
                        <p class="text-center small mb-0 px-2">* Anda akan diarahkan ke platform tiket pihak ketiga (Partner Resmi)</p>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-5 pt-5">
                <div class="text-center mb-5">
                    <h5 class="fw-bold text-uppercase tracking-widest small mb-5">Sponsor</h5>
                    <div class="row g-4 justify-content-center align-items-center">
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
                            <div class="p-3 grayscale hover-grayscale-0 opacity-60 hover-opacity-100" title="IM3">
                                <img
                                    alt="IM3"
                                    class="sponsor-logo img-fluid max-h-12 object-fit-contain"
                                    src="https://upload.wikimedia.org/wikipedia/commons/6/68/Logo_IM3.svg"
                                />
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
                            <div class="p-3 grayscale hover-grayscale-0 opacity-60 hover-opacity-100" title="Ardan Radio">
                                <img
                                    alt="Ardan Radio"
                                    class="sponsor-logo img-fluid max-h-12 object-fit-contain"
                                    src="https://upload.wikimedia.org/wikipedia/id/b/b1/Logo_Ardan_Radio.png"
                                />
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
                            <div class="p-3 grayscale hover-grayscale-0 opacity-60 hover-opacity-100" title="Djarum Super">
                                <img
                                    alt="Djarum Super"
                                    class="sponsor-logo img-fluid max-h-12 object-fit-contain"
                                    src="https://upload.wikimedia.org/wikipedia/commons/0/07/Djarum_Super_%28Alt_Horizontal%29.svg"
                                />
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
                            <div class="p-3 grayscale hover-grayscale-0 opacity-60 hover-opacity-100" title="Coca-Cola">
                                <img
                                    alt="Coca-Cola"
                                    class="sponsor-logo img-fluid max-h-12 object-fit-contain"
                                    src="https://upload.wikimedia.org/wikipedia/commons/c/ce/Coca-Cola_logo.svg"
                                />
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
                            <div class="p-3 grayscale hover-grayscale-0 opacity-60 hover-opacity-100" title="Bank Mandiri">
                                <img
                                    alt="Bank Mandiri"
                                    class="sponsor-logo img-fluid max-h-12 object-fit-contain"
                                    src="https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg"
                                />
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
                            <div class="p-3 grayscale hover-grayscale-0 opacity-60 hover-opacity-100" title="Grab">
                                <img
                                    alt="Grab"
                                    class="sponsor-logo img-fluid max-h-12 object-fit-contain"
                                    src="https://upload.wikimedia.org/wikipedia/commons/f/f6/Grab_Logo.svg"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import events from '@/routes/events'
import { Link } from '@inertiajs/vue3'
</script>
