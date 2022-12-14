<template>
   
    <div id="appBasico">
        <div class="card">
        
        </div>
        

        
            <div class="card text-dark bg-light mb-3">
                <div class="card-header text-white bg-warning">
                        Administracion de Productos Base
                        <button type="button" class="btn-close text-end" @click="cerrarForm"></button>
                 </div>
                <form @submit.prevent="guardarBasico" @reset.prevent="nuevoBasico" method="post" id="frmMaterias">
                
                   
                    

                        <div class="row p-1">
                        <div class="col col-md-2">Codigo:</div>
                        <div class="col col-md-3">
                            <input disabled title="Ingrese el nombre" v-model="basico.codigo"  required type="text" class="form-control">
                        </div>
                        </div>

                        <div class="row p-1">
                        <div class="col col-md-2">Nombre:</div>
                        <div class="col col-md-3">
                            <input title="Ingrese el nombre" v-model="basico.nombre" pattern="[A-Za-zñÑáéíóúü ]{3,75}" required type="text" class="form-control">
                        </div>
                        </div>
                        

                        <div class="row p-1">
                        <div class="col col-md-2">Precio:</div>
                        <div class="col col-md-3">
                            <input title="Ingrese el nombre" v-model="basico.precio" required type="number" step="0.01" class="form-control">
                        </div>
                        </div>


                        <div class="row p-1">
                                <div class="col col-md-2">Categoria:</div>
                                <div class="col col-md-3">
                                    <v-select-tipos title="Seleccione la categoria" v-model="basico.tipo" :options="tipos" required class="form-control"/>
                                </div>
                            </div>


                        <div class="row p-1">
                            <div class="col col-md-2" >
                            
                        </div>
                        <div class="col col-md-2" >
                            <input class="btn btn-warning" type="reset" value="Nuevo">
                            <input class="btn btn-primary" type="submit" value="Guardar">
                        </div>
                        </div>
                    
                
            </form>
        </div>
    
    <div class="card text-dark bg-light mb-3" id="cardBuscarCliente">
        <div class="card-header text-white bg-warning">
            Busqueda de Productos base 
            
        </div>
        <div class="card-body">
            <table class="table table-light table-striped" id="tabla">
                <thead>
                    <tr>
                        <th colspan="8">
                         <input title="Introduzca el texto a buscar" placeholder="Buscar" @keyup="buscandoBasico" v-model="buscar" class="form-control" type="text">
                            <div class="col col-md-12"  id="res4" >Resultados: </div>
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
                    <tr  v-for="item in basicos" @click='modificarBasico( item )' :key="item.idBase">
                        <td>{{item.codigo}}</td>
                        <td>{{item.nombre}}</td>
                        <td>{{item.precio}}</td>
                        <td>{{item.ncategoria}}</td>
                        <td>
                            <button type="button" class="btn btn-danger" @click="eliminarBasico(item)">Eliminar</button>
                            <button type="button" class="btn btn-success" @click="modificarBasico(item)">Modificar</button>
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
        basicos: [],
        tipos: [],
        buscar: '',
         basico: {
            accion: 'nuevo',
            id: 0,
            idBase:'',
            codigo:'',
            nombre:'',
            precio:'',
            tipo:{
                id:'',
                label:'',
                },
            idCategoria:'',
            ncategoria:'',
            }
        }
        },
        methods:{
            cerrarForm(){
                this.form['basico'].mostrar = false;
            },
            async sincronizarDatosServidor(basico, metodo, url){
                await axios({
                    method : metodo,
                    url,
                    data : basico
                })
                .then(resp=>{
                    if(basico.accion=='nuevo'){
                        basico.id = resp.data.id;
                        this.insertarLocal(basico);//actualizar el id del basico que se genero en el servidor con laravel y mysql
                        alertify.success(`Producto procesado con exito`);
                    }
                    if(basico.accion=='modificar'){
                        alertify.success(`Producto procesado con exito`);
                    }
                    
                })
                .catch(err=>{
                    
                })
            },
            insertarLocal(basico){
                let store = this.abrirStore('basico', 'readwrite'),
                    query = store.put(basico);
                query.onsuccess = e=>{
                    this.nuevoBasico();
                    this.obtenerDatos();
                };
                query.onerror = e=>{
                     alertify.error(`Error al procesar el Producto ${e.target.error}`);
                };
            },
            buscandoBasico(){
                this.obtenerDatos(this.buscar);
            },
            eliminarBasico(basico){
                if( confirm(`¿Esta seguro de eliminar producto ${basico.nombre}?`) ){
                    basico.accion = 'eliminar';
                    let store = this.abrirStore('basico', 'readwrite'),
                        query = store.delete(basico.idBase),
                        metodo = 'DELETE',
                        url = `/basico/${basico.id}`;
                    this.sincronizarDatosServidor(basico, metodo, url);
                    query.onsuccess = e=>{
                        this.nuevoBasico();
                        this.obtenerDatos();
                        alertify.success('Producto eliminado con exito');
                    };
                    query.onerror = e=>{
                        alertify.error = `Error al eliminar el producto ${e.target.error}`;
                    };
                }
                this.nuevoBasico();
            },
            modificarBasico(datos){
                this.basico = JSON.parse(JSON.stringify(datos));
                this.basico.accion = 'modificar';
            },
            guardarBasico(){
        
                        

                        let metodo = 'PUT',
                    url = `/basico/${this.basico.id}`;
                if(this.basico.accion=="nuevo"){
                    this.basico.idBase = generarIdUnicoFecha();
                    metodo = 'POST';
                    url = '/basico';
                }
                
                this.basico.idCategoria = this.basico.tipo.id;
                this.basico.ncategoria = this.basico.tipo.label;
                let basico = JSON.parse(JSON.stringify(this.basico));
                this.sincronizarDatosServidor(basico, metodo, url);
                this.insertarLocal(basico);

                    
                    
               
                
            },
            obtenerDatos(valor=''){
                let store = this.abrirStore('basico', 'readonly'),
                    data = store.getAll();
                data.onsuccess = e=>{
                    if( data.result.length<=0 ){
                        fetch(`basico`, 
                            {credentials: 'same-origin'})
                            .then(res=>res.json())
                            .then(data=>{
                                this.basicos = data;
                                data.map(basico=>{
                                    let store = this.abrirStore('basico', 'readwrite'),
                                        query = store.put(basico);
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
                    this.basicos = data.result.filter(basico=>basico.ncategoria.toLowerCase().indexOf(valor.toLowerCase())>-1 || basico.nombre.toLowerCase().indexOf(valor.toLowerCase())>-1);
                    document.getElementById("res4").innerHTML = "Resultados: " + this.basicos.length;
                };
                data.onerror = e=>{
                    alertify.error(`Error al obtener los productos ${e.target.error}`);
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
    

            nuevoBasico(){
            this.basico.accion = 'nuevo';
            this.basico.idBase = '';
            this.basico.codigo = '';
            this.basico.nombre = '';
            this.basico.precio = '';
            this.basico.categoria ='';
            this.basico.tipo = {
                    id1:'',
                    label1:'',
                };
            this.codeList();
            },
            codeList() {
                this.obtenerDatos();
                this.basico.codigo = this.basicos.length + 1;  
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
        },
    }
</script>
