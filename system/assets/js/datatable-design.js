
let string  = document.getElementById("name-table").src.match(/\w+=\w+/g);
let _GET    = {};
let t       = string.length;
let ii      = string.length;
while (ii--) {
    //t[0] nombre del parametro y t[1] su valor
    t = string[ii].split("=");
    //opción 1: a modo de PHP
    _GET[t[0]] = t[1];
   //opción2: variables con el mismo nombre usando eval
   eval('var '+t[0]+'="'+t[1]+'";');
}

let displayData = _GET['name'];
console.log(_GET['name']);

let loadDataTable = (displayData) => {
    setTimeout(() => {
        $("#list-table-"+displayData).dataTable().fnDestroy();
        let table = $('#list-table-rooms').DataTable({
            "columnDefs": [{
            "orderable": false,
            "targets": [5]
            }],
            language: {
              "decimal": "",
              "emptyTable": "No hay información",
              "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
              "infoFiltered": "(Filtrado de _MAX_ total registros)",
              "infoPostFix": "",
              "thousands": ",",
              "lengthMenu": "Mostrar _MENU_ registros",
              "loadingRecords": "Cargando...",
              "processing": "Procesando...",
              "search": "",
              "searchPlaceholder": "Buscar",
              "zeroRecords": "Sin resultados encontrados",
              "paginate": {
                  "first": "Primero",
                  "last": "Ultimo",
                  "next": "Siguiente",
                  "previous": "Anterior"
              }
            },
            //fixedHeader: true,
            order: [0, 'desc'],
            dom: "<'row'<'col-sm-12 col-md-6'f>" +
            "<'col-sm-12 col-md-6'<'row m-0 float-right'<'col-md-auto'l>>>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            lengthMenu: [20, 30, 50, 100, 500],
            processing: "Procesando...",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "search": "Buscar:",
            "infoThousands": ",",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        });
    }, 100);
};