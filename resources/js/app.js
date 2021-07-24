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

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    // data: {
    //     querySearch: "",
    //     api_key: "SznQN02yzAXGOlDubCqT3PTfefEyd5Go",
    // },
    // methods: {
    //     // if there are results
    //     // the position of the first result on the array of results 
    //     // were passed to the moveMap function
    //     handleResults(result) {
    //         console.log(result)

    //         // if (result.results) {
    //         //     moveMap(result.results[0].position)
    //         // }

    //         // var marker = new tt.Marker()
    //         // .setLngLat(result.results[0].position)
    //         // .addTo(map);
    //     },

    //     // search for locations based on the query 
    //     // results were passed through the handleResults function
    //     search() {
    //         tt.services.fuzzySearch({
    //             key: this.api_key,
    //             query: this.querySearch,
    //             // boundingBox: map.getBounds()

    //         }).go().then(handleResults);
    //     }
    // }
});
