<template>



 <div>
     
    <div class="card text-dark bg-light mb-3">
      <div class="card-body">
        
        <div class="container m-3">
        
    
    <form align="center">
        
    
        <div class="input-group mb-3">
        <input type="text" class="form-control" v-model="depmun.valor" aria-describedby="button-addon2">
        <button class="btn btn-outline-primary" type="button" id="button-addon2" @click="mapCenter">Buscar</button>
        </div>
        <div class="btn-group">
            <select @click="mapCenter" v-model="depmun.valor" class="form-select btn-warning" placeholder="Seleccione Un Departamento" aria-label="Default select example">
                    <option class="btn btn-light"  selected>Seleccione un Departamento</option>
                    <option class="btn btn-light" value="ahuachapan">Ahuachapan</option>
                    <option class="btn btn-light" value="san salvador">San Salvador</option>
                    <option class="btn btn-light" value="usulutan">Usulután</option>
            </select>
         </div>

         <div class="btn-group">
            <button type="button" class="btn btn-outline-info" @contextmenu="indigps"    @click="mapCentergps">
               
                <i class="fa fa-google mr-2"></i>
                 <img  src="image/gps2.png" width="20" height="20">
                  
                </button>
        </div>

       <div class="btn-group">
            <select @click="mapCenter" v-model="depmun.valor" class="form-select  btn-warning" placeholder="Seleccione Municipio" aria-label="Default select example">
                    <option class="btn btn-light"  selected>Seleccione Un Municipio</option>
                    <option class="btn btn-light" value="santa maria">Santa Maria</option>
                    <option class="btn btn-light" value="santa elena">Santa Elena</option>
                    <option class="btn btn-light" value="alegria">Alegria</option>
            </select>
        </div>
    </form>

    

    </div>

    
                <div class="card-header text-white bg-warning text-center">
                Filtros de busqueda
                </div>
                 
                
                
                <form  >
                <div class="row p-1">
                    <div class="container">
                    <div class="row">
                        <div class="col border border-dark">
                            <div class="row p-1">
                        <div class="col col-md-4">Salario:</div>
                        <div class="col col-md-4">
                            <input title="SALARIO" required type="number" step="0.01" pattern="[0-9]{3,10}"  class="form-control" style="width : 250px">
                        </div>
                    </div>
                    <div class="row p-1" >
                            <div   visibility="hidden" class="col col-md-4">Tipo de comercio:</div>
                            <div class="col col-md-4">
                                <select  v-model="comercio.tipo" class="form-select" aria-label=".form-select-sm example" style="width : 250px">
                                    <option  selected>Selecciona Tipo De Empresa</option>
                                    <option value="Pequeña Empresa">Pequeña Empresa</option>
                                    <option value="Mediana Empresa">Mediana Empresa</option>
                                    <option value="Gran Empresa">Gran Empresa</option>
                                  </select>
                            </div> 
                    </div>

                    <div class="row p-1">


                        <div class="col col-md-7" >
                            Buscar productos
                            <table class="table table-light table-striped" id="tabla">
                            <thead>
                                <tr>
                                    <th colspan="8">
            
                                    <input title="Introduzca el texto a buscar" placeholder="Buscar Producto"  @keyup="buscandoProductoBase" v-model="buscar1" class="form-control" type="text" style="width : 355px" >
                                        <div class="col col-md-12"  id="res2" >Resultados: </div>
                                        <div class="col col-md-12"  id="" ></div>
                                    </th>
                                </tr>
                                
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio Sugerido</th>
                                    <th>Cantidad</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                <tr  v-for="item in basicos" :key="item.idBase">
                                    <td>{{item.nombre}}</td>
                                    <td>{{item.precio}}</td>
                                    <td>
                                        <input  required type="number" step="1.00" pattern="[0-9]{3,10}"  class="form-control" v-model="cantidad">
                                    </td>
                                    <td>
                                        
                                        <button type="button" class="btn btn-success" @click="obtenerProductobase(item)" >Agregar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        
                        

                        

                        

                    </div> 

                        </div>
                        <div class="col border border-dark">
                            Lista de productos
                            <table class="table table-light table-striped" id="tablalista" >
                            <thead>
                                <tr>
                                    <th colspan="8">
                                    
                                        <div class="col col-md-12"  id="res3"  >Resultados: </div>
                                        <div class="col col-md-12"  id="total" value="0">Total: </div>
                                        
                                    </th>
                                </tr>
                                
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio Sugerido</th>
                                    <th>Cantidad</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in lista" :key="item.idBase">
                                    <td>{{item.nombre}}</td>
                                    <td>{{item.precio}}</td>
                                    <td>{{item.cantidad}}</td>
                                    <td>
                                        
                                        <button type="button" class="btn btn-danger" @click="eliminarProductobase(item)" >Eliminar</button>
                                    </td>   
                                </tr>
                            </tbody>
                        </table>
                        

                        <button type="button" class="btn btn-warning"  @click="filtrarComercio()">Filtrar</button>
                        </div>
                        <div class="col border border-dark">
                            Comercios Disponibles
                        <table class="table table-light table-striped" id="tabla" style="width: 500px" >
                            <thead>
                                <tr>
                                    <th colspan="8">
                                        <div class="col col-md-12"  id="rescom" >Resultados: </div>
                                    </th>
                                </tr>
                                
                                <tr>
                                    <th>Nombre</th>
                                    <th>Direccion</th>
                                    <th>Tipo de comercio</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                <tr  v-for="item in comerciosfil" :key="item.idComercio">
                                    <td>{{item.nombre}}</td>
                                    <td>{{item.direccion}}</td>
                                    <td>{{item.tipo}}</td>
                                    <td>
                                        
                                        <button type="button" class="btn btn-primary" @click="verProducto(item)" >Ver Productos</button>
                                    </td>
                                    <td>
                                        
                                        <button type="button" class="btn btn-primary" @click="verUbicacion(item)" >Ver Ubicacion</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                       
                       
                            Productos Disponibles
                        <table class="table table-light table-striped" id="tabla" style="width: 500px">
                            <thead>
                                <tr>
                                    <th colspan="8">
                                        <div class="col col-md-12"  id="respo" >Resultados: </div>
                                    </th>
                                </tr>
                                
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio Base</th>
                                    <th>Precio Especial</th>
                                    <th>Fecha Final (precio especial)</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in productosfil" :key="item.idProducto">
                                    <td>{{item.nombre}}</td>
                                    <td>{{item.precio}}</td>
                                    <td>{{item.precioe}}</td>
                                    <td>{{item.fechaf}}</td>
                                </tr>
                            </tbody>
                        </table>
                       
                        </div>
                    </div>
                    </div>
                    
                  

                
                
                    

                    

                </div>
                    
                </form>
            
        

        <div>

        <div class="container m-3 ">
                
                   <GmapMap
                    :center="ubicacion"
                    :zoom="14"

                    map-type-id="roadmap"
                    style="width: 1200px; height: 400px; margin: 32px auto"
                    >
                    <Gmap-info-window 
                    :option="infoWindowOptions" 
                    :position="infoWindowPosition()"
                    :opened="infoWindowOpened"
                    @closeclick="handleInfoWindowClose">
                    <div class="info-window">
                        <h2 v-text="activeComercio.nombre"> </h2>
                        <h5 v-text="activeComercio.direccion"></h5>
                        <p v-text="activeComercio.tipo"></p>
                    </div>
                    
                    </Gmap-info-window>
                    <GmapMarker
                        v-for="item in comercios"
                        :key="item.id"
                       :position="getMark(item)"
                       :clickable="true"
                       :draggable="false"
                       @click="handleMarkclicked(item)"
                    />
                    </GmapMap>
                
            </div>


            

            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel" width="1000" height="100" align="center">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000" >


        <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://cdn-pro.elsalvador.com/wp-content/uploads/2019/10/Imagen-shutterstock_152186840.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Canasta basica</h5>
                        <p class="card-text">Productos en oferta</p>
                        <a href="#" class="btn btn-primary">Ver aqui</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://copades.com/monec/wp-content/uploads/2021/07/ca-1-720x340.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Canasta basica</h5>
                        <p class="card-text">Productos en oferta</p>
                        <a href="#" class="btn btn-primary">Ver aqui</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://s3.amazonaws.com/prod-wp-hrn/wp-content/uploads/2021/02/canasta-basica-subio.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Canasta basica</h5>
                        <p class="card-text">Productos en oferta</p>
                        <a href="#" class="btn btn-primary">Ver aqui</a>
                    </div>
                </div>
            </div>
          
        </div>

    </div>

    <div class="carousel-item" data-bs-interval="2000">


    <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://cdn-pro.elsalvador.com/wp-content/uploads/2019/10/Imagen-shutterstock_152186840.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Canasta basica</h5>
                        <p class="card-text">Productos en oferta</p>
                        <a href="#" class="btn btn-primary">Ver aqui</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://copades.com/monec/wp-content/uploads/2021/07/ca-1-720x340.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Canasta basica</h5>
                        <p class="card-text">Productos en oferta</p>
                        <a href="#" class="btn btn-primary">Ver aqui</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://s3.amazonaws.com/prod-wp-hrn/wp-content/uploads/2021/02/canasta-basica-subio.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Canasta basica</h5>
                        <p class="card-text">Productos en oferta</p>
                        <a href="#" class="btn btn-primary">Ver aqui</a>
                    </div>
                </div>
            </div>
          
        </div>

    </div>

    <div class="carousel-item">

    <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://cdn-pro.elsalvador.com/wp-content/uploads/2019/10/Imagen-shutterstock_152186840.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Canasta basica</h5>
                        <p class="card-text">Productos en oferta</p>
                        <a href="#" class="btn btn-primary">Ver aqui</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://copades.com/monec/wp-content/uploads/2021/07/ca-1-720x340.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Canasta basica</h5>
                        <p class="card-text">Productos en oferta</p>
                        <a href="#" class="btn btn-primary">Ver aqui</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://s3.amazonaws.com/prod-wp-hrn/wp-content/uploads/2021/02/canasta-basica-subio.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Canasta basica</h5>
                        <p class="card-text">Productos en oferta</p>
                        <a href="#" class="btn btn-primary">ver aqui</a>
                    </div>
                </div>
            </div>
          
        </div>

    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
                
        </div>


      </div>
    </div>

    

        


            
                
        </div>

</template>
<script src="https://kit.fontawesome.com/1302715a40.js" crossorigin="anonymous"></script>
<script>

  export default {
        props : ['form'],
         data:()=>{
            return {
                
                comercios:[],
                comerciosfil:[],
                productos: [],
                productosfil: [],
                basicos: [],
                lista: [],
                buscar1: '',
                cantidad: '',
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
                },

                base:{
                    idBase : '',
                    nombre : '',
                    precio: ''
                },

                ubicacion:{
                    lat : 13.343565797622999,
                    lng : -88.43976983311296,
                },
                depmun:{
                    valor :'',
                },
                gps:{
                    lat : 10,
                    lng : 10,
                },
                infoWindowOptions:{
                    pixelOffset :{
                        width: 0,
                        height: -35
                    }
                },
                activeComercio:{
                    lat : 10,
                    lng : 10,
                },
                infoWindowOpened:false,

            }
        },
        methods:{
            handleMarkclicked(item){
                this.activeComercio = item;
                this.infoWindowOpened = true;

                this.productosfil.splice(0, this.productosfil.length);



                this.productos.forEach(productos =>{
                   if(item.id == productos.idComercio){

                    this.productosfil.push({idProducto : productos.idProducto, IdComercio : productos.idComercio, nombre : productos.nombre, precio : productos.precio,  precioe : productos.precioe, fechaf : productos.fechaf});

                   }    
                });
                
            }, 
            handleInfoWindowClose(){
                this.activeComercio = {};
                this.infoWindowOpened = false;
            },
            infoWindowPosition(){
                return{
                    lat : parseFloat(this.activeComercio.latitude),
                    lng : parseFloat(this.activeComercio.longitude),
                }
            },
            getMark(item){
                return{
                    lat : parseFloat(item.latitude),
                    lng : parseFloat(item.longitude),
                }
            },

            obtenerProductobase(item){

                let repe = 0;
                this.lista.forEach(productos =>{
                   if(item.idBase == productos.idBase){

                        repe = repe + 1;
                   }    
                });

                if(repe == 0){
                    this.lista.push({idBase : item.idBase, nombre : item.nombre, precio : item.precio, cantidad : this.cantidad});
                }else{
                    alertify.error(`Ya tienes este producto agregado`)
                };

                document.getElementById("res3").innerHTML = "Resultados: " + this.lista.length;

                let total = 0;
                let precio = 0;
                let cantidad = 0;
                

                this.lista.forEach(productos =>{
                 precio =  productos.precio;
                 cantidad = productos.cantidad;

                 total = total + precio * cantidad;
                });

                document.getElementById("total").innerHTML = "Total: " + total;

                
            },

            eliminarProductobase(item){

              
                let var1 = 0;
                let var2 = 0;
                this.lista.forEach(productos =>{
                   if(item.idBase == productos.idBase){

                    var2 = var1;
                 

                   } 
                
                   var1 = var1 +1;
                   
                });


                    this.lista.splice(var2, var2);
                    if(var2==0){
                        this.lista.splice(0, 1);
                    }

                    document.getElementById("res3").innerHTML = "Resultados: " + this.lista.length;

                    let total = 0;
                    let precio = 0;
                    let cantidad = 0;
                

                    this.lista.forEach(productos =>{
                    precio =  productos.precio;
                    cantidad = productos.cantidad;

                    total = total + precio * cantidad;
                });

                document.getElementById("total").innerHTML = "Total: " + total;
                

            },

            filtrarComercio(valor=''){

                //productos

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
                
                
                



                //comercios 
                

                this.comerciosfil.splice(0, this.comerciosfil.length);
                if(this.lista.length>0){
                    this.obtenerDatos();
                    let numcom = 0;
                    this.lista.forEach(basicos =>{
                        this.productos.forEach(productos =>{

                         if(basicos.idBase == productos.idBase){
                            numcom = numcom + 1;
                            if(numcom>0){

                                this.comercios.forEach(comercios =>{

                                    if(comercios.id == productos.idComercio){

                                        this.comerciosfil.push({idComercio : comercios.id, direccion : comercios.direccion, nombre : comercios.nombre, latitude : comercios.latitude,  longitude : comercios.longitude, tipo : comercios.tipo});
                                    };

                                    

                                });

                                

                            };

                        };
                        
                        
                   
                        });

                        
                    });
                    this.comercios.splice(0, this.comercios.length);
                    this.comercios = this.comerciosfil;
                };
                    

                    

                    if(this.lista.length == 0){
                            this.comercios.forEach(comercios =>{
                            this.comerciosfil.push({idComercio : comercios.id, direccion : comercios.direccion, nombre : comercios.nombre, latitude : comercios.latitude,  longitude : comercios.longitude, tipo : comercios.tipo});
                        });
                        this.obtenerDatos();
                    };

                    


                   
                    document.getElementById("rescom").innerHTML = "Resultados: " + this.comerciosfil.length;
               


                

            },

            verProducto(item){

                this.productosfil.splice(0, this.productosfil.length);


                this.productos.forEach(productos =>{
                   if(item.id == productos.idComercio){

                    this.productosfil.push({idProducto : productos.idProducto, IdComercio : productos.idComercio, nombre : productos.nombre, precio : productos.precio,  precioe : productos.precioe, fechaf : productos.fechaf});

                   }    
                });


            },
            verUbicacion(item){

                

                this.ubicacion.lat = parseFloat(item.latitude);
                this.ubicacion.lng = parseFloat(item.longitude);
                this.activeComercio = item;
                this.infoWindowOpened = true;

                window.scroll(0, 800);



            },

            mapCenter(){
                if(this.depmun.valor=="ahuachapan"){
                    this.ubicacion.lat = 13.922733648736088;
                    this.ubicacion.lng = -89.84554859477569;

                };
                if(this.depmun.valor=="san salvador"){
                    this.ubicacion.lat = 13.697813428718089;
                    this.ubicacion.lng = -89.21799925241162;

                };
                if(this.depmun.valor=="usulutan"){
                    this.ubicacion.lat = 13.345611871500576;
                    this.ubicacion.lng = -88.43976983311296;

                };
                if(this.depmun.valor=="santa maria"){
                    this.ubicacion.lat = 13.34619540428378;
                    this.ubicacion.lng = -88.41608077882177;

                };
                if(this.depmun.valor=="santa elena"){
                    this.ubicacion.lat = 13.380807927031531;
                    this.ubicacion.lng = -88.41131026521978;

                };
                if(this.depmun.valor=="alegria"){
                    this.ubicacion.lat = 13.509147734778331;
                    this.ubicacion.lng = -88.48701958897692;

                };

                
            },

            mapCentergps(){
                let gps;
                this.$getLocation({})
                .then(gps => {
                this.ubicacion = gps;
                })
            },

            
           
          
            buscandoComercio(){
                this.obtenerDatos(this.buscar);
            },

            buscandoProductoBase(){
                this.buscarBase(this.buscar1);
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
                                this.comercio.msg = `Error al guardar el comercio ${err}`;
                            });
                    }
                    this.comercios = data.result.filter(comercio=>comercio.nombre.toLowerCase().indexOf(valor.toLowerCase())>-1 || comercio.tipo.toLowerCase().indexOf(valor.toLowerCase())>-1 || comercio.codigo.toLowerCase().indexOf(valor.toLowerCase())>-1);
                    
                };
                data.onerror = e=>{
                    this.comercio.msg = `Error al obtener los comercios ${e.target.error}`;
                };

                //otener productos base 

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


            nuevoComercio(){
                this.comercio.accion = 'nuevo';
                this.comercio.msg = '';
                this.comercio.idComercio = '';
                this.comercio.codigo = '';
                this.comercio.nombre = '';
                this.comercio.direccion = '';
                this.comercio.telefono = '';
                this.comercio.correo = '';
                this.comercio.tipo = '';
            },
            abrirStore(store, modo){
                return db.transaction(store, modo).objectStore(store);
            },
            indigps(){
                document.oncontextmenu = function(){return false;};
                alertify.alert(`El filtro de ubicación accede a tu ubicación actual siempre y cuando hayas dado el permiso requerido.`)
            },
           
        },
        created(){
            //this.obtenerDatos();
           
            
            
        },
    }

</script>
