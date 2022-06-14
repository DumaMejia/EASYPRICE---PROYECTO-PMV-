<template>
    <div class="container">
        <h2 class="text-center">Chat de usuarios<hr></h2>
        <form v-on:submit.prevent="guardarChat">
            <div class="card">
                <div class="card-header text-white bg-warning">
                    <div class="row">
                        <div class="col-1">
                            <img width="20" height="20" :src="imgchat" alt="Imagen de chat" title="chat de usuarios">
                        </div>
                        <div class="col-10">Chat de usuarios</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <ul id="ltsMensajes">
                                <li v-for="msg in chats" :key="msg._id">
                                    {{ msg.from }} : {{ msg.msg }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-10">
                            <input @keyup.enter="guardarChat" v-model="chat.msg" type="text" class="form-control" required placeholder="Escribe tu mensaje aqui...">
                        </div>
                        <div class="col-2">
                            <a @click="guardarChat">
                                <img width="40" height="40" :src="imgenviar" alt="Imagen de envio" title="Enviar mensaje">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    export default{
        props: ['form'],
        data(){
            return {
                imgchat: "image/chat.png",
                imgenviar: "image/enviar.jpg",
                chats: [],
                chat:{
                    id:'',
                    from: document.querySelector("#navbarDropdown").innerText,
                    to:'todos',
                    msg:'',
                    status:'pendiente',
                    fecha: new Date().toLocaleString('es-ES', {timeZone: 'America/El_Salvador'})
                }
            }
        },
        methods:{
            cerrarForm(){
                this.form['chat'].mostrar = false;
            },
            limpiar(){
                this.chat.msg = '';
            },
            mostrarDatos(chat){
                this.chats.push(chat);
            },
            obtenerDatos(){
                
                sockectio.emit('historial');//enviar un evento
                sockectio.on('historial',chats=>{ //escuchar un evento. //historial
                    this.chats = chats;
                    
                });
            },
            guardarChat(){
                this.chat.id = generarIdUnicoFecha();
                if( this.chat.msg!='' ){
                    sockectio.emit('chat', this.chat);
                    this.limpiar();
                if( permitirNotificaciones=='granted' ){
                    let notificacion;
                     notificacion = new Notification('Chat de usuario', {
                    body : 'Acabas de mandar un mensaje',
                });
            }
                    
                } else{
                    console.log('Mensaje vacio');
                }
            },
            abrirForm(){
                this.form['chat'].mostrar = true;
            },
        },
        created(){
            this.abrirForm();
            this.obtenerDatos();

            sockectio.on('chat', chat=>{
                this.mostrarDatos(chat);

            });
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
            }
        }
    }
</script>
<style>

</style>
