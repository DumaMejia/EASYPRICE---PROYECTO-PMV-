<template>



 <div>


    <div class="container m-3">
        
    
    <form align="center">
    <div class="btn-group">
  <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
    Selecciona un departamento
  </button>
  <ul class="dropdown-menu dropdown-menu-lg-end">
    <li id="ahuachapan"><button class="dropdown-item"  type="button">Ahuachapan</button></li>
    <li><button class="dropdown-item" type="button">Cabañas</button></li>
    <li><button class="dropdown-item" type="button">Usulutan</button></li>
  </ul>
</div>



<div class="btn-group">
  <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
    Selecciona un municipio
  </button>
  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
    <li><button class="dropdown-item" type="button">Usulutan</button></li>
    <li><button class="dropdown-item" type="button">Santa Maria</button></li>
    <li><button class="dropdown-item" type="button">Ozatlan</button></li>
  </ul>
</div>
    </form>

    

    </div>
        

        <div>

        <div class="container m-3 ">
                
                   <GmapMap
                    :center="ubicacion"
                    :zoom="14"

                    map-type-id="roadmap"
                    style="width: 1200px; height: 400px; margin: 32px auto"
                    >
                    <GmapMarker
                       :position="{lat:13.341835133794397, lng:-88.4186510089188}"
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

</template>

<script>
  export default {
        props : ['form'],
         data:()=>{
            return {
                ubicacion:{
                    lat : '13.341835133794397',
                    lng : '-88.4186510089188',
                }
            }
        },
        methods:{

            mapCenter(){

                return{

                    lat: 13.341835133794397,
                    lng: -88.4186510089188
                }
            },

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
                    }
                    this.comercio.msg = `Comercio procesado ${data.msg}`;
                })
                .catch(err=>{
                    this.comercio.msg = `Error al procesar el comercio ${err}`;
                })
            },
            insertarLocal(comercio){
                let store = this.abrirStore('comercio', 'readwrite'),
                    query = store.put(comercio);
                query.onsuccess = e=>{
                    this.nuevoComercio();
                    this.obtenerDatos();
                    this.comercio.msg = 'Comercio procesado con exito';
                };
                query.onerror = e=>{
                    this.comercio.msg = `Error al procesar el comercio ${e.target.error}`;
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
                        this.comercio.msg = 'Comercio eliminado con exito';
                    };
                    query.onerror = e=>{
                        this.comercio.msg = `Error al eliminar el comercio ${e.target.error}`;
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
                                this.comercio.msg = `Error al guardar el comercio ${err}`;
                            });
                    }
                    this.comercios = data.result.filter(comercio=>comercio.nombre.toLowerCase().indexOf(valor.toLowerCase())>-1 || comercio.tipo.toLowerCase().indexOf(valor.toLowerCase())>-1 || comercio.codigo.toLowerCase().indexOf(valor.toLowerCase())>-1);
                    
                };
                data.onerror = e=>{
                    this.comercio.msg = `Error al obtener los comercios ${e.target.error}`;
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
            }
        },
        created(){
            //this.obtenerDatos();
        },
    }
    
</script>
