<template>
   
    <div id="appProducto">
        <div class="card">
        
        </div>
        

        
            <div class="card text-dark bg-light mb-3">
                <div class="card-header text-white bg-warning">
                        Administracion de Productos
                        <button type="button" class="btn-close text-end" @click="cerrarForm"></button>
                 </div>
                <form @submit.prevent="guardarProducto" @reset.prevent="nuevoProducto" method="post" id="frmMaterias" >
                    <div class="row p-1">
                        <div class="card" style="width: 850px; height: 600px;">
                    

                        <div class="row p-1">
                        <div class="col col-md-2">Codigo:</div>
                        <div class="col col-md-3">
                            <input disabled title="Ingrese el nombre" v-model="producto.codigo"  required type="text" class="form-control" style="width : 300px">
                        </div>
                        </div>

                        <div class="row p-1">
                        <div class="col col-md-2">Nombre:</div>
                        <div class="col col-md-3">
                            <input title="Ingrese el nombre" v-model="producto.nombre" pattern="[A-Za-zñÑáéíóúü ]{3,75}" required type="text" class="form-control" style="width : 300px" disabled>
                        </div>
                        </div>
                        
                        <div class="row p-1">
                                <div class="col col-md-2">Comercio:</div>
                                <div class="col col-md-3">
                                    <v-select-comercios title="Seleccione el comercio" v-model="producto.comercio" :options="comercios" required class="form-control" style="width : 300px"/>
                                </div>
                            </div>

                        <div class="row p-1">
                        <div class="col col-md-2">Precio Base:</div>
                        <div class="col col-md-3">
                            <input title="Ingrese el nombre" v-model="producto.precio" required type="number" step="0.01" class="form-control" style="width : 300px">
                        </div>
                        </div>

                        <div class="row p-1">
                        <div class="col col-md-2">Precio Especial:</div>
                        <div class="col col-md-3">
                            <input title="Ingrese el nombre" v-model="producto.precioe" placeholder="Menor a precio base" type="number" step="0.01" class="form-control" style="width : 300px">
                        </div>
                        </div>

                        <div class="row p-1">
                        <div class="col col-md-2">Fecha Inicio (Precio Especial):</div>
                        <div class="col col-md-3">
                            <input title="Ingrese el nombre" v-model="producto.fechai" placeholder="AA-MM-DD" type="date"  class="form-control" style="width : 300px">
                        </div>
                        </div>

                        <div class="row p-1">
                        <div class="col col-md-2">Fecha Final (Precio Especial):</div>
                        <div class="col col-md-3">
                            <input title="Ingrese el nombre" v-model="producto.fechaf" placeholder="AA-MM-DD" type="date" class="form-control" style="width : 300px">
                        </div>
                        </div>

                        
                        <div class="row p-1">
                        <div class="col col-md-2">Categoria:</div>
                        <div class="col col-md-3">
                            <input title="Ingrese la categoria" v-model="producto.ncategoria"  required type="text" class="form-control" style="width : 300px" disabled>
                        </div>
                        </div>

                        <div class="row p-1">
                        <div class="col col-md-2">Imagen:</div>
                        <div class="col col-md-3">
                            <input title="Ingrese la categoria" v-model="producto.imagen"  required type="text" class="form-control" style="width : 300px" >
                        </div>
                        </div>

                        <div class="row p-1">
                            <div class="col col-md-2" >
                            <input class="btn btn-warning" type="reset" value="Nuevo">
                        </div>
                        <div class="col col-md-2" >
                            
                            <input class="btn btn-primary" type="submit" value="Guardar">
                        </div>
                        </div>
                    </div>

                        <div class="container m-3" id="map" style="width: 500px; height: 350px; left: 5px;" >
                        



                            <div class="card-body">
                        <table class="table table-light table-striped" id="tabla">
                            <thead>
                                <tr>
                                    <th colspan="8">
                                    <input title="Introduzca el texto a buscar" placeholder="Buscar" @keyup="buscandoProductoBase" v-model="buscar1" class="form-control" type="text">
                                        <div class="col col-md-12"  id="res2" >Resultados: </div>
                                    </th>
                                </tr>
                                
                                <tr>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Categoria</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                <tr  v-for="item in basicos" :key="item.idBase">
                                    <td>{{item.codigo}}</td>
                                    <td>{{item.nombre}}</td>
                                    <td>{{item.precio}}</td>
                                    <td>{{item.ncategoria}}</td>
                                    <td>
                                        
                                        <button type="button" class="btn btn-success" @click="obtenerProductobase(item)">Insertar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                     </div>


                        
                        
                        </div>

                        
                    
                    </div>
            </form>
        </div>
    
    <div class="card text-dark bg-light mb-3" id="cardBuscarCliente">
        <div class="card-header text-white bg-warning">
            Busqueda de Producto 
            
        </div>
        <div class="card-body">
            <table class="table table-light table-striped" id="tabla">
                <thead>
                    <tr>
                        <th colspan="8">
                         <input title="Introduzca el texto a buscar" placeholder="Buscar" @keyup="buscandoProducto" v-model="buscar" class="form-control" type="text">
                            <div class="col col-md-12"  id="res1" >Resultados: </div>
                        </th>
                    </tr>
                    
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Comercio</th>
                        <th>Precio</th>
                        <th>Precio Especial</th>
                        <th>Fecha Inicio (Precio Especial)</th>
                        <th>Fecha Final (Precio Especial)</th> 
                        <th>Categoria</th>
                        <th>Imagen</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr  v-for="item in productos" @click='modificarProducto( item )' :key="item.idProducto">
                        <td>{{item.codigo}}</td>
                        <td>{{item.nombre}}</td>
                        <td>{{item.nombrecomercio}}</td>
                        <td>{{item.precio}}</td>
                        <td>{{item.precioe}}</td>
                        <td>{{item.fechai}}</td>
                        <td>{{item.fechaf}}</td>
                        <td>{{item.ncategoria}}</td>
                        <td>{{item.imagen}}</td>
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
        basicos: [],
        buscar: '',
        buscar1: '',
         producto: {
            accion: 'nuevo',
            id: 0,
            idProducto:'',
            codigo:'',
            idBase:'',
            nombre:'',
            idComercio:'',
            nombrecomercio: '',
            comercio:{
                id:'',
                label:'',
                },
            preciosu:'',
            precio:'',
            precioe:'',
            fechai:'',
            fechaf: '',
            idCategoria:'',
            ncategoria:'',
            imagen:'',
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
                        if( permitirNotificaciones=='granted' ){
                         let notificacion;
                            notificacion = new Notification('Productos Nuevos', {
                            body : 'Hay Productos Nuevos disponibles',
                            });
                        };
                    }
                    if(producto.accion=='modificar'){
                        alertify.success(`Producto procesado con exito`);
                        if( permitirNotificaciones=='granted' ){
                         let notificacion;
                            notificacion = new Notification('Productos Nuevos', {
                            icon : "image/logo3.png",
                            body : 'Hay Productos Nuevos disponibles',
                            });
                        };
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
            buscandoProductoBase(){
                this.buscarBase(this.buscar1);
            },
            eliminarProducto(producto){
                if( confirm(`¿Esta seguro de eliminar producto ${producto.nombre}?`) ){
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
            obtenerProductobase(datos){

                this.nuevoProducto();

                this.producto.idBase = datos.idBase;
                this.producto.ncategoria = datos.ncategoria;
                this.producto.idCategoria = datos.idCategoria;
                this.producto.nombre = datos.nombre;
               // this.producto = JSON.parse(JSON.stringify(datos));
                
            },
            guardarProducto(){
                let fecha = new Date();
                fecha = fecha.toISOString();
                fecha = fecha.slice(0, 10)
                if(this.producto.precio>this.producto.precioe){
                    if( this.producto.fechai<this.producto.fechaf || this.producto.fechai=="" && this.producto.fechaf == ""){
                        if(this.producto.fechai>=fecha){


                            let metodo = 'PUT',
                            url = `/producto/${this.producto.id}`;
                        if(this.producto.accion=="nuevo"){
                            this.producto.idProducto = generarIdUnicoFecha();
                            metodo = 'POST';
                            url = '/producto';
                        }
                        this.producto.idComercio = this.producto.comercio.id;
                        this.producto.nombrecomercio = this.producto.comercio.label;
                        let producto = JSON.parse(JSON.stringify(this.producto));
                        this.sincronizarDatosServidor(producto, metodo, url);
                        this.insertarLocal(producto);

                            
                        }else{
                            alertify.error(`La Fecha inicio debe ser fecha actual o superior`)

                        }
                        

                        

                    }else{
                        alertify.error(`La Fecha inicio debe ser menor a la fecha final`)
                    }
                    
                }else{
                    alertify.error(`El precio especial debe ser menor al precio base`)
                }
                
            },
            fecha(fecha){
                let fechas = new Date(fecha).toISOString();

                return fechas;
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
                    document.getElementById("res1").innerHTML = "Resultados: " + this.productos.length;
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
                                        console.log(`Comercio ${comercio.nombre} guardado`);
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

                //obtener productos base

                let storeba = this.abrirStore('basico', 'readonly'),
                    databa = storeba.getAll();
                databa.onsuccess = e=>{
                    if( databa.result.length<=0 ){
                        fetch(`basico`, 
                            {credentials: 'same-origin'})
                            .then(res=>res.json())
                            .then(databa=>{
                                this.basicos = databa;
                                databa.map(basico=>{
                                    let storeba = this.abrirStore('basico', 'readwrite'),
                                        query = storeba.put(basico);
                                    query.onsuccess = e=>{
                                        console.log(`Producto ${basico.codigo} guardado`);
                                    };
                                    query.onerror = e=>{
                                        console.log(`Error al guardar el producto ${e.target.error}`);
                                    };
                                });
                            })
                            .catch(err=>{
                                alertify.error(`Error al guardar el producto ${err}`);
                            });
                    }
                    let valor1 = "";
                    this.basicos = databa.result.filter(basico=>basico.ncategoria.toLowerCase().indexOf(valor1.toLowerCase())>-1 || basico.nombre.toLowerCase().indexOf(valor1.toLowerCase())>-1);
                    document.getElementById("res2").innerHTML = "Resultados: " + this.basicos.length;
                };
                data.onerror = e=>{
                    alertify.error(`Error al obtener los productos ${e.target.error}`);
                }; 


            
                
            },

            buscarBase(valor){

                let storeba = this.abrirStore('basico', 'readonly'),
                    databa = storeba.getAll();
                databa.onsuccess = e=>{
                    if( databa.result.length<=0 ){
                        fetch(`basico`, 
                            {credentials: 'same-origin'})
                            .then(res=>res.json())
                            .then(databa=>{
                                this.basicos = databa;
                                databa.map(basico=>{
                                    let storeba = this.abrirStore('basico', 'readwrite'),
                                        query = storeba.put(basico);
                                    query.onsuccess = e=>{
                                        console.log(`Producto ${basico.codigo} guardado`);
                                    };
                                    query.onerror = e=>{
                                        console.log(`Error al guardar el producto ${e.target.error}`);
                                    };
                                });
                            })
                            .catch(err=>{
                                alertify.error(`Error al guardar el producto ${err}`);
                            });
                    }
                    
                    this.basicos = databa.result.filter(basico=>basico.ncategoria.toLowerCase().indexOf(valor.toLowerCase())>-1 || basico.nombre.toLowerCase().indexOf(valor.toLowerCase())>-1);
                    document.getElementById("res2").innerHTML = "Resultados: " + this.basicos.length;
                };
                data.onerror = e=>{
                    alertify.error(`Error al obtener los productos ${e.target.error}`);
                }; 


            },
    

            nuevoProducto(){
            this.producto.accion = 'nuevo';
            this.producto.idProducto = '';
            this.producto.codigo = '';
            this.producto.nombre = '';
            this.producto.idP = '';
            this.producto.precio = '';
            this.producto.precioe = '';
            this.producto.fechai = '';
            this.producto.fechaf = '';
            this.producto.idCategoria ='';
            this.producto.ncategoria ='';
            this.producto.imagen ='';
            this.producto.comercio = {
                    id:'',
                    label:'',
                };
            this.codeList();
            },
            codeList() {
                this.obtenerDatos();
                this.producto.codigo = this.productos.length + 1;  
            },
            resultTable(){ 

                let resultabla = document.getElementById("tabla");
                let filas = resultabla.getElementsByTagName("tr");
                document.getElementById("res").innerText = "Resultados: " + (filas.length + 1);     
                
            },

            abrirStore(store, modo){
                return db.transaction(store, modo).objectStore(store);
            },
        },
        created(){
            //this.obtenerDatosComercio();
            if(!Notification){
            alertify.error('El navegador no soporta notificaciones');
            }
            window.permitirNotificaciones = 'default';

            if(Notification.permission !== 'denied'){
                Notification.requestPermission(function(permission){
                    permitirNotificaciones = permission;
                });
            } else {
                permitirNotificaciones = 'denied';
            };
        },
    }
</script>
