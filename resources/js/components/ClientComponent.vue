<template>
    <div class="client-home">
        <div class="container-fluid">
            <div class="row">
                <div class="card text-center col-md-12">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a
                                    v-bind:class="'nav-link ' + tapU"
                                    v-on:click="activeU"
                                    >Solicitar Cotización</a
                                >
                            </li>
                            <li class="nav-item">
                                <a
                                    v-bind:class="'nav-link ' + tapC"
                                    v-on:click="activeC"
                                    >Solicitar Garantía</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div
                            class="user-team float-left col-md-4"
                            v-if="bandera"
                        >
                           <!--  <div class="i-rate-default">
                                <ul class="list-group" v-if="bandera">
                                    <a
                                        class="btn btn-outline-info"
                                        v-on:click="send()"
                                    >
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center"
                                        >
                                            <img
                                                v-bind:src="profileIcon"
                                                class="profile-icon"
                                                alt=":)"
                                            />
                                            <strong>
                                                Nueva Solicitud de
                                                Cotización</strong
                                            >

                                            <span
                                                class="badge badge-primary badge-pill"
                                            ></span>
                                        </li>
                                    </a>
                                </ul>
                            </div> -->
                        </div>

                        <div
                            class="user-team float-left col-md-4"
                            v-if="!bandera"
                        >
                            <div class="i-warranty-default">
                                <ul class="list-group" v-if="!bandera">
                                <!--     <a class="btn btn-outline-info">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center"
                                        >
                                            <img
                                                v-bind:src="profileIcon"
                                                class="profile-icon"
                                                alt=":)"
                                            />
                                            <strong>
                                                Nueva Solicitud de
                                                Garantía</strong
                                            >

                                            <span
                                                class="badge badge-primary badge-pill"
                                            ></span>
                                        </li>
                                    </a> -->
                                </ul>
                            </div>
                        </div>

                        <client-new-rate-component v-if="new_rate" :data="user">
                        </client-new-rate-component>
                        <client-new-warranty-component
                            v-if="!new_rate"
                            :data="user"
                        >
                        </client-new-warranty-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["data"],
    data() {
        return {
            new_rate: true,
            new_warranty: false,
            user: null,
            users: [],
            selectU: "list-group-item-primary",
            profileIcon: "/android-chrome-96x96.png",
            bandera: true,
            tap: "clientes",
            tapC: "",
            tapU: "active",
        };
    },
    methods: {
        activeU: function () {
            this.tapC = "";
            this.tapU = "active";
            this.tap = "usuarios";
            this.bandera = true;
            this.new_warranty = false;
            this.new_rate = true;
        },
        activeC: function () {
            this.tapC = "active";
            this.tapU = "clientes";
            this.bandera = false;
            this.new_warranty = true;
            this.new_rate = false;
        },
    },
    computed: {},
    mounted: function () {},
    created() {},
};
</script>

<style>
.profile-icon {
    height: 43px;
    width: 43px;
}
</style>
