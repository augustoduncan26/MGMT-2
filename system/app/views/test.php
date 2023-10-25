
  <style type="text/css">
    .clsDatePicker {
    z-index: 100000;
}
  </style>

<script type='text/javascript'>//<![CDATA[
$(function(){
 $('#idTourDateDetails').datepicker({
     dateFormat: 'dd-mm-yy',
      minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altField: "#idTourDateDetailsHidden",
     altFormat: "yy-mm-dd"
 });
});//]]> 

</script>

  <!-- Button trigger modal -->
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Launch demo modal</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Modal title</h4>

            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        <label for="idTourDateDetails">Tour Start Date:</label>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="idTourDateDetails" id="idTourDateDetails" readonly="readonly" class="form-control clsDatePicker"> <span class="input-group-addon"><i id="calIconTourDateDetails" class="glyphicon glyphicon-th"></i></span>

                            </div>
                        </div>Alt Field:
                         <input type="text" name="birthdate" value="10/24/1984" />
 
<script type="text/javascript">
$(function() {
    $('input[name="idTourDateDetails"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    }, 
    function(start, end, label) {
        var years = moment().diff(start, 'years');
        alert("You are " + years + " years old.");
    });
});


// bootstrap-datepicker
$('#idTourDateDetails').datepicker({
  format: "dd-mm-yyyy",
  language: "es",
  autoclose: true,
  todayBtn: true
}).on(
  'show', function() {      
  // Obtener valores actuales z-index de cada elemento
  var zIndexModal = $('#myModal').css('z-index');
  var zIndexFecha = $('.datepicker').css('z-index');

        // alert(zIndexModal + zIndexFEcha);

        // Re asignamos el valor z-index para mostrar sobre la ventana modal
        $('.datepicker').css('z-index',zIndexModal+1);
});
</script>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
