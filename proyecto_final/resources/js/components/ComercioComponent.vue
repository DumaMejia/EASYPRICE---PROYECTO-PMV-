<template>
    <div id="appComercio">
        
        <div class="card">
  
        </div>
        
            
            <div class="card text-dark bg-light mb-3" >
                <div class="card-header text-white bg-warning">
                Registro de Comercios
                <button type="button" class="btn-close text-end" @click="cerrarForm"></button>
                </div>
                 
                
                <form method="post" @submit.prevent="guardarComercio" @reset="nuevoComercio">
                <div class="row p-1">
                    <div class="card" style="width: 650px; height: 500px;">
                        <div class="row p-1">
                        <div class="col col-md-2">Codigo:</div>
                        <div class="col col-md-2">
                            <input title="Ingrese el codigo" disabled v-model="comercio.codigo" pattern="[0-9]{3,10}" required type="text" class="form-control" style="width : 150px">
                        </div>
                    </div>
                    <div class="row p-1">
                        <div class="col col-md-2">Nombre:</div>
                        <div class="col col-md-3">
                            <input title="Ingrese el nombre" v-model="comercio.nombre" pattern="[A-Za-zñÑáéíóúü ]{3,75}" required type="text" class="form-control" style="width : 300px">
                        </div>
                    </div>
                    <div class="row p-1">
                        <div class="col col-md-2">Direccion:</div>
                        <div class="col col-md-3">
                            <input title="Ingrese la direccion" v-model="comercio.direccion" pattern="[A-Za-zñÑáéíóúü ]{3,100}" required type="text" class="form-control" style="width : 300px">
                        </div>
                    </div>
                    <div class="row p-1">
                        <div class="col col-md-2">latitude:</div>
                        <div class="col col-md-3">
                            <input title="Ingrese la direccion" v-model="comercio.latitude"  required type="text" disabled  class="form-control" style="width : 300px">
                        </div>
                        
                    </div>
                    <div class="row p-1">
                        <div class="col col-md-2">Longitude:</div>
                        <div class="col col-md-3">
                            <input title="Ingrese la latitude" v-model="comercio.longitude"  required type="text" disabled class="form-control" style="width : 300px">
                        </div>
                    </div>
                    <div class="row p-1">
                        <div class="col col-md-2">Telefono:</div>
                        <div class="col col-md-2">
                            <input title="Ingrese la longitude" v-model="comercio.telefono" pattern="[0-9]{4}-[0-9]{4}" required type="text" class="form-control" style="width : 300px">
                        </div>
                    </div>
                    <div class="row p-1">
                        <div class="col col-md-2">Correo:</div>
                        <div class="col col-md-2">
                            <input title="Ingrese el CORREO" v-model="comercio.correo"  required type="email"  class="form-control" style="width : 300px">
                        </div>
                    </div>
                    <div class="row p-1" >
                            <div   visibility="hidden" class="col col-md-2">Tipo de comercio:</div>
                            <div class="col col-md-2">
                                <select  v-model="comercio.tipo" class="form-select form-select-sm" aria-label=".form-select-sm example" style="width : 300px">
                                    <option  selected>Seleccionar Tipo</option>
                                    <option value="Pequeña empresa">Pequeña empresa</option>
                                    <option value="Mediana empresa">Mediana empresa</option>
                                    <option value="Gran Empresa">Gran Empresa</option>
                                  </select>
                            </div> 
                        </div>
                        <div class="row p-1">
                        <div class="col col-md-5 text-center">
                            <div v-if="comercio.mostrar_msg" class="alert alert-primary alert-dismissible fade show" role="alert">
                                {{ comercio.msg }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    <div class="row p-1">
                        <div class="col col-md-2" >
                            <input class="btn btn-primary" type="submit" value="Guardar">
                        </div>
                        <div class="col col-md-2" >
                            <input class="btn btn-warning" type="reset" value="Nuevo">
                        </div>
                        <div class="col col-md-2">
                            <input class="btn btn-outline-primary" type="button" @click="displaymap" value="Mapa" style="width: 193px">
                        </div>
                            
                       
                    </div>
                    </div>
                    
                    <div class="container m-3" id="map" style="width: 700px; height: 450px; left: 5px; top: 1px; display : none" >
                        <GmapMap 
                    :center="{lat:13.343565797622999,lng:-88.43976983311296}"
                    :zoom="14"

                    map-type-id="roadmap"
                    style="width: 730px; height: 450px; left: 1px; top: 1px; right: 1px;"
                    @click="handleMapClick"
                    >
                    
                    </GmapMap>
                    </div>
                   
                
                     
                    

                </div>
                    
                </form>
            </div>
    
        <div class="card text-dark bg-light mb-3" id="carBuscarComercio">
            <div class="card-header text-white bg-warning">
                Busqueda de Comercios
                
            </div>
            <div class="card-body">
                <table class="table table-light table-hover">
                    <thead>
                        <tr>
                            <th colspan="8">
                                Buscar: <input @keyup="buscandoComercio" v-model="buscar" placeholder="buscar aqui" class="form-control" type="text" >
                            </th>
                        </tr>
                        <div class="col col-md-12"  id="res" >Resultados: </div>
                        <tr>
                            <th>CODIGO</th>
                            <th>NOMBRE</th>
                            <th>DIRECCION</th>
                            <th>LATITUDE</th>
                            <th>LONGITUDE</th>
                            <th>TEL</th>
                            <th>CORREO</th>
                            <th>TIPO DE COMERCIO</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in comercios" @click='modificarComercio( item )' :key="item.idComercio">
                            <td>{{item.codigo}}</td>
                            <td>{{item.nombre}}</td>
                            <td>{{item.direccion}}</td>
                            <td>{{item.latitude}}</td>
                            <td>{{item.longitude}}</td>
                            <td>{{item.telefono}}</td>
                            <td>{{item.correo}}</td>
                            <td>{{item.tipo}}</td>
                            <td>
                                <button class="btn btn-danger" @click="eliminarComercio(item)">Eliminar</button>
                                <button type="button" class="btn btn-success" @click="modificarComercio(item)">Modificar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</template>

<script>
    export default {
        props : ['form'],
         data:()=>{
            return {
                buscar:'',
                comercios:[],
                comercio:{
                    accion : 'nuevo',
                    id : 0,
                    idComercio : '',
                    codigo: '',
                    nombre: '',
                    direccion: '',
                    latitude: '',
                    longitude: '',
                    telefono: '',
                    correo: '',
                    tipo: ''
                }
            }
        },
        methods:{
            cerrarForm(){
                this.form['comercio'].mostrar = false;
            },
            async sincronizarDatosServidor(comercio, metodo, url){
                await axios({
                    method : metodo,
                    url,
                    data : comercio
                })
                .then(resp=>{
                    if(comercio.accion=='nuevo'){
                        comercio.id = resp.data.id;
                        this.insertarLocal(comercio);//actualizar el id del comercio que se genero en el servidor con laravel y mysql
                        alertify.success(`Comercio procesado con exito`);
                    }
                    if(comercio.accion=='modificar'){
                        alertify.success(`Comercio procesado con exito`);
                    }
                    
                })
                .catch(err=>{
                   
                })
            },
            insertarLocal(comercio){
                let store = this.abrirStore('comercio', 'readwrite'),
                    query = store.put(comercio);
                query.onsuccess = e=>{
                    this.nuevoComercio();
                    this.obtenerDatos();
                };
                query.onerror = e=>{
                    alertify.error(`Error al procesar el comercio ${e.target.error}`);
                };
            },
            buscandoComercio(){
                this.obtenerDatos(this.buscar);
            },
            eliminarComercio(comercio){
                if( confirm(`Esta seguro de eliminar el comercio ${comercio.nombre}?`) ){
                    comercio.accion = 'eliminar';
                    let store = this.abrirStore('comercio', 'readwrite'),
                        query = store.delete(comercio.idComercio),
                        metodo = 'DELETE',
                        url = `/comercio/${comercio.id}`;
                    this.sincronizarDatosServidor(comercio, metodo, url);
                    query.onsuccess = e=>{
                        this.nuevoComercio();
                        this.obtenerDatos();
                        alertify.success('Comercio eliminado con exito');
                    };
                    query.onerror = e=>{
                        alertify.error = `Error al eliminar el comercio ${e.target.error}`;
                    };
                }
                this.nuevoComercio();
            },
            modificarComercio(datos){
                this.comercio = JSON.parse(JSON.stringify(datos));
                this.comercio.accion = 'modificar';
            },
            guardarComercio(){
                let metodo = 'PUT',
                    url = `/comercio/${this.comercio.id}`;
                if(this.comercio.accion=="nuevo"){
                    this.comercio.idComercio = generarIdUnicoFecha();
                    metodo = 'POST';
                    url = '/comercio';
                }
                let comercio = JSON.parse(JSON.stringify(this.comercio));
                this.sincronizarDatosServidor(comercio, metodo, url);
                this.insertarLocal(comercio);
            },
            obtenerDatos(valor=''){
                let store = this.abrirStore('comercio', 'readonly'),
                    data = store.getAll();
                data.onsuccess = e=>{
                    if( data.result.length<=0 ){
                        fetch(`comercio`, 
                            {credentials: 'same-origin'})
                            .then(res=>res.json())
                            .then(data=>{
                                this.comercios = data;
                                data.map(comercio=>{
                                    let store = this.abrirStore('comercio', 'readwrite'),
                                        query = store.put(comercio);
                                    query.onsuccess = e=>{
                                        console.log(`Comercio ${comercio.nombre} guardado`);
                                    };
                                    query.onerror = e=>{
                                        console.log(`Error al guardar el comercio ${e.target.error}`);
                                    };
                                });
                            })
                            .catch(err=>{
                                alertify.error = `Error al guardar el comercio ${err}`;
                            });
                    }
                    this.comercios = data.result.filter(comercio=>comercio.nombre.toLowerCase().indexOf(valor.toLowerCase())>-1 || comercio.tipo.toLowerCase().indexOf(valor.toLowerCase())>-1 || comercio.direccion.toLowerCase().indexOf(valor.toLowerCase())>-1);
                    
                };
                data.onerror = e=>{
                    alertify.error = `Error al obtener los comercios ${e.target.error}`;
                };
                
            },
            nuevoComercio(){
                this.comercio.accion = 'nuevo';
                this.comercio.idComercio = '';
                this.comercio.codigo = '';
                this.comercio.nombre = '';
                this.comercio.direccion = '';
                this.comercio.latitude = '';
                this.comercio.longitude = '';
                this.comercio.telefono = '';
                this.comercio.correo = '';
                this.comercio.tipo = '';
                document.getElementById("map").style.display = 'none';
                this.codeList();
            },
            abrirStore(store, modo){
                return db.transaction(store, modo).objectStore(store);
            },
            handleMapClick(e) {
                this.comercio.latitude = e.latLng.lat();
                this.comercio.longitude = e.latLng.lng();
            },
            displaymap() {
                if(document.getElementById("map").style.display == ''){
                    document.getElementById("map").style.display = 'none';
                }else{
                    document.getElementById("map").style.display = '';
                };   
            },
            codeList() {
                this.obtenerDatos();
                this.comercio.codigo = this.comercios.length + 1;
            },
            resultTable(){
                obtenerDatos();
                document.getElementById("res").innerHTML = "Resultados: " + this.comercios.length;
            }
        },
        created(){
            //this.obtenerDatos();
            
        },
    }
</script>
