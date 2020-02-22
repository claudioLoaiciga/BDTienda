//Valiciones del formulario factura
$("#factura").submit(function(e) {
    var cadenaHTML = "";
    var ok = true;
    if ($("#txtEmpleado").val().length === 0) {
        cadenaHTML += "<li> El campo empleado es obligatorio. </li>";
        ok = false;
    }
    if ( $("#txtDireccion").val().length === 0) {
        cadenaHTML += "<li>El campo dirección es obligatorio. </li>";
        ok = false;
    }
    if ( $("#cantArticulo").val().length === 0) {
        cadenaHTML += "<li> Ingrese productos al detalle de la factura. </li>";
        ok = false;
    }
    
    
    if (ok === false) {
        $("#oculto").show();
        $("#alertDatosIncompletos").html(cadenaHTML);
        $('html, body').animate({ scrollTop: 0 }, 'slow');
        return ok;
    }
    return ok;
});
