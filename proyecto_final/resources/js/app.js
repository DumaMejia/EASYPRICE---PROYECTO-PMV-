/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
window.db = '';
window.generarIdUnicoFecha = ()=>{
    let fecha = new Date();
    return Math.floor(fecha.getTime()/1000).toString(16);
}
window.sockectio = io('http://localhost:3001');
sockectio.on('connect',function(e){
    console.log('Conectado');
});


import Vue from 'vue';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
import VueGeolocation from 'vue-browser-geolocation';
import * as VueGoogleMaps from 'vue2-google-maps'


 
Vue.use(VueGeolocation)
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyBWAatt8ZEDh5BAUW7qdZusQdWB4S_KVlM',
    libraries: 'places', // This is required if you use the Autocomplete plugin
    // OR: libraries: 'places,drawing'
    // OR: libraries: 'places,drawing,visualization'
    // (as you require)
 
    //// If you want to set the version, you can do so:
    // v: '3.26',
  },
 
  //// If you intend to programmatically custom event listener code
  //// (e.g. `this.$refs.gmap.$on('zoom_changed', someFunc)`)
  //// instead of going through Vue templates (e.g. `<GmapMap @zoom_changed="someFunc">`)
  //// you might need to turn this on.
  // autobindAllEvents: false,
 
  //// If you want to manually install components, e.g.
  //// import {GmapMarker} from 'vue2-google-maps/src/components/marker'
  //// Vue.component('GmapMarker', GmapMarker)
  //// then disable the following:
  // installComponents: true,
})


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('comercio-component', require('./components/ComercioComponent.vue').default);
Vue.component('producto-component', require('./components/ProductoComponent.vue').default);
Vue.component('tipo-component', require('./components/TipoComponent.vue').default);
Vue.component('mapa-component', require('./components/MapaComponent.vue').default);
Vue.component('chat-component', require('./components/ChatComponent.vue').default);
Vue.component('basico-component', require('./components/BasicoComponent.vue').default);
Vue.component('v-select-comercios', vSelect);
Vue.component('v-select-tipos', vSelect);
Vue.use(VueGeolocation);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data:{
        forms:{
            comercio:{mostrar:false},
            producto:{mostrar:false},
            tipo:{mostrar:false},
            mapa:{mostrar:false},
            chat:{mostrar:false},
            basico:{mostrar:false},
        }
    },
    methods:{
        abrirForm(form){
            this.forms[form].mostrar = !this.forms[form].mostrar;
            this.$refs[form].obtenerDatos();
            
        },
        abrir(form){
            this.forms[form].mostrar = !this.forms[form].mostrar;
        },
        abrirBd(){
            /**
             * Mecanismos de Almacenamiento
             * 1. WebSQL
             * 2. localStorage
             * 3. IndexedDB
             */
            let indexDb = indexedDB.open('db_sistema', 1);
            indexDb.onupgradeneeded = e=>{
                let db = e.target.result;
                
               let tblcomercio = db.createObjectStore('comercio', {keyPath:'idComercio'});
               let tblproducto = db.createObjectStore('producto', {keyPath:'idProducto'});
                let tbltipo = db.createObjectStore('tipo', {keyPath:'idTipo'});
                let tblbasico = db.createObjectStore('basico', {keyPath:'idBase'});

                tblcomercio.createIndex('idComercio', 'idComercio', {unique:true});
                tblcomercio.createIndex('codigo', 'codigo', {unique:false});


                tblproducto.createIndex('idProducto', 'idProducto', {unique:true});
                tblproducto.createIndex('codigo', 'codigo', {unique:false});

                tbltipo.createIndex('idTipo', 'idTipo', {unique:true});
                tbltipo.createIndex('codigo', 'codigo', {unique:false});

                tblbasico.createIndex('idBase', 'idBase', {unique:true});
                tblbasico.createIndex('codigo', 'codigo', {unique:false});
            };
            indexDb.onsuccess = e=>{
                db = e.target.result;
            };
            indexDb.onerror = e=>{
                console.log(e.target.error);
            };
        },
        obtenergps(){
            this.$getLocation({})
            .then(gps => {
                localStorage.lat = gps.lat;
                localStorage.lng = gps.lng;
            })
        },
    },
    created(){
        this.abrirBd();
         
    }
});
