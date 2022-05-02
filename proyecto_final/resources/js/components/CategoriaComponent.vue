<template>
   
    <div id="appCategoria">
        <div class="card">
        
        </div>
        

        
            <div class="card text-dark bg-light mb-3">
                <div class="card-header text-white bg-warning">
                        Administracion de Categorias
                        <button type="button" class="btn-close text-end" @click="cerrarForm"></button>
                 </div>
                <form @submit.prevent="guardarCategoria" @reset.prevent="nuevoCategoria" method="post" id="frmMaterias">
                
                   
                    

                        <div class="row p-1">
                        <div class="col col-md-2">Codigo:</div>
                        <div class="col col-md-3">
                            <input title="Ingrese el nombre" v-model="categoria.codigo"  required type="text" class="form-control">
                        </div>
                        </div>

                        <div class="row p-1">
                        <div class="col col-md-2">Nombre:</div>
                        <div class="col col-md-3">
                            <input title="Ingrese el nombre" v-model="categoria.nombre" pattern="[A-Za-zñÑáéíóúü ]{3,75}" required type="text" class="form-control">
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
            Busqueda de Categoria 
            
        </div>
        <div class="card-body">
            <table class="table table-light table-striped">
                <thead>
                    <tr>
                        <td colspan="8">
                            Buscar: <input title="Introduzca el texto a buscar" @keyup="buscandoCategoria" v-model="buscar" class="form-control" type="text">
                        </td>
                    </tr>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <tr  v-for="item in categorias" @click='modificarCategoria( item )' :key="item.idCategoria">
                        <td>{{item.codigo}}</td>
                        <td>{{item.nombre}}</td>
                        <td>
                            <button type="button" class="btn btn-danger" @click="eliminarCategoria(item)">Eliminar</button>
                            <button type="button" class="btn btn-success" @click="modificarCategoria(item)">Modificar</button>
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
        categorias: [],
        buscar: '',
         categoria: {
            accion: 'nuevo',
            id: 0,
            idCategoria:'',
            codigo:'',
            nombre:'',
            }
        }
        },
        methods:{
            cerrarForm(){
                this.form['categoria'].mostrar = false;
            },
            async sincronizarDatosServidor(categoria, metodo, url){
                await axios({
                    method : metodo,
                    url,
                    data : categoria
                })
                .then(resp=>{
                    if(categoria.accion=='nuevo'){
                        categoria.id = resp.data.id;
                        this.insertarLocal(categoria);//actualizar el id del categoria que se genero en el servidor con laravel y mysql
                    }
                    this.categoria.msg = `Categoria procesado ${data.msg}`;
                })
                .catch(err=>{
                    this.categoria.msg = `Error al procesar el categoria ${err}`;
                })
            },
            insertarLocal(categoria){
                let store = this.abrirStore('categoria', 'readwrite'),
                    query = store.put(categoria);
                query.onsuccess = e=>{
                    this.nuevoCategoria();
                    this.obtenerDatos();
                    this.categoria.msg = 'Categoria procesado con exito';
                };
                query.onerror = e=>{
                    this.categoria.msg = `Error al procesar el categoria ${e.target.error}`;
                };
            },
            buscandoCategoria(){
                this.obtenerDatos(this.buscar);
            },
            eliminarCategoria(categoria){
                if( confirm(`Esta seguro de eliminar el categoria ${categoria.codigo}?`) ){
                    categoria.accion = 'eliminar';
                    let store = this.abrirStore('categoria', 'readwrite'),
                        query = store.delete(categoria.idCategoria),
                        metodo = 'DELETE',
                        url = `/categoria/${categoria.id}`;
                    this.sincronizarDatosServidor(categoria, metodo, url);
                    query.onsuccess = e=>{
                        this.nuevoCategoria();
                        this.obtenerDatos();
                        this.categoria.msg = 'Categoria eliminado con exito';
                    };
                    query.onerror = e=>{
                        this.categoria.msg = `Error al eliminar el categoria ${e.target.error}`;
                    };
                }
                this.nuevoCategoria();
            },
            modificarCategoria(datos){
                this.categoria = JSON.parse(JSON.stringify(datos));
                this.categoria.accion = 'modificar';
            },
            guardarCategoria(){
                let metodo = 'PUT',
                    url = `/categoria/${this.categoria.id}`;
                if(this.categoria.accion=="nuevo"){
                    this.categoria.idCategoria = generarIdUnicoFecha();
                    metodo = 'POST';
                    url = '/categoria';
                }
                let categoria = JSON.parse(JSON.stringify(this.categoria));
                this.sincronizarDatosServidor(categoria, metodo, url);
                this.insertarLocal(categoria);
            },
            obtenerDatos(valor=''){
                let store = this.abrirStore('categoria', 'readonly'),
                    data = store.getAll();
                data.onsuccess = e=>{
                    if( data.result.length<=0 ){
                        fetch(`categoria`, 
                            {credentials: 'same-origin'})
                            .then(res=>res.json())
                            .then(data=>{
                                this.categorias = data;
                                data.map(categoria=>{
                                    let store = this.abrirStore('categoria', 'readwrite'),
                                        query = store.put(categoria);
                                    query.onsuccess = e=>{
                                        console.log(`Categoria ${categoria.codigo} guardado`);
                                    };
                                    query.onerror = e=>{
                                        console.log(`Error al guardar la categoria ${e.target.error}`);
                                    };
                                });
                            })
                            .catch(err=>{
                                this.categoria.msg = `Error al guardar el categoria ${err}`;
                            });
                    }
                    this.categorias = data.result.filter(categoria=>categoria.codigo.toLowerCase().indexOf(valor.toLowerCase())>-1 || categoria.nombre.toLowerCase().indexOf(valor.toLowerCase())>-1);
                };
                data.onerror = e=>{
                    this.categoria.msg = `Error al obtener los categorias ${e.target.error}`;
                }; 

            },
    

            nuevoCategoria(){
            this.categoria.accion = 'nuevo';
            this.categoria.idCategoria = '';
            this.categoria.codigo = '';
            this.categoria.nombre = '';
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
