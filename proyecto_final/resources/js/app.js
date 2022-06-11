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
import Vue from 'vue';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
import * as VueGoogleMaps from 'vue2-google-maps';

Vue.use(VueGoogleMaps, {

    load: {
        key: ''
    },
});

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
Vue.component('v-select-comercios', vSelect);
Vue.component('v-select-tipos', vSelect);

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

                tblcomercio.createIndex('idComercio', 'idComercio', {unique:true});
                tblcomercio.createIndex('codigo', 'codigo', {unique:false});


                tblproducto.createIndex('idProducto', 'idProducto', {unique:true});
                tblproducto.createIndex('codigo', 'codigo', {unique:false});

                tbltipo.createIndex('idTipo', 'idTipo', {unique:true});
                tbltipo.createIndex('codigo', 'codigo', {unique:false});
            };
            indexDb.onsuccess = e=>{
                db = e.target.result;
            };
            indexDb.onerror = e=>{
                console.log(e.target.error);
            };
        },
    },
    created(){
        this.abrirBd();
    }
});
