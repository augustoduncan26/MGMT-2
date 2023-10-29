let loadDataTable = (table_name,setting) => {
    /**
     * @var setting
     * setting['ordering'] Set column order default
     * setting['totalpages'] Set total pages to show
     * setting['notorder'] Set column not to order
     * setting['orderingFormat'] Set ordering format: asc or desc
     */
    if (setting['orderingFormat']=='') {
        setting['orderingFormat'] = 'desc';
    }
    setTimeout(() => {
        $("#"+table_name).dataTable().fnDestroy();
        $("#"+table_name).DataTable({
            // columnDefs: [
            //     { width: "2%", targets: 0 }
            // ],
            // fixedColumns: true,
            "columnDefs": [{
            "orderable": false,
            "targets": setting['notorder']
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
            order: [setting['ordering'], setting['orderingFormat']],
            dom: "<'row'<'col-sm-12 col-md-6'f>" +
            "<'col-sm-12 col-md-6'<'row m-0 float-right'<'col-md-auto'l>>>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            lengthMenu: setting['totalpages'],
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
    });
    }