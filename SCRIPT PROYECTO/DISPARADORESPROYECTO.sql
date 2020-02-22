--------------------------------------------------------------------------------
--TRIGGER---
--------------------------------------------------------------------------------

--------------------------------------------------------------------------------
--TRIGGER DE AUDITORIA DE INSERCION DEL MODULO EMPLEADO---
--------------------------------------------------------------------------------


create trigger dis_InsertarEmpleado
on Empleado
for insert
as
begin
set nocount on;
	insert into logHistorial (nombre, fecha, descripcion)
	select nombre, getdate(),'se insertaron datos en la tabla'
	from inserted
end



--------------------------------------------------------------------------------
--TRIGGER DE AUDITORIA DE ACTUALIZACION DEL MODULO EMPLEADO---
--------------------------------------------------------------------------------


create trigger dis_empleado_update
on Empleado
for update
as 
begin 

insert into logHistorial(nombre,fecha,descripcion) 
select nombre,GETDATE(),'Se actualizaron los datos de un empleado'
from inserted


end


--------------------------------------------------------------------------------
--TRIGGER DE AUDITORIA DE ELIMINACION DEL MODULO EMPLEADO---
--------------------------------------------------------------------------------

create trigger dis_empleado_delete
on Empleado
for delete
as 
begin 

insert into logHistorial(nombre,fecha,descripcion) 
select nombre,GETDATE(),'Se elimino un empleado'
from deleted


end

--------------------------------------------------------------------------------
--TRIGGER VALIDAR STOCK PRODUCTO---
--------------------------------------------------------------------------------

--------------------------------------------------------------------------------
--TRIGGER VALIDAR STOCK PRODUCTO---
--------------------------------------------------------------------------------

--------------------------------------------------------------------------------
--Disparaador que no permite que se elimine un producto que tiene stock disponible---
--------------------------------------------------------------------------------
create trigger dis_EliminarProducto
on Producto
for delete 
 as 
   if exists(select *from deleted where stock>0)--si algun registro borrado tiene stock
   begin
    raiserror('No puede eliminar productos que tienen stock',16,1)
    rollback transaction
   end
   else
   begin
     declare @cantidad int
     select @cantidad=count(*) from deleted
     select 'Se eliminaron ' +rtrim(cast(@cantidad as char(10)))+ ' registros'
   end;

 

   --------------------------------------------------------------------------------
--TRIGGER VALIDAR NOMBRE EMPLEADO--
--------------------------------------------------------------------------------

--------------------------------------------------------------------------------
--Disparaador que no permite que se edite el nombre del empleado---
--------------------------------------------------------------------------------

create trigger dis_EditarEmpleado
  on Empleado
  for update
  as
   if update (nombre)
   begin
    raiserror('El nombre de un empleado no puede modificarse.', 10, 1)
    rollback transaction
   end;


   
-- TRIGGER QUE NO ELIMINE CLIENTE # 1 --

if object_id('dis_No_EliminarCliente') is not null
drop trigger dis_No_EliminarCliente
go

create trigger dis_No_EliminarCliente on Cliente 
for delete as
Begin
	declare @cedula int
	set @cedula = (select cedula from deleted)
	
	if( (select cedula from deleted where cedula = 1) = @cedula)
		Begin
			declare @mensaje varchar (40)
			set @mensaje = 'No se elimino el Cliente'
			raiserror (@mensaje, 10, 1)
			rollback transaction
		end
	else
		begin
			delete from Cliente where cedula = @cedula
		end
End
go
]