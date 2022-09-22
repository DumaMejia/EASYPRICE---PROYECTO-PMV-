<template>
   
    <div id="app">
        <div class="card">
        
        </div>
        

        
            <div class="card text-dark bg-light mb-3">
                <div class="card-header text-white bg-warning">
                        Administracion de Categorias
                        <button type="button" class="btn-close text-end" @click="cerrarForm"></button>
                 </div>
                <form @submit.prevent="guardarTipo" @reset.prevent="nuevoTipo" method="post" id="frmMaterias">
                
                   
                    

                        <div class="row p-1">
                        <div class="col col-md-2">Codigo:</div>
                        <div class="col col-md-3">
                            <input disabled title="Ingrese el nombre" v-model="tipo.codigo"  required type="text" class="form-control">
                        </div>
                        </div>

                        <div class="row p-1">
                        <div class="col col-md-2">Nombre:</div>
                        <div class="col col-md-3">
                            <input title="Ingrese el nombre" v-model="tipo.nombre" placeholder="Ejemplo: Bebidas" pattern="[A-Za-zñÑáéíóúü ]{3,75}" required type="text" class="form-control">
                        </div>
                        </div>

                        <div class="row p-1">
                            <div class="col col-md-2" >
                            
                        </div>
                            <div class="col col-md-2">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="reset" class="btn btn-warning">Nuevo</button>
                            </div>
                        </div>
                    
                
            </form>
        </div>
    
    <div class="card text-dark bg-light mb-3" id="cardBuscarCliente">
        <div class="card-header text-white bg-warning">
            Busqueda de Categorias 
            
        </div>
        <div class="card-body">
            <table class="table table-light table-striped" id="tabla">
                <thead>
                    <tr>
                        <th colspan="8">
                            <input title="Introduzca el texto a buscar" placeholder="Buscar" @keyup="buscandoTipo" v-model="buscar" class="form-control" type="text">
                            <div class="col col-md-12"  id="res2" >Resultados: </div>
                        </th>
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
        productos: [],
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
                        alertify.success(`Categoria procesada con exito`);
                    }
                    if(tipo.accion=='modificar'){
                        alertify.success(`Categoria procesada con exito`);
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
                    this.tipo.msg = 'Categoria procesada con exito';
                };
                query.onerror = e=>{
                    alertify.error(`Error al procesar la categoria ${e.target.error}`);
                };
            },
            buscandoTipo(){
                this.obtenerDatos(this.buscar);
            },
            eliminarTipo(tipo){
                let var1 = 0;
                this.productos.forEach(productos =>{
                   if(tipo.id == productos.idCategoria){

                    var1 = var1 +1;
                   } 
                });
                if(var1 == 0){
                    if( confirm(`¿Esta seguro de eliminar la categoria ${tipo.nombre}?`) ){
                    
                    tipo.accion = 'eliminar';
                    let store = this.abrirStore('tipo', 'readwrite'),
                        query = store.delete(tipo.idTipo),
                        metodo = 'DELETE',
                        url = `/tipo/${tipo.id}`;
                    this.sincronizarDatosServidor(tipo, metodo, url);
                    query.onsuccess = e=>{
                        this.nuevoTipo();
                        this.obtenerDatos();
                        alertify.success('Categoria eliminada con exito');
                    };
                    query.onerror = e=>{
                        alertify.error(`Error al eliminar la categoria ${e.target.error}`);
                    };
                }
                }else{
                    alertify.error(`No se puede eliminar la categoría ${tipo.nombre} ya que existen ` + var1 + ` Productos relacionados`)
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
                                        console.log(`Error al guardar la categoria ${e.target.error}`);
                                    };
                                });
                            })
                            .catch(err=>{
                                alertify.error(`Error al guardar el categoria ${err}`);
                            });
                    }
                    this.tipos = data.result.filter(tipo=>tipo.nombre.toLowerCase().indexOf(valor.toLowerCase())>-1);
                    document.getElementById("res2").innerHTML = "Resultados: " + this.tipos.length;
                };
                data.onerror = e=>{
                    alertify.error(`Error al obtener los categoria ${e.target.error}`);
                }; 

                //Productos

                let storeProductos = this.abrirStore('producto', 'readonly'),
                    datap = storeProductos.getAll();
                datap.onsuccess = e=>{
                    if( datap.result.length<=0 ){
                        fetch(`producto`, 
                            {credentials: 'same-origin'})
                            .then(res=>res.json())
                            .then(datap=>{
                                this.productos = datap;
                                datap.map(producto=>{
                                    let storeProductos = this.abrirStore('producto', 'readwrite'),
                                        query = storeProductos.put(producto);
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
                    let valor1 = "";
                    this.productos = datap.result.filter(producto=>producto.ncategoria.toLowerCase().indexOf(valor1.toLowerCase())>-1);
                    
                    
                };
                data.onerror = e=>{
                    alertify.error(`Error al obtener los productos ${e.target.error}`);
                }; 
                
            },
    

            nuevoTipo(){
            this.tipo.accion = 'nuevo';
            this.tipo.idTipo = '';
            this.tipo.codigo = '';
            this.tipo.nombre = '';

            this.codeList();
            },
            codeList() {
                this.obtenerDatos();
                this.tipo.codigo = this.tipos.length + 1;  
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
