<?php
//echo $_GET['id_user'];
include_once ('../framework.php');

$id_user      = $_SESSION['id_user'];
$id_empresa   = $_SESSION['id_empresa'];
$P_Tabla      = "fact_products";
$P_TablaCat   = $caja_prefix."category";


$sql_hab      = mysql_query("Select * From ".$P_Tabla." Where id = '".$_GET['id']."'")or die(mysql_error());
$data         = mysql_fetch_object($sql_hab);

if ($_SESSION['id_empresa'] == 1 || $_SESSION['id_empresa'] == 2) {

  $selCat     = mysql_query("Select * From ".$P_TablaCat." Where activo = 1")or die(mysql_error());

} else {
  
  $selCat     = mysql_query("Select * From ".$P_TablaCat." Where id_empresa = '".$_SESSION['id_empresa']."' and activo = 1");

}

//$ObjMant    = new Mantenimientos();
//$selEmp     =  $ObjMant->BuscarLoQueSea('*' , 'empresas', 'id_usuario = '.$saco['id_usuario'], 'extract', false);

?>
<form method="post" enctype="multipart/form-data">
   <table class="table table-bordered table-hover" id="sample-table-4">
               <thead>
               </thead>
               <tbody>

                <tr>
                   <td width="30%">Código de Barras</td>
                   <td width="70%"><input maxlength="50" autofocus="" name="txt_codigo_barra" type="text" class="form-control" id="txt_codigo_barra" placeholder="Codigo de Barra del Producto" value="<?=$data->barcode;?>">
                   <input type="hidden" name="id_row" id="id_row" value="<?=$data->id?>"></td>
                 </tr>

                <tr>
                   <td width="30%">Descripción <span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="50" autofocus="" name="txt_descripcion" required="" type="text" class="form-control" id="txt_descripcion" placeholder="Descripción" value="<?=$data->description;?>"></td>
                 </tr>

                 <tr>
                   <td width="30%">Categoría <span class="symbol required"></span></td>
                   <td width="70%">
                   <select name="txt_categoria" id="txt_categoria" required="" class="form-control">
                    <option value="">-----seleccionar-----</option>
                      <?php 
                          while ($dataCat = mysql_fetch_object($selCat)) {
                            if ($data->category_id == $dataCat->id) {
                              echo '<option value="'.$dataCat->id.'" selected>'.$dataCat->name.'</option>';
                            } else {
                              echo '<option value="'.$dataCat->id.'">'.$dataCat->name.'</option>';
                            }
                          }
                      ?>
                   </select>
                   </td>
                 </tr>
                 <tr>
                  <td>Imagen</td>
                  <td>
                    <input type='file' id="txt_product_image" name="txt_product_image" />
                    <div style="margin-right: 50px !important; float: right;">
                    <?php if ($data->image=='') { ?>
                    <img id="timage_preview" class="text-right" style="margin-right:0px !important;width: 100px; height: 100px; margin-left: 100px" src="#" alt="" />
                    <?php } else { ?>
                    <img id="timage_preview" class="text-right" style="margin-right:0px !important;width: 100px; height: 100px; margin-left: 100px" src="images/products-images/<?=$data->image?>" alt="" />
                    <?php } ?>
                    </div>
                  </td>
                 </tr>

                <tr>
                   <td width="30%">Cantidad <span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="11" autofocus="" name="txt_cantidad" required="" type="number" min="1" step="1" class="form-control" id="txt_cantidad" value="<?php echo $data->quantity?>" placeholder="Cantidad"></td>
                 </tr>
                 <tr>
                   <td width="30%">Stock Mínimo <span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="50" autofocus="" name="txt_stock_minimo" required="" type="number" min="1" step="1" class="form-control" id="txt_stock_minimo" value="<?php echo $data->inventory_min?>" placeholder="Stock Mínimo"></td>
                 </tr>

                 <tr>
                   <td width="30%">Precio Compra<span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="50" autofocus="" name="txt_precio_costo" required="" type="number" min="1" step="1" class="form-control" id="txt_precio_costo" value="<?php echo $data->price_in?>" placeholder="Precio Costo"></td>
                 </tr>

                 <tr>
                   <td width="30%">Precio Venta <span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="50" autofocus="" name="txt_precio_venta" required="" type="number" min="1" step="1" class="form-control" id="txt_precio_venta" value="<?php echo $data->price_out?>" placeholder="Precio Venta"></td>
                 </tr>

                 <!-- <tr>
                   <td width="30%">Descripción <span class="symbol required"></span></td>
                   <td width="70%"><input maxlength="50" autofocus="" name="descripcion" required="" type="text" class="form-control" id="descripcion" placeholder="Descripción"></td>
                 </tr> -->
                 <tr>
                   <td>Estado</td>
                   <td>
                    <select name="txt_estado" id="txt_estado" class="form-control">
                      <option value="1" <?php if ($data->activo==1) { echo 'selected'; } ?>>Activo</option>
                      <option value="0" <?php if ($data->activo==0) { echo 'selected'; } ?>>Inactivo</option>
                    </select>
                   </td>
                 </tr>
                                       
               </tbody>
             </table>
</form>
