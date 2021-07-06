/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


Vue.component('users-component', require('./components/UsersComponent.vue').default);
Vue.component('edit-user-component', require('./components/EditUserComponent.vue').default);

Vue.component('profile-component', require('./components/ProfileComponent.vue').default);

Vue.component('client-component', require('./components/ClientComponent.vue').default);

Vue.component(
    "client-crud-component",
    require("./components/ClientCrudComponent.vue").default
);

Vue.component(
    "products-kits-component",
    require("./components/ProductsAndKitsComponent.vue").default
);
Vue.component(
    "client-contact-component",
    require("./components/ClientContactComponent.vue").default
);
Vue.component(
    "client-list-component",
    require("./components/ClientListComponent.vue").default
);
Vue.component(
    "rate-component",
    require("./components/RateComponent.vue").default
);


Vue.component('client-new-rate-component', require('./components/ClientNewRateComponent.vue').default);
Vue.component('client-new-warranty-component', require('./components/ClientNewWarrantyComponent.vue').default);
Vue.component('client-mesa-component', require('./components/ClientMesaComponent.vue').default);
Vue.component("client-aux-mesa-component",require("./components/ClientAuxMesaComponent.vue").default);

Vue.component('list-component', require('./components/ListComponent.vue').default);
Vue.component('listkits-component', require('./components/ListKitsComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

