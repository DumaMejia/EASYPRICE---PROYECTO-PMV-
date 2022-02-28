Vue.component('v-select-alumnos',VueSelect.VueSelect);
Vue.component('inscripcion',{
    data:()=> {
        return{
        materias: [],
        alumnos: [],
        buscar1: '',
        msg1:'Sistema Activo',
         materia: {
            accion: 'nuevo',
            idincripcion:'',
            alumno: {
                id: '',
                label: '',
            },
            codigo1:'',
            nombre1:'',
            materia1:'',
            materia2:'',
            materia3:'',
            materia4:'',
            materia5:''
            },
        }
    },
    
    //Roger Alberto Chávez Zelaya USIS015320

//Duma Roberto Zelaya Mejía USIS007420

//Roberto Carlos Hernández Meléndez USIS016520

//José Roberto del Rio Maravilla USIS015220

//Flor Mabel Ariza Rodríguez USIS011120
    methods: {

        //Administrar inscripcin alumnos

        buscarIncripcion(){
           
            this.obtenerIncripcion(this.buscar1);
        },
        guardarInscripcion(){
            this.obtenerIncripcion();
            let materias = JSON.parse(localStorage.getItem('materias')) || [];
            if(this.materia.accion=="nuevo"){
                this.materia.idincripcion = generarIdUnicoFecha();
                materias.push(this.materia);
            } else if(this.materia.accion=="modificar"){
                let index = materias.findIndex(materia=>materia.idincripcion==this.materia.idincripcion);
                materias[index] = this.materia;
            } else if( this.materia.accion=="eliminar" ){
                let index = materias.findIndex(materia=>materia.idincripcion==this.materia.idincripcion);
                materias.splice(index,1);
            }
            localStorage.setItem('materias', JSON.stringify(materias));
            this.nuevoInscripcion();
            this.obtenerIncripcion();
            this.msg = 'inscripcion procesado con exito';
            
        },
        modificarIncripcion(data){
            this.materia.idincripcion = data.idincripcion;
            this.materia.alumno = data.alumno;
            this.materia.materia1 = data.materia1;
            this.materia.materia2 = data.materia2;
            this.materia.materia3 = data.materia3;
            this.materia.materia4 = data.materia4;
            this.materia.materia5 = data.materia5;
            this.materia.accion = 'modificar';
        },
        Inscripcion(data){
            this.materia.nombre1 = data.nombre;
            this.materia.codigo1= data.codigo;
           
        },
        eliminarIncripcion(data){
            if( confirm(`¿Esta seguro de eliminar el registro de ${data.nombre1}?`) ){
                this.materia.idincripcion = data.idincripcion;
                this.materia.nombre1 = data.nombre1;
                this.materia.codigo1 = data.codigo1;
                this.materia.accion = 'eliminar';
                this.guardarInscripcion();
            }
        },
        obtenerIncripcion(busqueda=''){

            this.materias = [];
            let materias = JSON.parse(localStorage.getItem('materias')) || [];
            this.materias = materias.filter(materia=>materia.alumno.label.toLowerCase().indexOf(busqueda.toLowerCase())>-1);


            this.alumnos = [];
            let alumnos = JSON.parse(localStorage.getItem('alumnos')) || [];
            this.alumnos = alumnos.map(alumno=>{
                return {
                    id: alumno.idAlumno,
                    label: alumno.nombre,
                }
            });
        },
        nuevoInscripcion(){
            this.materia.accion = 'nuevo';
            this.materia.idincripcion = '';
            this.materia.materia1 = 'ninguna';
            this.materia.materia2 = 'ninguna';
            this.materia.materia3 = 'ninguna';
            this.materia.materia4 ='ninguna';
            this.materia.materia5 ='ninguna';
            console.log(this.materia);
        }

    },
    created(){
        this.obtenerIncripcion()
    },
    template:`
    <div id="appAlumno">
        <div class="container-fluid">
        <form @submit.prevent="guardarInscripcion" @reset.prevent="nuevoInscripcion" method="post" id="frmMaterias">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header text-white bg-dark">
                        Administracion de Materias

                    </div>
                    <div class="card-body">
                        <div class="row p-3">
                            <div class="col col-md-1">Nombre</div>
                            <div class="col col-md-2">
                            <v-select-alumnos v-model="materia.alumno" 
                            :options="alumnos" placeholder="Seleccione una categoria"/>
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-1">Materia 1</div>
                            <div class="col col-md-2">
                                <select v-model="materia.materia1" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option selected> Ninguna</option>
                                    <option value="Metodologia de la investigacion">Metodologia de la investigacion/option>
                                    <option value="Sociologia">Sociologia</option>
                                  </select>
                            </div> 
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-1">Materia 2</div>
                            <div class="col col-md-2">
                                <select v-model="materia.materia2" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option  selected>Ninguna</option>
                                    <option value="Ingles Basico">Ingles Basico</option>
                                    <option value="Ingles Tecnico">Ingles Tecnico</option>
                                  </select>
                            </div> 
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-1">Materia 3</div>
                            <div class="col col-md-2">
                                <select v-model="materia.materia3" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option  selected>Ninguna</option>
                                    <option value="Curso Superior de Gramatica">Curso Superior de Gramatica</option>
                                    <option value="Matematica I">Matematica I</option>
                                  </select>
                            </div> 
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-1">Materia 4</div>
                            <div class="col col-md-2">
                                <select v-model="materia.materia4" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option  selected>Ninguna</option>
                                    <option value="Matematica II">Matematica II</option>
                                    <option value="Fisica I">Fisica I</option>
                                  </select>
                            </div> 
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-1">Materia 5</div>
                            <div class="col col-md-2">
                                <select v-model="materia.materia5" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option  selected>Ninguna</option>
                                    <option value="Filosofia">Filosofia</option>
                                    <option value="Sociedad e Historia">Sociedad e Historia</option>
                                  </select>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col col-md-3 text-center">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ msg1 }}
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
    
    <div class="card text-white bg-dark mb-3" id="cardBuscarCliente">
        <div class="card-header text-white bg-dark">
            Busqueda de Inscripcion de Materias

        </div>
        <div class="card-body">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <td colspan="6">
                            Buscar: <input title="Introduzca el texto a buscar" @keyup="buscarIncripcion" v-model="buscar1" class="form-control" type="text">
                        </td>
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        <th>Materia 1</th>
                        <th>Materia 2</th>
                        <th>Materia 3</th>
                        <th>Materia 4</th>
                        <th>Materia 5</th>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in materias" :key="item.idincripcion">
                        <td>{{item.alumno.label}}</td>
                        <td>{{item.materia1}}</td>
                        <td>{{item.materia2}}</td>
                        <td>{{item.materia3}}</td>
                        <td>{{item.materia4}}</td>
                        <td>{{item.materia5}}</td>
                        <td>
                            <button type="button" class="btn btn-danger" @click="eliminarIncripcion(item)">Eliminar</button>
                            <button type="button" class="btn btn-success" @click="modificarIncripcion(item)">Modificar</button>
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