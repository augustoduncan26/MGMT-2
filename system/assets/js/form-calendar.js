var Calendar = function () {

    //function to initiate Full CAlendar
    var runCalendar = function () {
        var $modal = $('#event-management');
        $('#event-categories div.event-category').each(function () {
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 50 //  original position after the drag
            });
        });
        /* initialize the calendar
                 -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var form = '';
        var calendar = $('#calendar').fullCalendar({
            buttonText: {
                prev: '<i class="fa fa-chevron-left"></i>',
                next: '<i class="fa fa-chevron-right"></i>'
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: [],
            // events: [{
            //     title: 'Meeting with Bosssss',
            //     start: new Date(y, m, 1),
            //     className: 'label-default'
            // }, {
            //     title: 'Bootstrap Semina',
            //     start: new Date(y, m, d - 5),
            //     end: new Date(y, m, d - 2),
            //     className: 'label-teal'
            // }, {
            //     title: 'Lunch with Nicolesa',
            //     start: new Date(y, m, d - 3, 12, 0),
            //     className: 'label-green',
            //     allDay: false
            // }],
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped
                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                var $categoryClass = $(this).attr('data-class');
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);
                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                if ($categoryClass)
                    copiedEventObject['className'] = [$categoryClass];
                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                $modal.modal({
                    backdrop: 'static'
                });

                    today = new Date();

                    var date_today    =   JSON.stringify(today);
                    var date_today    =   date_today.split('T');
                    var date_today    =   date_today[0].split('"');
                    
                    //var date_today2    =   date_today.split(',');
                    //alert(date_today2)

                    var data_start    =   start;
                    var data_end      =   end;

                    // Start Date
                    var data_start    =   JSON.stringify(data_start);
                    var data_start    =   data_start.split('T');
                    var data_start    =   data_start[0].split('"');

                    // End Date
                    var data_end      =   JSON.stringify(data_end);
                    var data_end      =   data_end.split('T');
                    var data_end      =   data_end[0].split('"');

                    var fechaini      =  data_start[1] ;
                    var fechafin      =  data_end[1] ;
                    var fechadesalida =  false;

                    if (fechaini == fechafin) { fechadesalida = fechaini;  } else { fechadesalida = fechafin} 

                // Name of client
                form = $("<form></form>");
                form.append("<div class='row'></div>");

                form.find(".row").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Seleccionar</label><select class='form-control' name='category' id='category'></select></div></div>").find("select[name='category']").append("<option value='E' onClick='document.getElementById(\"row_reservation\").style.display = \"none\"; document.getElementById(\"inputname_para_eventos\").style.display=\"block\";document.getElementById(\"inputname_para_reservas\").style.display=\"none\"'>Eventos</option>").append("<option value='R' selected onClick='document.getElementById(\"row_reservation\").style.display = \"block\";document.getElementById(\"inputname_para_eventos\").style.display=\"none\";document.getElementById(\"inputname_para_reservas\").style.display=\"block\"'>Reservación</option>");//.append("<option value='label-purple'>Holidays</option>").append("<option value='label-orange'>Party</option>").append("<option value='label-yellow'>Birthday</option>").append("<option value='label-teal'>Generic</option>").append("<option value='label-beige'>To Do</option>");
                
                // Select rooms
                form.find(".row").append("<div class='col-md-6' id='inputname_para_reservas'><div class='form-group'><label class='control-label'>Habitaciones</label><select class='form-control'><option value=''>Habitación-1</option></select></div></div>")
                // Input even name
                form.find(".row").append("<div class='col-md-6' id='inputname_para_eventos' style='display:none'><div class='form-group'><label class='control-label'>Nombre</label><input class='form-control' placeholder='Inserte un Nombre' type=text name='title'/></div></div>");
                //form.find(".row").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Nombre</label><input class='form-control' placeholder='Inserte un Nombre' type=text name='title'/></div></div>").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Seleccionar</label><select class='form-control' name='category'></select></div></div>").find("select[name='category']").append("<option value='label-default' onClick='document.getElementById(\"row_reservation\").style.display = \"none\"'>Eventos</option>").append("<option value='label-green' onClick='document.getElementById(\"row_reservation\").style.display = \"block\"'>Reservación</option>");//.append("<option value='label-purple'>Holidays</option>").append("<option value='label-orange'>Party</option>").append("<option value='label-yellow'>Birthday</option>").append("<option value='label-teal'>Generic</option>").append("<option value='label-beige'>To Do</option>");
                
                // Valore en campos fecha_llegada y fecha_salida
                form.append("<div><class='row' id='row_reservation' style='display:block'></div>");
                form.find("#row_reservation").append('<div class="col-md-6 form-group"><label>Fecha de Llegada</label><div><input type="text" name="fecha_llegada" id="fecha_llegada" class="form-control" value="'+ fechaini +'"></div></div><div class="col-md-6 form-group"><label>Fecha de Salida</label><div><input type="text" name="fecha_salida" id="fecha_salida" class="form-control" value="'+ fechadesalida +'"></div></div><div class="col-md-6 form-group"><label>Habitación</label><div><input type="text" name="" id="" class="form-control"></div></div><div class="col-md-6 form-group"><label>Total de Personas</label><div><input type="text" name="" id="" class="form-control"></div></div>');
                
                $modal.find('.remove-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                form.submit();
   

                   // Insert / Save
                    var txtname     =   form.find("input[name='name']").val()
                    var txttitle    =   form.find("input[name='title']").val()
                    var category    =   form.find("input[name='category']").val()
                    //$categoryClass  =   form.find("select[name='category'] option:checked").val();


                    //if (txtname == '') {alert(); return false; }
                    
                   insertReservation(fechaini , fechafin , txtname);

                });


                $modal.find('form').on('submit', function () {

                    title = form.find("input[name='title']").val();
                    //fllega = form.find("input[name='fecha_llegada']").val(fechaini);
                    //$('#fecha_llegada').val(fllega);

                    // Verificar campo title 
                    if (title == '') { 
                        //alert('Inserte un nombre');
                        //form.find("input[name='title']").focus(); return false; 
                    }

                    
                    $categoryClass = form.find("select[name='category'] option:checked").val();
                    
                    //alert($categoryClass)
                    

                    if (title !== null) {

                        calendar.fullCalendar('renderEvent', {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay,
                                className: $categoryClass
                            }, true // make the event "stick"
                        );
                    }

                    //insertReservation(fechaini , fechafin , title);

                    $modal.modal('hide');
                    return false;
                });
                calendar.fullCalendar('unselect');
            },

            eventClick: function (calEvent, jsEvent, view) {
                var form = $("<form></form>");
                form.append("<label>Change event name</label>");
                form.append("<div class='input-group'><input class='form-control' type=text value='" + calEvent.title + "' /><span class='input-group-btn'><button type='submit' class='btn btn-success'><i class='fa fa-check'></i> Modificar</button></span></div>");

                alert('Change Name');

                $modal.modal({
                    backdrop: 'static'
                });


                $modal.find('.remove-event').show().end().find('.save-event').hide().end().find('.modal-body').empty().prepend(form).end().find('.remove-event').unbind('click').click(function () {
                    calendar.fullCalendar('removeEvents', function (ev) {
                        return (ev._id == calEvent._id);
                    });
                    $modal.modal('hide');

                    alert('Delete');
                });

                $modal.find('form').on('submit', function () {
                    calEvent.title = form.find("input[type=text]").val();
                    calendar.fullCalendar('updateEvent', calEvent);
                    $modal.modal('hide');
                    alert('Update');
                    return false;
                });
            }
        });
    };


    return {
        init: function () {

            runCalendar();
        }
    };

// alert(start);
//  $('#fecha_llegada').val(fechaini) ;
}();

function objetoAjax(){
  var xmlhttp=false;
  try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
    try {
       xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false;
      }
  }

  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}

// Get rooms name
function getRoomsName () {

}


function guardarReserva () {
  
}

function mostrar ( id ) {
    //$("#"+ id).show();
    document.getElementById(id).style.display = 'block';
}

function ocultar ( id ) {
    //$("#"+ id).hide();
    document.getElementById(id).style.display = 'none';
}
// Insert Reservation
function insertReservation( fechaini , fechafin, txtname ) {

  //var cliente   = form.find("input[name='title']").val();
  alert('Insert by ajax');
  ajax2   = objetoAjax();
  ajax2.open("GET", "ajax/ajax_insertar_reserva.php?fechaini="+fechaini+"&fechafin="+fechafin+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      //contenido_editor.innerHTML = ajax2.responseText;
    }
  }

  ajax2.send(null);
}
