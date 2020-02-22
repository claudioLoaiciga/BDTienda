 --------------------------------------------------------------------------------
--FUNCIONES DETALLEFACTURA --
--------------------------------------------------------------------------------
create function f_DetalleFactura(@factura int )
returns table
return(select *  from DetalleFactura where factura = @factura)
 --------------------------------------------------------------------------------
--FUNCIONES DETALLEPEDIDO --
--------------------------------------------------------------------------------
create function f_DetallePedido(@pedido int )
returns table
return(select *  from DetallePedido where  pedido = @pedido)
