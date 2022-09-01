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
            <select @click="mapCenter" v-model="depmun.valor"  aria-label="Default select example" class="form-select btn-warning" >
                    Departamentos
                    <option selected>Seleciona un departamento</option>
                    <option class="btn btn-light" value="ahuachapan">Ahuachapan</option>
                    <option class="btn btn-light" value="san salvador">San Salvador</option>
                    <option class="btn btn-light" value="usulutan">Usulutan</option>
            </select>
         </div>

         <div class="btn-group">
            <button type="button" class="btn btn-outline-info" @click="mapCentergps">
               
                <i class="fa fa-google mr-2"></i>
                 <img  src="image/gps2.png" width="20" height="20">
                  
                </button>
        </div>

       <div class="btn-group">
            <select @click="mapCenter" v-model="depmun.valor" class="form-select  btn-warning" aria-label="Default select example">
                    <option class="btn btn-light" selected>Selecciona un municipio</option>
                    <option class="btn btn-light" value="santa maria">Santa Maria</option>
                    <option class="btn btn-light" value="santa elena">Santa Elena</option>
                    <option class="btn btn-light" value="alegria">Alegria</option>
            </select>
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
            },
           
        },
        created(){
            //this.obtenerDatos();
           
            
            
        },
    }

</script>
