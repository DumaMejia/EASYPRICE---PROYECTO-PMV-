<template>
   
    <div id="app">
        <div class="card">
        
        </div>
        

        
            <div class="card text-dark bg-light mb-3">
                <div class="card-header text-white bg-warning">
                        Administracion de Tipos
                        <button type="button" class="btn-close text-end" @click="cerrarForm"></button>
                 </div>
                <form @submit.prevent="guardarTipo" @reset.prevent="nuevoTipo" method="post" id="frmMaterias">
                
                   
                    

                        <div class="row p-1">
                        <div class="col col-md-2">Codigo:</div>
                        <div class="col col-md-3">
                            <input title="Ingrese el nombre" v-model="tipo.codigo"  required type="text" class="form-control">
                        </div>
                        </div>

                        <div class="row p-1">
                        <div class="col col-md-2">Nombre:</div>
                        <div class="col col-md-3">
                            <input title="Ingrese el nombre" v-model="tipo.nombre" pattern="[A-Za-zñÑáéíóúü ]{3,75}" required type="text" class="form-control">
                        </div>
                        </div>

                        <div class="row m-2">
                            <div class="col col-md-5 text-center">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="reset" class="btn btn-warning">Nuevo</button>
                            </div>
                        </div>
                    
                
            </form>
        </div>
    
    <div class="card text-dark bg-light mb-3" id="cardBuscarCliente">
        <div class="card-header text-white bg-warning">
            Busqueda de Tipo 
            
        </div>
        <div class="card-body">
            <table class="table table-light table-striped">
                <thead>
                    <tr>
                        <td colspan="8">
                            Buscar: <input title="Introduzca el texto a buscar" @keyup="buscandoTipo" v-model="buscar" class="form-control" type="text">
                        </td>
                    </tr>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <tr  v-for="item in tipos" @click='modificarTipo( item )' :key="item.idTipo">
                        <td>{{item.codigo}}</td>
                        <td>{{item.nombre}}</td>
                        <td>
                            <button type="button" class="btn btn-danger" @click="eliminarTipo(item)">Eliminar</button>
                            <button type="button" class="btn btn-success" @click="modificarTipo(item)">Modificar</button>
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
            return{
        tipos: [],
        buscar: '',
         tipo: {
            accion: 'nuevo',
            id: 0,
            idTipo:'',
            codigo:'',
            nombre:'',
            }
        }
        },
        methods:{
            cerrarForm(){
                this.form['tipo'].mostrar = false;
            },
            async sincronizarDatosServidor(tipo, metodo, url){
                await axios({
                    method : metodo,
                    url,
                    data : tipo
                })
                .then(resp=>{
                    if(tipo.accion=='nuevo'){
                        tipo.id = resp.data.id;
                        this.insertarLocal(tipo);//actualizar el id del tipo que se genero en el servidor con laravel y mysql
                        alertify.success(`Tipo procesado con exito`);
                    }
                    if(tipo.accion=='modificar'){
                        alertify.success(`Tipo procesado con exito`);
                    }
                    
                })
                .catch(err=>{
                    
                })
            },
            insertarLocal(tipo){
                let store = this.abrirStore('tipo', 'readwrite'),
                    query = store.put(tipo);
                query.onsuccess = e=>{
                    this.nuevoTipo();
                    this.obtenerDatos();
                    this.tipo.msg = 'Tipo procesado con exito';
                };
                query.onerror = e=>{
                    alertify.error(`Error al procesar el tipo ${e.target.error}`);
                };
            },
            buscandoTipo(){
                this.obtenerDatos(this.buscar);
            },
            eliminarTipo(tipo){
                if( confirm(`Esta seguro de eliminar el tipo ${tipo.codigo}?`) ){
                    tipo.accion = 'eliminar';
                    let store = this.abrirStore('tipo', 'readwrite'),
                        query = store.delete(tipo.idTipo),
                        metodo = 'DELETE',
                        url = `/tipo/${tipo.id}`;
                    this.sincronizarDatosServidor(tipo, metodo, url);
                    query.onsuccess = e=>{
                        this.nuevoTipo();
                        this.obtenerDatos();
                        alertify.success('Tipo eliminado con exito');
                    };
                    query.onerror = e=>{
                        alertify.error(`Error al eliminar el tipo ${e.target.error}`);
                    };
                }
                this.nuevoTipo();
            },
            modificarTipo(datos){
                this.tipo = JSON.parse(JSON.stringify(datos));
                this.tipo.accion = 'modificar';
            },
            guardarTipo(){
                let metodo = 'PUT',
                    url = `/tipo/${this.tipo.id}`;
                if(this.tipo.accion=="nuevo"){
                    this.tipo.idTipo = generarIdUnicoFecha();
                    metodo = 'POST';
                    url = '/tipo';
                }
                let tipo = JSON.parse(JSON.stringify(this.tipo));
                this.sincronizarDatosServidor(tipo, metodo, url);
                this.insertarLocal(tipo);
            },
            obtenerDatos(valor=''){
                let store = this.abrirStore('tipo', 'readonly'),
                    data = store.getAll();
                data.onsuccess = e=>{
                    if( data.result.length<=0 ){
                        fetch(`tipo`, 
                            {credentials: 'same-origin'})
                            .then(res=>res.json())
                            .then(data=>{
                                this.tipos = data;
                                data.map(tipo=>{
                                    let store = this.abrirStore('tipo', 'readwrite'),
                                        query = store.put(tipo);
                                    query.onsuccess = e=>{
                                        console.log(`Tipo ${tipo.codigo} guardado`);
                                    };
                                    query.onerror = e=>{
                                        console.log(`Error al guardar la tipo ${e.target.error}`);
                                    };
                                });
                            })
                            .catch(err=>{
                                alertify.error(`Error al guardar el tipo ${err}`);
                            });
                    }
                    this.tipos = data.result.filter(tipo=>tipo.codigo.toLowerCase().indexOf(valor.toLowerCase())>-1 || tipo.nombre.toLowerCase().indexOf(valor.toLowerCase())>-1);
                };
                data.onerror = e=>{
                    alertify.error(`Error al obtener los tipos ${e.target.error}`);
                }; 

            },
    

            nuevoTipo(){
            this.tipo.accion = 'nuevo';
            this.tipo.idTipo = '';
            this.tipo.codigo = '';
            this.tipo.nombre = '';
            },

            abrirStore(store, modo){
                return db.transaction(store, modo).objectStore(store);
            },
        },
        created(){
            //this.obtenerDatosComercio();
        },
    }
</script>
