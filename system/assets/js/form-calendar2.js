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

                // Name of client
                form = $("<form></form>");
                form.append("<div class='row'></div>");
                form.find(".row").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>New Event Name</label><input class='form-control' placeholder='Insert Event Name' type=text name='title'/></div></div>").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Category</label><select class='form-control' name='category'></select></div></div>").find("select[name='category']").append("<option value='label-default'>Work</option>").append("<option value='label-green'>Home</option>").append("<option value='label-purple'>Holidays</option>").append("<option value='label-orange'>Party</option>").append("<option value='label-yellow'>Birthday</option>").append("<option value='label-teal'>Generic</option>").append("<option value='label-beige'>To Do</option>");
                $modal.find('.remove-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                form.submit();

                    //alert('Save');
                    var data_start    =   start;
                    var data_end      =   end;

                    //alert($("#roomname").val())

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

                    //alert(fechaini);
                    //alert(fechafin);
                    // Insert / Save
                    //var txtname   =   $("input[name='name']").vale();
                    //var txtname     =   $("input[name=title]").val();
                    //var category    =   $("input[name=category]").val();
                    //$categoryClass  =   form.find("select[name='category'] option:checked").val();


                    //if (txtname == '') { return false; }
                    
                   // insertReservation(fechaini , fechafin );

                });


                $modal.find('form').on('submit', function () {

                    title = form.find("input[name='title']").val();

                    if (title == '') { 
                        alert('Inserte un nombre'); 
                        form.find("input[name='title']").focus(); return false; 
                    }

                    
                    $categoryClass = form.find("select[name='category'] option:checked").val();

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
}();

// Get rooms name
function getRoomsName () {

}

// Insert Reservation
function insertReservation( fechaini , fechafin ) {

  var cliente   = form.find("input[name='title']").val();
  alert(form.find("input[name='title']").val())
  ajax2   = nuevoAjax();
  ajax2.open("GET", "ajax/ajax_insertar_reserva.php?fechaini="+fechaini+"&fechafin="+fechafin+"&nombre="+cliente+"&id_user="+id_user+"&id_empresa="+id_empresa+"&nocache=<?php echo rand(99999,66666)?>",true);
  ajax2.onreadystatechange=function() {

    if (ajax2.readyState==4) {
      //contenido_editor.innerHTML = ajax2.responseText;
    }
  }

  ajax2.send(null);
}
