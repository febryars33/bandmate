<template>
    <aside class="bsb-sidebar-1 offcanvas offcanvas-start" tabindex="-1" id="bsbSidebar1" aria-labelledby="bsbSidebarLabel1">
        <div class="offcanvas-header">
            <Link class="sidebar-brand" :href="home()" preserve-state preserve-scroll>
                <img src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" id="bsbSidebarLabel1" class="bsb-tpl-logo" />
            </Link>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body pt-0">
            <hr class="sidebar-divider mb-3" />
            <ul class="navbar-nav">
                <li class="nav-item">
                    <Link class="nav-link p-3 rounded" :href="home()" preserve-state preserve-scroll>
                        <div class="nav-link-icon text-primary">
                            <i class="bi bi-grid" />
                        </div>
                        <span class="nav-link-text fw-bold">Home</span>
                    </Link>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="py-1 text-muted text-uppercase fs-7">Tools</h6>
                </li>

                <!-- <li class="nav-item">
                    <Link class="nav-link p-3 rounded" :href="users.index()" preserve-state preserve-scroll>
                        <div class="nav-link-icon text-primary">
                            <i class="bi bi-person" />
                        </div>
                        <span class="nav-link-text fw-bold">User</span>
                    </Link>
                </li> -->

                <li class="nav-item">
                    <a
                        class="nav-link p-3"
                        data-bs-toggle="collapse"
                        href="#componentExamples"
                        role="button"
                        aria-expanded="false"
                        aria-controls="componentExamples"
                    >
                        <div class="nav-link-icon text-primary">
                            <i class="bi bi-menu-button-wide-fill" />
                        </div>
                        <span class="nav-link-text fw-bold">Components</span>
                    </a>
                    <div class="collapse" id="componentExamples">
                        <ul class="nav flex-column ms-4">
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="components-accordion.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short" />
                                    </div>
                                    <span class="nav-link-text">Accordion</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="components-alerts.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short" />
                                    </div>
                                    <span class="nav-link-text">Alerts</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="components-buttons.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short" />
                                    </div>
                                    <span class="nav-link-text">Buttons</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="components-card.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short" />
                                    </div>
                                    <span class="nav-link-text">Card</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link p-3"
                        data-bs-toggle="collapse"
                        href="#formExamples"
                        role="button"
                        aria-expanded="false"
                        aria-controls="formExamples"
                    >
                        <div class="nav-link-icon text-primary">
                            <i class="bi bi-ui-radios"></i>
                        </div>
                        <span class="nav-link-text fw-bold">Forms</span>
                    </a>
                    <div class="collapse" id="formExamples">
                        <ul class="nav flex-column ms-4">
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="forms-layout.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Layouts</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="forms-validation.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Validation</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link p-3"
                        data-bs-toggle="collapse"
                        href="#iconExamples"
                        role="button"
                        aria-expanded="false"
                        aria-controls="iconExamples"
                    >
                        <div class="nav-link-icon text-primary">
                            <i class="bi bi-flower2"></i>
                        </div>
                        <span class="nav-link-text fw-bold">Icons</span>
                    </a>
                    <div class="collapse" id="iconExamples">
                        <ul class="nav flex-column ms-4">
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="bootstrap-icons.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Bootstrap</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link p-3"
                        data-bs-toggle="collapse"
                        href="#tableExamples"
                        role="button"
                        aria-expanded="false"
                        aria-controls="tableExamples"
                    >
                        <div class="nav-link-icon text-primary">
                            <i class="bi bi-layout-text-window-reverse"></i>
                        </div>
                        <span class="nav-link-text fw-bold">Tables</span>
                    </a>
                    <div class="collapse" id="tableExamples">
                        <ul class="nav flex-column ms-4">
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="tables-basic.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Basic</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="tables-accented.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Accented</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="py-1 text-muted text-uppercase fs-7">Addons</h6>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link p-3"
                        data-bs-toggle="collapse"
                        href="#cardExamples"
                        role="button"
                        aria-expanded="false"
                        aria-controls="cardExamples"
                    >
                        <div class="nav-link-icon text-primary">
                            <i class="bi bi-card-heading"></i>
                        </div>
                        <span class="nav-link-text fw-bold">Cards</span>
                    </a>
                    <div class="collapse" id="cardExamples">
                        <ul class="nav flex-column ms-4">
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="cards-stats.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Stats</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="cards-tables.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Tables</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="cards-timelines.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Timelines</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link p-3"
                        data-bs-toggle="collapse"
                        href="#calendarExamples"
                        role="button"
                        aria-expanded="false"
                        aria-controls="calendarExamples"
                    >
                        <div class="nav-link-icon text-primary">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <span class="nav-link-text fw-bold">Calendars</span>
                    </a>
                    <div class="collapse" id="calendarExamples">
                        <ul class="nav flex-column ms-4">
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="calendars-basic.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Basic</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link p-3"
                        data-bs-toggle="collapse"
                        href="#chartExamples"
                        role="button"
                        aria-expanded="false"
                        aria-controls="chartExamples"
                    >
                        <div class="nav-link-icon text-primary">
                            <i class="bi bi-bar-chart"></i>
                        </div>
                        <span class="nav-link-text fw-bold">Charts</span>
                    </a>
                    <div class="collapse" id="chartExamples">
                        <ul class="nav flex-column ms-4">
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="apex-charts.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Apex</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link p-3"
                        data-bs-toggle="collapse"
                        href="#mapExamples"
                        role="button"
                        aria-expanded="false"
                        aria-controls="mapExamples"
                    >
                        <div class="nav-link-icon text-primary">
                            <i class="bi bi-map"></i>
                        </div>
                        <span class="nav-link-text fw-bold">Maps</span>
                    </a>
                    <div class="collapse" id="mapExamples">
                        <ul class="nav flex-column ms-4">
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="jsvectormap-maps.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Vector Maps</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="py-1 text-muted text-uppercase fs-7">Extras</h6>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link p-3 bg-light rounded active"
                        data-bs-toggle="collapse"
                        href="#pageExamples"
                        role="button"
                        aria-expanded="true"
                        aria-controls="pageExamples"
                    >
                        <div class="nav-link-icon text-primary">
                            <i class="bi bi-folder"></i>
                        </div>
                        <span class="nav-link-text fw-bold">Pages</span>
                    </a>
                    <div class="collapse show" id="pageExamples">
                        <ul class="nav flex-column ms-4">
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="pages-profile.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Profile</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="pages-invoice.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Invoice</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="pages-pricing.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Pricing</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="pages-contact.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Contact</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="pages-faqs.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">FAQs</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary active" aria-current="page" href="pages-blank.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Blank</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="pages-error-404.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Error 404</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link p-3"
                        data-bs-toggle="collapse"
                        href="#authExamples"
                        role="button"
                        aria-expanded="false"
                        aria-controls="authExamples"
                    >
                        <div class="nav-link-icon text-primary">
                            <i class="bi bi-gear"></i>
                        </div>
                        <span class="nav-link-text fw-bold">Authentication</span>
                    </a>
                    <div class="collapse" id="authExamples">
                        <ul class="nav flex-column ms-4">
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="auth-login.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Log In</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="auth-register.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Register</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="auth-reset-password.html">
                                    <div class="nav-link-icon text-primary-emphasis">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                    <span class="nav-link-text">Reset Password</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </aside>
</template>

<script setup lang="ts">
import { home } from '@/routes'
import { Link } from '@inertiajs/vue3'
// import users from '@/routes/users';
</script>
