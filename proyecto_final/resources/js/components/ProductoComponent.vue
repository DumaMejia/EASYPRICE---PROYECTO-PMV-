<template>
   
    <div id="appProducto">
        <div class="card">
        
        </div>
        

        
            <div class="card text-dark bg-light mb-3">
                <div class="card-header text-white bg-warning">
                        Administracion de Productos
                        <button type="button" class="btn-close text-end" @click="cerrarForm"></button>
                 </div>
                <form @submit.prevent="guardarProducto" @reset.prevent="nuevoProducto" method="post" id="frmMaterias">
                
                   
                    

                        <div class="row p-1">
                        <div class="col col-md-2">Codigo:</div>
                        <div class="col col-md-3">
                            <input disabled title="Ingrese el nombre" v-model="producto.codigo"  required type="text" class="form-control">
                        </div>
                        </div>

                        <div class="row p-1">
                        <div class="col col-md-2">Nombre:</div>
                        <div class="col col-md-3">
                            <input title="Ingrese el nombre" v-model="producto.nombre" pattern="[A-Za-zñÑáéíóúü ]{3,75}" required type="text" class="form-control">
                        </div>
                        </div>
                        
                        <div class="row p-1">
                                <div class="col col-md-2">Comercio:</div>
                                <div class="col col-md-3">
                                    <v-select-comercios title="Seleccione el comercio" v-model="producto.comercio" :options="comercios" required class="form-control"/>
                                </div>
                            </div>

                        <div class="row p-1">
                        <div class="col col-md-2">Precio:</div>
                        <div class="col col-md-3">
                            <input title="Ingrese el nombre" v-model="producto.precio" required type="text" class="form-control">
                        </div>
                        </div>

                        <div class="row p-1">
                                <div class="col col-md-2">Categoria:</div>
                                <div class="col col-md-3">
                                    <v-select-tipos title="Seleccione la categoria" v-model="producto.tipo" :options="tipos" required class="form-control"/>
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
            Busqueda de Producto 
            
        </div>
        <div class="card-body">
            <table class="table table-light table-striped">
                <thead>
                    <tr>
                        <td colspan="8">
                            Buscar: <input title="Introduzca el texto a buscar" @keyup="buscandoProducto" v-model="buscar" class="form-control" type="text">
                        </td>
                    </tr>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Comercio</th>
                        <th>Precio</th>
                        <th>Categoria</th>
                    </tr>
                </thead>
                <tbody>
                    <tr  v-for="item in productos" @click='modificarProducto( item )' :key="item.idProducto">
                        <td>{{item.codigo}}</td>
                        <td>{{item.nombre}}</td>
                        <td>{{item.comercio.label}}</td>
                        <td>{{item.precio}}</td>
                        <td>{{item.tipo.label}}</td>
                        <td>
                            <button type="button" class="btn btn-danger" @click="eliminarProducto(item)">Eliminar</button>
                            <button type="button" class="btn btn-success" @click="modificarProducto(item)">Modificar</button>
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
        productos: [],
        comercios: [],
        tipos: [],
        buscar: '',
         producto: {
            accion: 'nuevo',
            id: 0,
            idProducto:'',
            codigo:'',
            nombre:'',
            idComercio:'',
            nombrecomercio: '',
            comercio:{
                id:'',
                label:'',
                },
            tipo:{
                id:'',
                label:'',
                },
            precio:'',
            idCategoria:'',
            ncategoria:'',
            }
        }
        },
        methods:{
            cerrarForm(){
                this.form['producto'].mostrar = false;
            },
            async sincronizarDatosServidor(producto, metodo, url){
                await axios({
                    method : metodo,
                    url,
                    data : producto
                })
                .then(resp=>{
                    if(producto.accion=='nuevo'){
                        producto.id = resp.data.id;
                        this.insertarLocal(producto);//actualizar el id del producto que se genero en el servidor con laravel y mysql
                        alertify.success(`Producto procesado con exito`);
                    }
                    if(producto.accion=='modificar'){
                        alertify.success(`Producto procesado con exito`);
                    }
                    
                })
                .catch(err=>{
                    
                })
            },
            insertarLocal(producto){
                let store = this.abrirStore('producto', 'readwrite'),
                    query = store.put(producto);
                query.onsuccess = e=>{
                    this.nuevoProducto();
                    this.obtenerDatos();
                };
                query.onerror = e=>{
                     alertify.error(`Error al procesar el producto ${e.target.error}`);
                };
            },
            buscandoProducto(){
                this.obtenerDatos(this.buscar);
            },
            eliminarProducto(producto){
                if( confirm(`Esta seguro de eliminar el producto ${producto.codigo}?`) ){
                    producto.accion = 'eliminar';
                    let store = this.abrirStore('producto', 'readwrite'),
                        query = store.delete(producto.idProducto),
                        metodo = 'DELETE',
                        url = `/producto/${producto.id}`;
                    this.sincronizarDatosServidor(producto, metodo, url);
                    query.onsuccess = e=>{
                        this.nuevoProducto();
                        this.obtenerDatos();
                        alertify.success('Producto eliminado con exito');
                    };
                    query.onerror = e=>{
                        alertify.error = `Error al eliminar el producto ${e.target.error}`;
                    };
                }
                this.nuevoProducto();
            },
            modificarProducto(datos){
                this.producto = JSON.parse(JSON.stringify(datos));
                this.producto.accion = 'modificar';
            },
            guardarProducto(){
                let metodo = 'PUT',
                    url = `/producto/${this.producto.id}`;
                if(this.producto.accion=="nuevo"){
                    this.producto.idProducto = generarIdUnicoFecha();
                    metodo = 'POST';
                    url = '/producto';
                }
                this.producto.idComercio = this.producto.comercio.id;
                this.producto.nombrecomercio = this.producto.comercio.label;
                this.producto.idCategoria = this.producto.tipo.id;
                this.producto.ncategoria = this.producto.tipo.label;
                let producto = JSON.parse(JSON.stringify(this.producto));
                this.sincronizarDatosServidor(producto, metodo, url);
                this.insertarLocal(producto);
            },
            obtenerDatos(valor=''){
                let store = this.abrirStore('producto', 'readonly'),
                    data = store.getAll();
                data.onsuccess = e=>{
                    if( data.result.length<=0 ){
                        fetch(`producto`, 
                            {credentials: 'same-origin'})
                            .then(res=>res.json())
                            .then(data=>{
                                this.productos = data;
                                data.map(producto=>{
                                    let store = this.abrirStore('producto', 'readwrite'),
                                        query = store.put(producto);
                                    query.onsuccess = e=>{
                                        console.log(`Producto ${producto.codigo} guardado`);
                                    };
                                    query.onerror = e=>{
                                        console.log(`Error al guardar la producto ${e.target.error}`);
                                    };
                                });
                            })
                            .catch(err=>{
                                alertify.error(`Error al guardar el producto ${err}`);
                            });
                    }
                    this.productos = data.result.filter(producto=>producto.ncategoria.toLowerCase().indexOf(valor.toLowerCase())>-1 || producto.nombre.toLowerCase().indexOf(valor.toLowerCase())>-1 || producto.nombrecomercio.toLowerCase().indexOf(valor.toLowerCase())>-1);
                };
                data.onerror = e=>{
                    alertify.error(`Error al obtener los productos ${e.target.error}`);
                }; 

                //obtener comercios 
                let storeComercio = this.abrirStore('comercio', 'readonly'),
                    dataComercio = storeComercio.getAll();
                dataComercio.onsuccess = e=>{
                    if( dataComercio.result.length<=0 ){
                        fetch(`comercio`, 
                            {credentials: 'same-origin'})
                            .then(res=>res.json())
                            .then(dataComercio=>{
                                this.comercios = dataComercio;
                                dataComercio.map(comercio=>{
                                    let store = this.abrirStore('comercio', 'readwrite'),
                                        query = store.put(comercio);
                                    query.onsuccess = e=>{
                                        console.log(`Matricula ${comercio.nombre} guardado`);
                                    };
                                    query.onerror = e=>{
                                        console.log(`Error al guardar el comercio ${e.target.error}`);
                                    };
                                });
                            })
                            .catch(err=>{
                                alertify.error(`Error al guardar el comercio ${err}`);
                            });
                    }
                    this.comercios = dataComercio.result.map(comercio=>{
                        return {
                            id : comercio.id,
                            label : comercio.nombre,
                        }
                    });
                    console.log(this.comercios);
                };
                dataComercio.onerror = e=>{
                    alertify.error(`Error al obtener los comercios ${e.target.error}`);
                };

                //obtener Tipos
                let storeTipo = this.abrirStore('tipo', 'readonly'),
                    dataTipo = storeTipo.getAll();
                dataTipo.onsuccess = e=>{
                    if( dataTipo.result.length<=0 ){
                        fetch(`tipo`, 
                            {credentials: 'same-origin'})
                            .then(res=>res.json())
                            .then(dataTipo=>{
                                this.tipos = dataTipo;
                                dataTipo.map(tipo=>{
                                    let store = this.abrirStore('tipo', 'readwrite'),
                                        query = store.put(tipo);
                                    query.onsuccess = e=>{
                                        console.log(`tipo ${tipo.nombre} guardado`);
                                    };
                                    query.onerror = e=>{
                                        console.log(`Error al guardar el tipo ${e.target.error}`);
                                    };
                                });
                            })
                            .catch(err=>{
                                alertify.error(`Error al guardar el tipo ${err}`);
                            });
                    }
                    this.tipos = dataTipo.result.map(tipo=>{
                        return {
                            id : tipo.id,
                            label : tipo.nombre,
                        }
                    });
                    console.log(this.tipos);
                };
                dataTipo.onerror = e=>{
                    alertify.error(`Error al obtener los tipos ${e.target.error}`);
                };

            },
    

            nuevoProducto(){
            this.producto.accion = 'nuevo';
            this.producto.idProducto = '';
            this.producto.codigo = '';
            this.producto.nombre = '';
            this.producto.idP = '';
            this.producto.precio = '';
            this.producto.categoria ='';
            this.producto.comercio = {
                    id:'',
                    label:'',
                };
            this.producto.tipo = {
                    id1:'',
                    label1:'',
                };
            this.codeList();
            },
            codeList() {
                this.producto.codigo = this.productos.length + 1;  
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
