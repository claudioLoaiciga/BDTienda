function agregarCliente(idCliente){
    $("#txtCliente").val(idCliente);
    $('#exampleModalCentered').modal('hide');
    alert('Cliente agregado correctamente');
}
function agregarEmpleado(idEmpleado){
    $("#txtEmpleado").val(idEmpleado);
    $('#Empleado').modal('hide');
    alert('Empleado agregado correctamente');
}

function eliminarFila(btn) {
   if (confirm("Desea borrar este producto?")) {
       fila = btn.parentNode.parentNode;
       fila.parentNode.removeChild(fila);
       calcular();
   }
}
function calcular() {
   var subtotal = document.getElementsByName('det_Subtotal[]');
   var canti = document.getElementsByName('det_Cantidad[]');
   var cantTo = 0;
   var var_sub = 0;
   var cantTotal = 0;
   var sub = 0;
   for (var x = 0; x < subtotal.length; x++) {
       cantTo = canti[x].value;
       var_sub = subtotal[x].value;
       cantTotal = parseInt(cantTotal) + parseInt(cantTo);
       sub = parseInt(sub) + parseInt(var_sub);
   }
   $("#cantArticulo").val(cantTotal);
   $("#txtSubtotal").val(sub);
   var impuesto = sub * 0.13;
   $("#txtImp").val(impuesto);
   var total = sub + impuesto;
   $("#txtTotal").val(total);

}
function agregar(id) {
   var va = $("#cantidad_" + id).val();
   var form = "form-control";
   var nombrePro = $("#nombre_" + id).val();
   var precio = $("#precio_" + id).val();
   cargarDatosCanton();
   function cargarDatosCanton() {
       var subtotal = va * precio;
       var cadenaHTML = "<tr><th><input class= "+form+"  readonly = readonly  name=det_Codigo[] value=" + id + "></input></th>\n\
           <th><input class= "+form+" readonly = readonly  name=det_Articulo[] value="+nombrePro+"></input></th>\n\
           <th> <input class= "+form+" readonly = readonly name =det_Cantidad[] value=" + va + "></input></th>\n\
           <th> <input class= "+form+"  readonly = readonly name =det_Precio[] value=" + precio + " ></input></th>\n\
           <th> <input class= "+form+"  readonly = readonly name =det_Subtotal[] id=det_Subtotal[] value=" + subtotal + "></input></th>\n\
           <th><input  class= "+form+" type= button value=x onclick = eliminarFila(this)></input></th></tr>";
       $("#tbDetalle").append(cadenaHTML);
       calcular();

   }
}

