<script src="{{ asset('js/app.js') }}"></script>
<template>

    <div id="appBasico">
        <div class="container col-xxl-8 px-4 py-5">
<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
<div class="col-10 col-sm-8 col-lg-6">
<img src="image/promo.png" alt="Bootstrap Themes"  width="600" height="350" >
</div>
<div class="col-lg-6">
<h1 class="display-5 fw-bold lh-1 mb-3">Una alternativa para buscar los mejores precios</h1>
<p class="lead">Con el uso de EasyPrice haras del buscar los mejores precios a los productos que buscas la tarea mas facil y sencilla posible por que no solo contamos con los principales comerciales a nivel nacional si no tambien con esos pequeños y medianos comerciantes los cuales nos brindan sus productos y precios los cuales puedes consultar mediante el uso de la aplicacion. ¡Que estas esperando, empieza a buscar ya! </p>
<div class="d-grid gap-2 d-md-flex justify-content-md-start">

<button type="button" @click="abrirMapa()" class="btn btn-primary btn-lg px-4 me-md-2">Mapa</button>
<button type="button" @click="abrirForma()" class="btn btn-outline-secondary btn-lg px-4">¿Necesitas ayuda?</button>
</div>
</div>
</div>
</div>


        
            
    
       
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
            <a href="#!" class="text-reset">Inicio</a>
          </p>
          <p>
            <a href="#!" @click="abrirMapa()" class="text-reset">Mapa</a>
          </p>
          <p>
            <a href="http://127.0.0.1:8000/NewPassword" class="text-reset">Mi Cuenta</a>
          </p>
          <p>
            <a href="#!" @click="abrirForma()" class="text-reset">Ayuda</a>
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
            abrirForma(){
                this.form['inicio'].mostrar = false;
                this.form['favoritos'].mostrar = true;
            
                
                //alertify.alert('Bienvenido a la pestaña del mapa. Si tienes dudas sobre el uso de la aplicacion haz click derecho sobre los elementos en pantalla para recibir indicaciones').setHeader('<img  src="image/logo2.png" width="100" height="30">');
            },
            abrirMapa(){
                this.form['inicio'].mostrar = false;
                this.form['mapa'].mostrar = true;
            
                
                //alertify.alert('Bienvenido a la pestaña del mapa. Si tienes dudas sobre el uso de la aplicacion haz click derecho sobre los elementos en pantalla para recibir indicaciones').setHeader('<img  src="image/logo2.png" width="100" height="30">');
            },
            
        },
        created(){
            //this.obtenerDatosComercio();
            if(localStorage.getItem('token')== 1){
              this.form['favoritos'].mostrar = true;
              let token = 0;
              localStorage.setItem('token', token);
            }else{
              this.form['inicio'].mostrar = true;
            };
            
            //this.form['mapa'].mostrar = false;
        },
    }
</script>

