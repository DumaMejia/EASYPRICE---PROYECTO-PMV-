<template>
   
    <div id="appAlumno">
        <div class="container-fluid">
        <form @submit.prevent="guardarInscripcion" @reset.prevent="nuevoInscripcion" method="post" id="frmMaterias">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header text-white bg-dark">
                        Administracion de Materias
                    </div>
                    <div class="card-body">
                        <div class="row p-1">
                            <div class="col col-md-1">Nombre</div>
                            <div class="col col-md-2">
                                <select v-model="inscripcion.nombre" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option selected> Ninguna</option>
                                    <option value="0"></option>
                                  </select>
                            </div> 
                        </div>

                        <div class="row p-1">
                            <div class="col col-md-1">Materia 1</div>
                            <div class="col col-md-2">
                                <select v-model="inscripcion.materia1" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option selected> Ninguna</option>
                                    <option value="Metodologia de la investigacion">Metodologia de la investigacion</option>
                                    <option value="Sociologia">Sociologia</option>
                                  </select>
                            </div> 
                        </div>
                        
                        <div class="row p-1">
                            <div class="col col-md-1">Materia 2</div>
                            <div class="col col-md-2">
                                <select v-model="inscripcion.materia2" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option  selected>Ninguna</option>
                                    <option value="Ingles Basico">Ingles Basico</option>
                                    <option value="Ingles Tecnico">Ingles Tecnico</option>
                                  </select>
                            </div> 
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-1">Materia 3</div>
                            <div class="col col-md-2">
                                <select v-model="inscripcion.materia3" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option  selected>Ninguna</option>
                                    <option value="Curso Superior de Gramatica">Curso Superior de Gramatica</option>
                                    <option value="Matematica I">Matematica I</option>
                                  </select>
                            </div> 
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-1">Materia 4</div>
                            <div class="col col-md-2">
                                <select v-model="inscripcion.materia4" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option  selected>Ninguna</option>
                                    <option value="Matematica II">Matematica II</option>
                                    <option value="Fisica I">Fisica I</option>
                                  </select>
                            </div> 
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-1">Materia 5</div>
                            <div class="col col-md-2">
                                <select v-model="inscripcion.materia5" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option  selected>Ninguna</option>
                                    <option value="Filosofia">Filosofia</option>
                                    <option value="Sociedad e Historia">Sociedad e Historia</option>
                                  </select>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col col-md-3 text-center">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="reset" class="btn btn-warning">Nuevo</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    
    <div class="card text-white bg-dark mb-3" id="cardBuscarCliente">
        <div class="card-header text-white bg-dark">
            Busqueda de Inscripcion de Materias
        </div>
        <div class="card-body">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <td colspan="6">
                            Buscar: <input title="Introduzca el texto a buscar" @keyup="buscandoInscripcion" v-model="buscar1" class="form-control" type="text">
                        </td>
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        <th>Materia 1</th>
                        <th>Materia 2</th>
                        <th>Materia 3</th>
                        <th>Materia 4</th>
                        <th>Materia 5</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in materias" :key="item.idincripcion">
                        <td>{{item.alumno.label}}</td>
                        <td>{{item.materia1}}</td>
                        <td>{{item.materia2}}</td>
                        <td>{{item.materia3}}</td>
                        <td>{{item.materia4}}</td>
                        <td>{{item.materia5}}</td>
                        <td>
                            <button type="button" class="btn btn-danger" @click="eliminarIncripcion(item)">Eliminar</button>
                            <button type="button" class="btn btn-success" @click="modificarIncripcion(item)">Modificar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
        </div>
    </div>
       
</template>

<script>
    export default {
        props : ['form'],
         data:()=>{
            return{
        incripcions: [],
        alumnos: [],
        buscar1: '',
         inscripcion: {
            accion: 'nuevo',
            idIncripcion:'',
            nombre:'',
            codigo1:'',
            nombre1:'',
            materia1:'',
            materia2:'',
            materia3:'',
            materia4:'',
            materia5:''
            },
        }
        },
        methods:{
            cerrarForm(){
                this.form['inscripcion'].mostrar = false;
            },
            async sincronizarDatosServidor(inscripcion, metodo, url){
                await axios({
                    method : metodo,
                    url,
                    data : inscripcion
                })
                .then(resp=>{
                    if(inscripcion.accion=='nuevo'){
                        inscripcion.id = resp.data.id;
                        this.insertarLocal(inscripcion);//actualizar el id del inscripcion que se genero en el servidor con laravel y mysql
                    }
                    this.inscripcion.msg = `Inscripcion procesado ${data.msg}`;
                })
                .catch(err=>{
                    this.inscripcion.msg = `Error al procesar el inscripcion ${err}`;
                })
            },
            insertarLocal(inscripcion){
                let store = this.abrirStore('inscripcion', 'readwrite'),
                    query = store.put(inscripcion);
                query.onsuccess = e=>{
                    this.nuevoInscripcion();
                    this.obtenerDatos();
                    this.inscripcion.msg = 'Inscripcion procesado con exito';
                };
                query.onerror = e=>{
                    this.inscripcion.msg = `Error al procesar el inscripcion ${e.target.error}`;
                };
            },
            buscandoInscripcion(){
                this.obtenerDatos(this.buscar);
            },
            eliminarInscripcion(inscripcion){
                if( confirm(`Esta seguro de eliminar el inscripcion ${alumno.nombre}?`) ){
                    inscripcion.accion = 'eliminar';
                    let store = this.abrirStore('inscripcion', 'readwrite'),
                        query = store.delete(inscripcion.idInscripcion),
                        metodo = 'DELETE',
                        url = `/inscripcion/${inscripcion.id}`;
                    this.sincronizarDatosServidor(inscripcion, metodo, url);
                    query.onsuccess = e=>{
                        this.nuevoInscripcion();
                        this.obtenerDatos();
                        this.inscripcion.msg = 'Inscripcion eliminado con exito';
                    };
                    query.onerror = e=>{
                        this.inscripcion.msg = `Error al eliminar el inscripcion ${e.target.error}`;
                    };
                }
                this.nuevoInscripcion();
            },
            modificarInscripcion(datos){
                this.inscripcion = JSON.parse(JSON.stringify(datos));
                this.inscripcion.accion = 'modificar';
            },
            guardarInscripcion(){
                let metodo = 'PUT',
                    url = `/inscripcion/${this.inscripcion.id}`;
                if(this.inscripcion.accion=="nuevo"){
                    this.inscripcion.idInscripcion = generarIdUnicoFecha();
                    metodo = 'POST';
                    url = '/inscripcion';
                }
                let inscripcion = JSON.parse(JSON.stringify(this.inscripcion));
                this.sincronizarDatosServidor(inscripcion, metodo, url);
                this.insertarLocal(inscripcion);
            },
            obtenerDatos(valor=''){
                let store = this.abrirStore('inscripcion', 'readonly'),
                    data = store.getAll();
                data.onsuccess = e=>{
                    if( data.result.length<=0 ){
                        fetch(`inscripcion`, 
                            {credentials: 'same-origin'})
                            .then(res=>res.json())
                            .then(data=>{
                                this.inscripcions = data;
                                data.map(inscripcion=>{
                                    let store = this.abrirStore('inscripcion', 'readwrite'),
                                        query = store.put(inscripcion);
                                    query.onsuccess = e=>{
                                        console.log(`Inscripcion ${inscripcion.nombre} guardado`);
                                    };
                                    query.onerror = e=>{
                                        console.log(`Error al guardar la inscripcion ${e.target.error}`);
                                    };
                                });
                            })
                            .catch(err=>{
                                this.inscripcion.msg = `Error al guardar el inscripcion ${err}`;
                            });
                    }
                    this.inscripcions = data.result.filter(inscripcion=>inscripcion.nombre.toLowerCase().indexOf(valor.toLowerCase())>-1);
                };
                data.onerror = e=>{
                    this.inscripcion.msg = `Error al obtener los inscripcions ${e.target.error}`;
                };
            },
            nuevoInscripcion(){
            this.materia.accion = 'nuevo';
            this.materia.idIncripcion = '';
            this.materia.materia1 = 'ninguna';
            this.materia.materia2 = 'ninguna';
            this.materia.materia3 = 'ninguna';
            this.materia.materia4 ='ninguna';
            this.materia.materia5 ='ninguna';
            },

            abrirStore(store, modo){
                return this.db.transaction(store, modo).objectStore(store);
            },
        },
        created(){
            //this.obtenerDatos();
        },
    }
</script>
