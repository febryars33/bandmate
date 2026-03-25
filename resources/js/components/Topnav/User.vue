<template>
    <!-- User -->
    <div class="d-flex ms-auto d-xl-none">
        <div class="dropdown my-n2">
            <a class="btn btn-link d-inline-flex align-items-center dropdown-toggle" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <span class="avatar avatar-sm avatar-status avatar-status-success me-3">
                    <img class="avatar-img" src="https://placehold.co/250x250" alt="..." />
                </span>
                <span class="d-none d-xl-block">John Williams</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="./account/account.html">Account</a></li>
                <li><a class="dropdown-item" href="./auth/password-reset.html" target="_blank">Change
                        password</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>

        <!-- Divider -->
        <div class="vr align-self-center bg-dark mx-2"></div>
    </div>
</template>
