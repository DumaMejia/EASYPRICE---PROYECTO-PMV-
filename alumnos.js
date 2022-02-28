
Vue.component('v-select-categoria',VueSelect.VueSelect);
Vue.component('Alumnos',{
    data:()=> {
        return{
        alumnos: [],
        buscar: '',
        msg: 'Sistema Activo',
        alumno: {
            accion: 'nuevo',
            idAlumno: '',
            codigo: '',
            nombre: '',
            direccion: '',
            telefono: '',
            dui: '',
            carrera: '',
        },
        }
    },
    
    //Roger Alberto Chávez Zelaya USIS015320

//Duma Roberto Zelaya Mejía USIS007420

//Roberto Carlos Hernández Meléndez USIS016520

//José Roberto del Rio Maravilla USIS015220

//Flor Mabel Ariza Rodríguez USIS011120
    methods: {
        buscarAlumno(){
           
            this.obtenerAlumno(this.buscar);
        },
        guardarAlumno(){
            this.obtenerAlumno();
            let alumnos = JSON.parse(localStorage.getItem('alumnos')) || [];
            if(this.alumno.accion=="nuevo"){
                this.alumno.idAlumno = generarIdUnicoFecha();
                alumnos.push(this.alumno);
            } else if(this.alumno.accion=="modificar"){
                let index = alumnos.findIndex(alumno=>alumno.idAlumno==this.alumno.idAlumno);
                alumnos[index] = this.alumno;
            } else if( this.alumno.accion=="eliminar" ){
                let index = alumnos.findIndex(alumno=>alumno.idAlumno==this.alumno.idAlumno);
                alumnos.splice(index,1);
            }
            localStorage.setItem('alumnos', JSON.stringify(alumnos));
            this.nuevoAlumno();
            this.obtenerAlumno();
            this.msg = 'Alumno procesado con exito';
        },
        modificarAlumno(datos){
            this.alumno = JSON.parse(JSON.stringify(datos));
            this.alumno.accion = 'modificar';
        },
        eliminarAlumno(data){
            if( confirm(`¿Esta seguro de eliminar el alumno ${data.nombre}?`) ){
                this.alumno.idAlumno = data.idAlumno;
                this.alumno.accion = 'eliminar';
                this.guardarAlumno();
            }
        },
        obtenerAlumno(busqueda=''){
            this.alumnos = [];
            let alumnos = JSON.parse(localStorage.getItem('alumnos')) || [];
            this.alumnos = alumnos.filter(alumno=>alumno.nombre.toLowerCase().indexOf(busqueda.toLowerCase())>-1);
        },
        nuevoAlumno(){
            this.alumno.accion = 'nuevo';
            this.alumno.idAlumno = '';
            this.alumno.codigo = '';
            this.alumno.nombre = '';
            this.alumno.direccion = '';
            this.alumno.telefono = '';
            this.alumno.dui = '';
            this.alumno.carrera ='Seleccionar Carrera';
            console.log(this.alumno);
        },

    
    },
    created(){
        this.obtenerAlumno();
    },
    template:`
    <div id="appAlumno">
        <div class="container-fluid">
            <form @submit.prevent="guardarAlumno" @reset.prevent="nuevoAlumno" method="post" id="frmAlumno">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header text-white bg-dark">
                        Administracion de Alumnos


                    </div>
                    <div class="card-body">
                        <div class="row p-1">
                            <div class="col col-md-1">Codigo</div>
                            <div class="col col-md-2">
                                <input v-model="alumno.codigo" placeholder="codigo" pattern="[A-Z0-9]{3,10}" required title="Codigo de cliente" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-1">Nombre</div>
                            <div class="col col-md-2">
                                <input v-model="alumno.nombre"  placeholder="escribe tu nombre" pattern="[A-Za-zÑñáéíóú ]{3,75}" required title="Nombre de cliente" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-1">Direccion</div>
                            <div class="col col-md-2">
                                <input v-model="alumno.direccion" placeholder="donde vives" pattern="[A-Za-z0-9Ññáéíóú ]{3,100}" required title="Direccion de cliente" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-1">Telefono</div>
                            <div class="col col-md-2">
                                <input v-model="alumno.telefono" placeholder="tu tel" pattern="[0-9]{4}-[0-9]{4}" required title="Telefono de cliente" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-1">DUI</div>
                            <div class="col col-md-2">
                                <input v-model="alumno.dui" placeholder="tu DUI" pattern="[0-9]{8}-[0-9]{1}" required title="DUI de cliente" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-1">Carrera</div>
                            <div class="col col-md-2">
                                <select v-model="alumno.carrera" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option  selected>Seleccionar Carrera</option>
                                    <option value="Ingenieria En Sistemas y Redes Informaticas">Ingenieria En Sistemas</option>
                                    <option value="Medicina">Medicina</option>
                                    <option value="Artes Plasticas">Artes Plasticas</option>
                                  </select>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col col-md-3 text-center">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ msg }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-3 text-center">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="reset" class="btn btn-warning">Nuevo</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card mb-3" id="cardBuscarCliente">
                <div class="card-header text-white bg-dark">
                    Busqueda de Alumnos

                </div>
                <div class="card text-white bg-dark mb-3">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <td colspan="6">
                                    Buscar: <input title="Introduzca el texto a buscar" @keyup="buscarAlumno" v-model="buscar" class="form-control" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Direccion</th>
                                <th>Telefono</th>
                                <th>DUI</th>
                                <th>Carrera</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in alumnos" :key="item.idAlumno">
                                <td>{{item.codigo}}</td>
                                <td>{{item.nombre}}</td>
                                <td>{{item.direccion}}</td>
                                <td>{{item.telefono}}</td>
                                <td>{{item.dui}}</td>
                                <td>{{item.carrera}}</td>
                                <td>
                                    <button type="button" class="btn btn-danger" @click="eliminarAlumno(item)">Eliminar</button>
                                    <button type="button" class="btn btn-success" @click="modificarAlumno(item)">Modificar</button>
                                    <button type="button" class="btn btn-info" @click="Inscripcion(item)">Incribir Materias</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
       
    `
});