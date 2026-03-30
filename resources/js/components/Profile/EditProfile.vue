<template>
    <div class="profile-card profile-animate p-4 mb-4">
        <h5 class="fw-bold mb-4">Edit Profil</h5>
        <div class="d-flex align-items-center mb-5">
            <div class="position-relative me-4">
                <img
                    alt="Profile"
                    class="rounded-circle border border-4 border-white shadow-sm"
                    referrerpolicy="no-referrer"
                    src="https://picsum.photos/seed/user1/120/120"
                    style="width: 120px; height: 120px; object-fit: cover"
                /><button
                    class="btn btn-primary btn-sm rounded-circle position-absolute bottom-0 end-0 p-2 shadow d-inline-flex align-items-center justify-content-center"
                    style="width: 40px; height: 40px"
                >
                    <i class="bi bi-camera" />
                </button>
            </div>
            <div>
                <h6 class="fw-bold mb-1">Foto Profil</h6>
                <p class="text-muted small mb-0">JPG, GIF atau PNG. Ukuran maksimal 2MB.</p>
            </div>
        </div>
        <form>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Nama Lengkap</label>
                    <input class="form-control" type="text" value="Andi Pratama" />
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold">Tentang</label>
                    <textarea class="form-control" rows="4">
                        Halo! Saya Andi Pratama, seorang drummer yang berfokus pada genre rock, metal, dan blues.
                    </textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Kota</label
                    ><select class="form-select">
                        <option>Bandung</option>
                        <option>Jakarta</option>
                        <option>Surabaya</option>
                        <option>Yogyakarta</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Status Ketersediaan</label
                    ><select class="form-select">
                        <option>Available for Band</option>
                        <option>Looking for Project</option>
                        <option>Busy / Not Available</option>
                    </select>
                </div>
            </div>
            <div class="mt-5 pt-4 border-top d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-secondary px-4">Batal</button
                ><button type="submit" class="btn btn-primary px-4 d-flex align-items-center">
                    <i class="bi bi-floppy2-fill me-2" />
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</template>

<script lang="ts" setup></script>
