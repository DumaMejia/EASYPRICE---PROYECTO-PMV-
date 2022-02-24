
var db_sistema = openDatabase('db:USIS007420', '1.0', 'Sistema Libros', 5 * 1024 * 1024);
if(!db_sistema){
    alert('Lo siento tu navegado NO soporta BD locales.');
}
Vue.component('v-select-autores',VueSelect.VueSelect);
var app = new Vue({
    
    el: '#appautor',
    data: {
        autores: [],
        buscar: '',
        msg: 'Sistema Activo',
        autor: {
            accion: 'nuevo',
            idAutor: '',
            codigo: '',
            nombre: '',
            pais: '',
            telefono: '',
        },
        libros: [],
        buscar1: '',
        msg1:'Sistema Activo',
         libro: {
            idLibro:'',
            idAutor1:'',
            autores1: {
                id: '',
                label: '',
            },
            isbn:'',
            titulo:'',
            editorial:'',
            edicion:''
        },
    },

    methods: {
        buscarautor(){
           
            this.obtenerautor(this.buscar);
        },
        guardarautor(){
            let sql = '',
                parametros = [];
            if(this.autor.accion == 'nuevo'){
                sql = 'INSERT INTO autor (codigo, nombre, pais, telefono) VALUES (?,?,?,?)';
                parametros = [this.autor.codigo,this.autor.nombre,this.autor.pais,this.autor.telefono];
            }else if(this.autor.accion == 'modificar'){
                sql = 'UPDATE autor SET codigo=?, nombre=?, pais=?, telefono=? WHERE idAutor=?';
                parametros = [this.autor.codigo,this.autor.nombre,this.autor.pais,this.autor.telefono,this.autor.idAutor];
            }else if(this.autor.accion == 'eliminar'){
                sql = 'DELETE FROM autor WHERE idAutor=?';
                parametros = [this.autor.idAutor];
            }
            db_sistema.transaction(tx=>{
                tx.executeSql(sql,
                    parametros,

                (tx, results)=>{
                    this.msg = 'autor Registrado Con Exito';
                    this.nuevoautor();
                    this.obtenerautor();
                },
                (tx, error)=>{
                    switch(error.code){
                        case 6:
                            this.msg = 'El codigo o el Nombre ya existe, por favor digite otro';
                            break;
                            
                        default:
                            this.msg = `Error al procesar el autor: ${error.message}`;
                    }
                });
            });
        },
        modificarautor(data){
            this.autor = data;
            this.autor.accion = 'modificar';
        },
        eliminarautor(data){
            if( confirm(`¿Esta seguro de eliminar el autor ${data.nombre}?`) ){
                this.autor.idAutor = data.idAutor;
                this.autor.accion = 'eliminar';
                this.guardarautor();
            }
        },
        obtenerautor(busqueda=''){
            db_sistema.transaction(tx=>{
                tx.executeSql(`SELECT * FROM autor WHERE nombre like "%${busqueda}%" OR codigo like "%${busqueda}%"`, [], (tx, results)=>{
                    this.autores = results.rows;
                  
                });
            });
        },
        nuevoautor(){
            this.autor.accion = 'nuevo';
            this.autor.idautor = '';
            this.autor.codigo = '';
            this.autor.nombre = '';
            this.autor.pais = '';
            this.autor.telefono = '';
            console.log(this.autor);
        },

        //Administrar inscripcin autores

        buscarIncripcion(){
           
            this.obtenerIncripcion(this.buscar1);
        },
        guardarInscripcion(){
            if(this.libro.nombre1=='' || this.libro.codigo1==''){
                this.msg1 = 'Seleccione autor para inscribir libros';
            }else{
                let sql = '',
                parametros = [];
            if(this.autor.accion == 'nuevo'){
                sql = 'INSERT INTO libros (idAutor, isbn, titulo, editorial, edicion) VALUES (?,?,?,?,?)';
                parametros = [this.libro.idAutor1,this.libro.isbn,this.libro.titulo,this.libro.editorial,this.libro.edicion];
            }else if(this.autor.accion == 'modificar'){
                sql = 'UPDATE libros SET idAutor=?, isbn=?, titulo=?, editorial=?, edicion=? WHERE idLibro=?';
                parametros = [this.libro.idAutor1,this.libro.isbn,this.libro.titulo,this.libro.editorial,this.libro.edicion,this.libro.idLibro];
            }else if(this.autor.accion == 'eliminar'){
                sql = 'DELETE FROM libros WHERE idLibro=?';
                parametros = [this.libro.idLibro];
            }
            db_sistema.transaction(tx=>{
                tx.executeSql(sql,
                    parametros,

                (tx, results)=>{
                    this.msg1 = 'autor procesado con exito';
                    this.nuevoInscripcion();
                    this.obtenerIncripcion();
                },
                (tx, error)=>{
                   
                            this.libro.msg1 = `Error al procesar al autor: ${error.message}`;
                    
                });
            });
            }
            
        },
        modificarIncripcion(data){
            this.libro.idLibro = data.idLibro;
            this.libro.idAutor1 = data.idAutor1;
            this.libro.isbn = data.isbn;
            this.libro.titulo = data.titulo;
            this.libro.editorial = data.editorial;
            this.libro.edicion = data.edicion;
            this.autor.accion = 'modificar';
        },
        Inscripcion(data){
            this.libro.nombre1 = data.nombre;
            this.libro.codigo1= data.codigo;
           
        },
        eliminarIncripcion(data){
            if( confirm(`¿Esta seguro de eliminar el registro de ${data.titulo}?`) ){
                this.libro.idLibro = data.idLibro;
                this.autor.accion = 'eliminar';
                this.guardarInscripcion();
            }
        },
        obtenerIncripcion(busqueda=''){
            db_sistema.transaction(tx=>{
                tx.executeSql(`SELECT * FROM libros WHERE titulo like "%${busqueda}%" OR editorial like "%${busqueda}%"`, [], (tx, results)=>{
                    this.libros = results.rows;
                });
            });

           
        },
        nuevoInscripcion(){
            this.autor.accion = 'nuevo';
            this.libro.idLibro = '';
            this.libro.isbn = '';
            this.libro.titulo = '';
            this.libro.editorial = '';
            this.libro.edicion = '';
            console.log(this.libro);
        }

    },
    created(){
        db_sistema.transaction(tx=>{
            tx.executeSql('CREATE TABLE IF NOT EXISTS autor(idAutor INTEGER PRIMARY KEY AUTOINCREMENT, '+
                'codigo char(10) unique, nombre char(75), pais TEXT, telefono char(10))');
                
            tx.executeSql('CREATE TABLE IF NOT EXISTS libros(idLibro INTEGER PRIMARY KEY AUTOINCREMENT, '+
                'idAutor TEXT, isbn TEXT, titulo TEXT, editorial TEXT, edicion TEXT)');
        }, err=>{
            console.log('Error al crear la tabla de clientes', err);
        });
        this.obtenerautor();
        this.obtenerIncripcion()
    }
});