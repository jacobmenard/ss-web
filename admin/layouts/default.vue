<script lang="ts" setup>

</script>

<template>
    <div class="default-container">

        <div class="header-container w-100 d-flex align-items-center justify-content-between gap-16 position-fixed top-0 start-0 shadow-sm">
            <nuxt-link to="/dashboard" class="header-button d-flex align-items-center justify-content-center">
                <span>
                    SIPS
                    <span class="symbol">&</span>
                    SPARKS
                </span>
            </nuxt-link>
        </div>

        <div class="page-container">
            <slot></slot>
        </div>


        <div class="sidebar-container w-100 d-flex flex-column align-items-star position-fixed top-0 start-0 shadow-sm">
            <div class="menu w-100 px-3 py-2">
                <nuxt-link to="/dashboard" class="menu-item d-flex align-items-center justify-content-center">
                    <span class="fw-bold">Dashboard</span>
                </nuxt-link>
            </div>
            <div class="menu w-100 px-3 py-2">
                <nuxt-link to="/events" class="menu-item d-flex align-items-center justify-content-center">
                    <span class="fw-bold">Events</span>
                </nuxt-link>
            </div>
            
            <div class="menu w-100 px-3 py-2">
                <nuxt-link to="/attendees" class="menu-item d-flex align-items-center justify-content-center">
                    <span class="fw-bold">Attendees</span>
                </nuxt-link>
            </div>
        </div>

    </div>
</template>

<style lang="scss" scoped>
    .default-container {
        .header-container {
            height: 50px;
            padding: 0 2rem;
            background-color: $red1;
            .header-button {
                text-decoration: unset !important;
                span {
                    @include bugaki-font(18px, normal, 900, $white1) {
                        .symbol {
                            font-family: 'Montserrat', sans-serif !important;
                        }
                    }
                }
            }
            z-index: 11;
        }

        .page-container {
            height: 100vh;
            width: 100vw;
            left: 0;
            padding: 50px 2rem 2rem 270px;
        }

        .sidebar-container {
            max-width: 250px;
            background-color: $white2;
            height: 100vh;
            z-index: 10;
            padding-top: 60px;
            .menu {
                &:hover {
                    background-color: $red1;
                    transition: 0.3s;
                    .menu-item {
                        color: $white2;
                    }
                }

                .menu-item {
                    color: $red1;
                    text-decoration: unset;
                }
            }
        }
    }
</style>
