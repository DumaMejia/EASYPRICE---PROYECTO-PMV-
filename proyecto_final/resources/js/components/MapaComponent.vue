<template>



 <div>
     
    <div class="card text-dark bg-light mb-3">
      <div class="card-body">
        
        <div class="container m-3">
    
    

    </div>

    
                <div class="card-header text-white bg-warning text-center" @contextmenu="indifiltros">
                Filtros de busqueda
                </div>
                 
                
                
                <form  >
                <div class="row p-1">
                    <div class="container">
                    <div class="row">
                        <div class="col border border-dark">
                            <div class="row p-1">
                        <div class="col col-md-4">Presupuesto:</div>
                        <div class="col col-md-4">
                            <input title="SALARIO" required type="number" step="0.01" pattern="[0-9]{3,10}" v-model="salario" class="form-control" style="width : 250px">
                        </div>
                    </div>
                    <div class="row p-1" >
                            <div   visibility="hidden" class="col col-md-4">Tipo de comercio:</div>
                            <div class="col col-md-4">
                                <select  v-model="tipo" class="form-select"  aria-label=".form-select-sm example" style="width : 250px" >
                                    <option  selected>Selecciona Tipo De Empresa</option>
                                    <option value="Todas">Todas</option>
                                    <option value="Pequeña Empresa">Pequeña Empresa</option>
                                    <option value="Mediana Empresa">Mediana Empresa</option>
                                    <option value="Gran Empresa">Gran Empresa</option>
                                  </select>
                            </div> 
                    </div>

                    <div class="row p-1">
                        <div   visibility="hidden" class="col col-md-4">Departamento:</div>
                        <div class="col col-md-4">
                         <select @click="mapCenter" v-model="depmun.valor" class="form-select btn-warning" placeholder="Seleccione Un Departamento" aria-label="Default select example">
                            <option class="btn btn-light"  selected>Seleccione un Departamento</option>
                            <option class="btn btn-light" value="ahuachapan">Ahuachapan</option>
                            <option class="btn btn-light" value="san salvador">San Salvador</option>
                            <option class="btn btn-light" value="usulutan">Usulután</option>
                         </select>
                        </div>
                    </div>

                    <div class="btn-group">
                        <div class="col col-md-5">
                         <button type="button" class="btn btn-outline-info" @contextmenu="indigps"    @click="mapCentergps">   
                            <i class="fa fa-google mr-2"></i>
                            <img  src="image/gps2.png" width="20" height="20">
                        </button>
                    </div>
                    </div>

                    <div class="row p-1">
                      <div   visibility="hidden" class="col col-md-4">Municipio:</div>
                      <div class="col col-md-4">
                    <select @click="mapCenter" v-model="depmun.valor" class="form-select  btn-warning" placeholder="Seleccione Municipio" aria-label="Default select example">
                        <option class="btn btn-light"  selected>Seleccione Un Municipio</option>
                        <option class="btn btn-light" value="santa maria">Santa Maria</option>
                        <option class="btn btn-light" value="santa elena">Santa Elena</option>
                        <option class="btn btn-light" value="alegria">Alegria</option>
                     </select>
                    </div>
                    </div>
                    <div class="col border border-dark">

                    
                     <div class="row p-1">
                         <div class="col col-md-4">Producto:</div>
                         <div class="col col-md-4">
                            <v-select-comercios title="Seleccione el Producto" v-model="base" :options="basicos" required class="form-control" style="width : 250px"/>
                        </div>
                     </div>
                     <div class="row p-1">
                        <div class="col col-md-4">cantidad:</div>
                        <div class="col col-md-4">
                            <input  required type="number" step="1.00" pattern="[0-9]{3,10}"  class="form-control" v-model="cantidad" style="width : 250px">
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col col-md-4">
                            <button type="button" class="btn btn-success"  @click="obtenerProductobase()">Agregar</button>
                        </div>
                    </div>
                    
                </div> 

        <div class="row p-1">
            Lista de productos
                            <table class="table table-light table-striped scroll" id="tablalista" style="width: 400px">
                            <thead>
                                <tr>
                                    <th colspan="10">
                                    
                                        <div class="col col-md-12"  id="res3" style="width: 400px" >Resultados: </div>
                                        <div class="col col-md-12"  id="total" value="0">Total: </div>
                                        
                                    </th>
                                </tr>
                                
                                <tr>
                                    <th >Nombre</th>
                                    <th>Precio Sugerido</th>
                                    <th>Cantidad</th>
                                
                                </tr>
                            </thead>
                            <tbody style="height: 200px;">
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
                        

                        <button type="button" class="btn btn-warning text-white"  @click="filtrarComercio()">Filtrar</button>
                        
                        
                        

                        


    </div> 

                        </div>
                        <div class="col border border-dark">
                            <div class="container m-3 ">
                
                <GmapMap
                 :center="ubicacion"
                 :zoom="14"

                 map-type-id="roadmap"
                 style="width: 800px; height: 400px; margin-left: 1px;"
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
                     v-for="item in comerciosfil"
                     :key="item.id"
                    :position="getMark(item)"
                    :clickable="true"
                    :draggable="false"
                    @click="handleMarkclicked(item)"
                 />
                 </GmapMap>

                 Productos Disponibles
                 <table class="table table-light table-striped scroll" id="tabla" style="width: 800px">
                            <thead>
                                <tr>
                                    <th colspan="8">
                                        <div class="col col-md-12"  id="respo" style="width: 400px">Resultados: </div>
                                        <div class="col col-md-12"  id="totalpo" value="0">Total: </div>
                                    </th>
                                </tr>
                                
                                <tr>
                                    <th style="width: 200px">Nombre</th>
                                    <th style="width: 200px">Precio Base</th>
                                    <th style="width: 200px">Precio Especial</th>
                                    <th style="width: 200px">Fecha Final (precio especial)</th>
                                
                                </tr>
                            </thead>
                            <tbody style="height: 150px;">
                                <tr v-for="item in productosfil" :key="item.idProducto">
                                    <td style="width: 200px">{{item.nombre}}</td>
                                    <td style="width: 200px">{{item.precio}}</td>
                                    <td style="width: 200px">{{item.precioe}}</td>
                                    <td style="width: 200px">{{item.fechaf}}</td>
                                </tr>
                            </tbody>
                        </table>
         </div>
                        </div>
                        
                    </div>
                    </div>
                    
                  

                
                
                    

                    

                </div>
                    
                </form>
            
        

        <div>

        


            

            
                
        </div>


      </div>
    </div>
    <div class="card-header text-white bg-secondary text-center" >
                Comercios Destacados
    </div>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Tipo</th>
      <th scope="col">Ubicacion</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="item in comercios" :key="item.idComercio">
      <th scope="row">1</th>
      <td>{{item.nombre}}</td>
      <td>{{item.tipo}}</td>
      <td>{{item.direccion}}</td>
      <td>
        <button type="button" class="btn btn-primary" @click="verUbicacion(item)" >Ver Ubicacion</button>
      </td>
    </tr>
  </tbody>
</table>
          
    
       
    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>Sigue en contacto con nosotros:</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-google"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-linkedin"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>EasyPrice Company
          </h6>
          <p>
            Esperamos que su experiencia en EasyPrice sea grata y de utlidad.
            aqui te dejamos unos enlaces que pueden resultarte utiles.
            tambien tienes  nuestros contactos de empresa por si buscas ayuda.
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Ventanas
          </h6>
          <p>
            <a href="#!" @click="abrirForma()" class="text-reset">Inicio</a>
          </p>
          <p>
            <a href="#!"  class="text-reset">Mapa</a>
          </p>
          <p>
            <a href="http://127.0.0.1:8000/NewPassword" class="text-reset">Mi Cuenta</a>
          </p>
          <p>
            <a href="#!" @click="abrirAyuda()" class="text-reset">Ayuda</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Enlaces Utiles
          </h6>
          <p>
            <a href="https://www.defensoria.gob.sv/" class="text-reset">D. Del Consumidor</a>
          </p>
          <p>
            <a href="https://www.superselectos.com/" class="text-reset"> Super Selectos</a>
          </p>
          <p>
            <a href="https://www.walmart.com.sv/" class="text-reset">Walmart</a>
          </p>
          
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contacto</h6>
          <p><i class="fas fa-home me-3"></i> Usulutan, Usulutan, SV</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            easyprice@info.com
          </p>
          <p><i class="fas fa-phone me-3"></i> + 503 7209-9091</p>
          <p><i class="fas fa-print me-3"></i> + 503 2626-6767</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2022 Copyright:
    <a class="text-reset fw-bold" href="https://easyprice.tk">EasyPrice Company</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
        


            
                
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
                salario: '',
                tipo: '',
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
                    id : '',
                    label : '',
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
                   if(item.idComercio == productos.idComercio){
                    this.lista.forEach(basicos =>{
                        if(basicos.idBase == productos.idBase){
                            this.productosfil.push({idProducto : productos.idProducto, idBase : productos.idBase, IdComercio : productos.idComercio, nombre : productos.nombre, precio : productos.precio,  precioe : productos.precioe, fechaf : productos.fechaf});
                        };

                    });
                    if(this.lista.length==0){
                        this.productosfil.push({idProducto : productos.idProducto, idBase : productos.idBase, IdComercio : productos.idComercio, nombre : productos.nombre, precio : productos.precio,  precioe : productos.precioe, fechaf : productos.fechaf});
                    };

                    

                   }    
                });

                document.getElementById("respo").innerHTML = "Resultados: " + this.productosfil.length;

                let precio = 0;
                let cantidad = 0;
                let total = 0;
                let fecha = new Date();
                fecha = fecha.toISOString();
                fecha = fecha.slice(0, 10)

                this.productosfil.forEach(productos =>{
                    this.lista.forEach(lista =>{
                        if(lista.idBase == productos.idBase){
                            if(productos.fechaf < fecha){
                                precio =  productos.precio;
                            };
                            if(productos.fechaf >= fecha){
                                precio =  productos.precioe;
                            };
                            
                            
                            cantidad = lista.cantidad;
                            total = total + precio * cantidad;
                        };
                    });
                });

                document.getElementById("totalpo").innerHTML = "Total: " + total;


                
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

            obtenerProductobase(){
                
                let repe = 0;
                this.lista.forEach(productos =>{
                   if(this.base.id == productos.idBase){
                    
                        repe = repe + 1;
                   }    
                });

                if(repe == 0){
                    if(this.cantidad != "" && this.cantidad >= 1){
                        this.lista.push({idBase : this.base.id, nombre : this.base.label, precio : this.base.precio, cantidad : this.cantidad});
                    }else{
                        alertify.error(`Por favor agrega una cantidad valida`)
                    };
                    
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
                 if(this.salario == "" || this.salario > total){
                    
                }else{
                    alertify.error(`Te has pasado del salario establecido`)
                    total = total - precio * cantidad;
                    this.lista.splice(this.lista.length - 1, this.lista.length);
                    

                };
                });

                

                

                
                

                document.getElementById("total").innerHTML = "Total: " + total.toFixed(2);

                
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

            obtenerProducto(valor=''){

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

            },

            filtrarComercio(){

                this.productosfil.splice(0, this.productosfil.length);
                document.getElementById("respo").innerHTML = "Resultados: " + this.productosfil.length;
                this.obtenerProducto();

                if(this.lista.length == 0){
                    this.comerciosfil.splice(0, this.comerciosfil.length);
                    this.comercios.forEach(comercios =>{
                        if(comercios.tipo == this.tipo || this.tipo == "" || this.tipo == "Todas" || this.tipo == "Selecciona Tipo De Empresa"){
                            this.comerciosfil.push({idComercio : comercios.id, direccion : comercios.direccion, nombre : comercios.nombre, latitude : comercios.latitude,  longitude : comercios.longitude, tipo : comercios.tipo});
                        };
                        
                    
                    });
                };

                let numcom = 0;
                

                if(this.lista.length > 0){

                        this.comerciosfil.splice(0, this.comerciosfil.length);
                        this.lista.forEach(basicos =>{
                        this.productos.forEach(productos =>{
                            
                         if(basicos.idBase == productos.idBase){
                            numcom = numcom + 1;
                            if(numcom > 0){
                                this.comercios.forEach(comercios =>{


                                    if(comercios.id == productos.idComercio){
                                        if(this.comerciosfil.length > 0){
                                            this.comerciosfil.forEach(comerciosfil =>{
                                            if(comerciosfil.idComercio !=  productos.idComercio){
                                                if(comercios.tipo == this.tipo || this.tipo == "" || this.tipo == "Todas" || this.tipo == "Selecciona Tipo De Empresa"){
                                                    this.comerciosfil.push({idComercio : comercios.id, direccion : comercios.direccion, nombre : comercios.nombre, latitude : comercios.latitude,  longitude : comercios.longitude, tipo : comercios.tipo});
                                                };
                                                
                                            }else{
                                                
                                            };
                                        });
                                        }else{
                                            if(comercios.tipo == this.tipo || this.tipo == "" || this.tipo == "Todas" || this.tipo == "Selecciona Tipo De Empresa"){
                                                this.comerciosfil.push({idComercio : comercios.id, direccion : comercios.direccion, nombre : comercios.nombre, latitude : comercios.latitude,  longitude : comercios.longitude, tipo : comercios.tipo});
                                            };
                                            
                                        };
                                        
                                        
                                    };

                                    

                                    

                                });

                                

                            };

                        };
                        
                        
                   
                        });

                        
                    });


                    
                   
                };

                    


                
                    
               


                

            },


            verProducto(item){

                this.productosfil.splice(0, this.productosfil.length);


                this.productos.forEach(productos =>{
                   if(item.idComercio == productos.idComercio){
                    this.lista.forEach(basicos =>{
                        if(basicos.idBase == productos.idBase){
                            this.productosfil.push({idProducto : productos.idProducto, idBase : productos.idBase, IdComercio : productos.idComercio, nombre : productos.nombre, precio : productos.precio,  precioe : productos.precioe, fechaf : productos.fechaf});
                        };

                    });
                    if(this.lista.length==0){
                        
                        this.productosfil.push({idProducto : productos.idProducto, idBase : productos.idBase, IdComercio : productos.idComercio, nombre : productos.nombre, precio : productos.precio,  precioe : productos.precioe, fechaf : productos.fechaf});
                    };

                    

                   }    
                });

                document.getElementById("respo").innerHTML = "Resultados: " + this.productosfil.length;

                let precio = 0;
                let cantidad = 0;
                let total = 0;
                let fecha = new Date();
                fecha = fecha.toISOString();
                fecha = fecha.slice(0, 10)

                this.productosfil.forEach(productos =>{
                    this.lista.forEach(lista =>{
                        if(lista.idBase == productos.idBase){
                            if(productos.fechaf < fecha){
                                precio =  productos.precio;
                            };
                            if(productos.fechaf >= fecha){
                                precio =  productos.precioe;
                            };
                            
                            
                            cantidad = lista.cantidad;
                            total = total + precio * cantidad;
                        };
                    });
                });

                document.getElementById("totalpo").innerHTML = "Total: " + total;

            },
            verUbicacion(item){

                

                this.ubicacion.lat = parseFloat(item.latitude);
                this.ubicacion.lng = parseFloat(item.longitude);
                this.activeComercio = item;
                this.infoWindowOpened = true;

                window.scroll(0, 0);



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
                let gps = 0;
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
                   
                    this.basicos = databa.result.map(base=>{
                        return {
                            id : base.idBase,
                            label : base.nombre,
                            precio : base.precio,
                        }
                    });
                    console.log(this.comercios);

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
                alertify.alert(`El filtro de ubicación accede a tu ubicación actual siempre y cuando hayas dado el permiso requerido.`).setHeader('<img  src="image/logo2.png" width="100" height="30">');
            },
            indifiltros(){
                document.oncontextmenu = function(){return false;};
                alertify.alert(`Con el uso de los filtros puedes especificar el salario y tipo de comercio que deseas buscar. además de crear la lista de productos que necesites. también puedes solamente ver los comercios disponibles que se encuentran en la aplicación y usar los filtros de navegación para guiarte. Empiezas la búsqueda al oprimir el botón ‘Filtrar’`).setHeader('<img  src="image/logo2.png" width="100" height="30">'); 
            },
            indiCom(){
                document.oncontextmenu = function(){return false;};
                alertify.alert(`En este apartado veras los comercios que coinciden con tus criterios de búsqueda. Al hacer clic en "Ver Productos" en un comercio de la tabla veras el listado de productos y el precio orientado a tus valores de búsqueda`).setHeader('<img  src="image/logo2.png" width="100" height="30">'); 
            },

            alert(){
                alertify.alert('Bienvenido a EASYPRICE. Si tienes dudas sobre el uso de la aplicacion haz click derecho sobre los elementos en pantalla para recibir indicaciones').setHeader('<img  src="image/logo2.png" width="100" height="30">');
            },
            abrirForma(){
                this.form['mapa'].mostrar = false;
                this.form['inicio'].mostrar = true;
            
                
                //alertify.alert('Bienvenido a la pestaña del mapa. Si tienes dudas sobre el uso de la aplicacion haz click derecho sobre los elementos en pantalla para recibir indicaciones').setHeader('<img  src="image/logo2.png" width="100" height="30">');
            },
            abrirAyuda(){
                this.form['mapa'].mostrar = false;
                this.form['favoritos'].mostrar = true;
            
                
                //alertify.alert('Bienvenido a la pestaña del mapa. Si tienes dudas sobre el uso de la aplicacion haz click derecho sobre los elementos en pantalla para recibir indicaciones').setHeader('<img  src="image/logo2.png" width="100" height="30">');
            },
           
        },
        created(){
            //this.obtenerDatos();
            
            
        },
    }

</script>
