USE master ;
GO
CREATE DATABASE sistemadecomprasv2
ON  PRIMARY
( NAME = 'sistemadecomprasv2_dat',
    FILENAME = 'C:\Program Files\Microsoft SQL Server\MSSQL14.MSSQLSERVER\MSSQL\DATA\sistemadecomprasv2dat.mdf',
    SIZE = 100MB,
    MAXSIZE = UNLIMITED,
    FILEGROWTH = 25MB )
LOG ON
( NAME = 'sistemadecomprasv2_log',
    FILENAME = 'C:\Program Files\Microsoft SQL Server\MSSQL14.MSSQLSERVER\MSSQL\DATA\sistemadecomprasv2log.ldf',
    SIZE = 20MB,
    MAXSIZE = 80MB,
    FILEGROWTH = 15% ) ;
GO
use sistemadecomprasv2
 go
--------------------------------------------------------------------------------
---TABLA CLIENTE
 -------------------------------------------------------------------------------
 create table Cliente(
  cedula INT NOT NULL,
  nombre VARCHAR(25) NOT NULL,
  apellidos VARCHAR(25) NOT NULL,
  email VARCHAR(45) NOT NULL,
  telefono INT NOT NULL,
  direccion VARCHAR(45) NOT NULL,
  constraint PK_Cliente primary key (cedula)
 )
 go

 --------------------------------------------------------------------------------
 ---TABLA EMPLEADO
  -------------------------------------------------------------------------------
  create table Empleado(
  idEmpleado INT NOT NULL,
  nombre VARCHAR(25) NOT NULL,
  apellidos VARCHAR(25) NOT NULL,
  telefono INT NOT NULL,
  puesto VARCHAR(15) NOT NULL,
  clave VARCHAR(10) NOT NULL,
   constraint PK_Empleado primary key (idEmpleado)
 )

 go


  --------------------------------------------------------------------------------
 ---TABLA AUDITORIA EMPLEADO
  -------------------------------------------------------------------------------
  create table logHistorial(
  nombre VARCHAR(50) NOT NULL,
  fecha DATETIME NOT NULL,
  descripcion VARCHAR(50) NOT NULL
 )

 go


 --------------------------------------------------------------------------------
 ---TABLA PROVEEDOR
  -------------------------------------------------------------------------------
   create table Proveedor(
  cedulaJuridica INT NOT NULL,
  nombre VARCHAR(25) NOT NULL,
  telefono INT NOT NULL,
  email VARCHAR(45) NOT NULL,
  tipo VARCHAR(15) NOT NULL,
   constraint PK_Proveedor primary key (cedulaJuridica)
 )

 go

 --------------------------------------------------------------------------------
 ---TABLA BODEGA
  -------------------------------------------------------------------------------
    create table Bodega(
 idBodega INT NOT NULL,
  nombre VARCHAR(25) NOT NULL,
  telefono INT NOT NULL,
  direccion VARCHAR(45) NOT NULL,
  email VARCHAR(45) NOT NULL,
   constraint PK_Bodega primary key (idBodega)

 )

 go
 --------------------------------------------------------------------------------
 ---TABLA PEDIDO
  -------------------------------------------------------------------------------
 create table Pedido(
  idPedido INT IDENTITY NOT NULL,
  direccionEnvio VARCHAR(45) NOT NULL,
  fecha DATE NOT NULL,
  empleado INT NULL,
  total float NULL
   constraint PK_Pedido primary key (idPedido),
   constraint  FK_Pedido_Empleado foreign key (empleado) references Empleado(idEmpleado)
 )

 go
 --------------------------------------------------------------------------------
 ---TABLA PRODUCTO
  -------------------------------------------------------------------------------
   create table Producto(
  codigo INT NOT NULL,
  nombreProducto VARCHAR(25) NOT NULL,
  marca VARCHAR(25) NOT NULL,
  descripcion VARCHAR(45) NOT NULL,
  tipo VARCHAR(15) NOT NULL,
  stock INT NOT NULL,
  proveedor INT NOT NULL,
  bodega INT NOT NULL,
  precio INT DEFAULT NULL,
   constraint PK_Producto primary key (codigo),
    constraint  FK_Producto_Proveedor foreign key (proveedor) references Proveedor(cedulaJuridica),
   constraint  FK_Producto_Bodega foreign key (bodega) references Bodega(idBodega)
 )

 go

 --------------------------------------------------------------------------------
 ---TABLA DETALLE PEDIDO
  -------------------------------------------------------------------------------
    create table DetallePedido(
  idDetallePedido INT IDENTITY NOT NULL,
  cantidad VARCHAR(45) NOT NULL,
  monto INT NOT NULL,
  pedido INT NOT NULL,
  producto INT NOT NULL,
  precio INT NOT NULL,
  descripcion VARCHAR(50) NOT NULL
 
   constraint PK_DetallePedido primary key (idDetallePedido),
   constraint  FK_DetallePedido_Pedido foreign key (pedido) references Pedido(idPedido),
   constraint  FK_DetallePedido_Producto foreign key (producto) references Producto(codigo)
 )

 go
 --------------------------------------------------------------------------------
 ---TABLA FACTURA
  -------------------------------------------------------------------------------
 create table Factura(
  numeroCompra INT IDENTITY NOT NULL,
  fecha DATE NOT NULL,
  impuesto INT NOT NULL,
  descuento INT NOT NULL,
  empleado INT NOT NULL,
  total INT NOT NULL,
  cliente INT NOT NULL,
  producto INT NOT NULL,
  constraint PK_Factura primary key (numeroCompra),
  constraint  FK_Factura_Empleado foreign key (empleado) references Empleado(idEmpleado),
  constraint  FK_Factura_Cliente foreign key (cliente) references Cliente(cedula)

 )
 go
 --------------------------------------------------------------------------------
 ---TABLA DETALLE FACTURA
  -------------------------------------------------------------------------------
  create table DetalleFactura(
  idDetalleFactura INT IDENTITY NOT NULL,
  factura INT NOT NULL,
  producto INT NOT NULL,
  descripcion varchar(45) NOT NULL,
  cantidad INT NOT NULL,
  precio INT NOT NULL,
  subtotal INT NOT NULL,
  constraint PK_DetalleFactura primary key (idDetalleFactura),
  constraint  FK_DetalleFactura_Factura foreign key (factura) references Factura(numeroCompra),
  constraint  FK_DetalleFactura_Producto foreign key (producto) references Producto(codigo)
 )
 go


 ------------------------------------------------------------------------------
--PROCEDIMIENTOS ALMACENADOS MODULO CLIENTE
------------------------------------------------------------------------------
--------------------------------------------------------------------------------
---AGREGAR Cliente
--------------------------------------------------------------------------------
create procedure pa_agregarCliente
  --Variable de entrada--
@cedula int ,
@nombre varchar (25),
@apellidos varchar (25),
@email varchar (45),
@telefono int,
@direccion varchar(45),


--Variable de salida--
@retorno varchar(6) output

as
Begin
if  not exists (select cedula
from Cliente
where cedula = @cedula)
begin
 insert into Cliente values(@cedula,@nombre,@apellidos,@email,@telefono,@direccion);
 set @retorno = 'TRUE';
 end
 else
  begin

  set @retorno = 'FALSE';
 end;
end

GO

--------------------------------------------------------------------------------
---BUSCAR CLIENTE
--------------------------------------------------------------------------------
create procedure pa_buscarCliente
  @cedula int
as
Begin
if   exists (select cedula
from Cliente
where cedula = @cedula)
begin
 select *  from Cliente where cedula = @cedula;
 end
end

GO

--------------------------------------------------------------------------------
-----MODIFICAR Cliente
--------------------------------------------------------------------------------
create procedure pa_modificarCliente
@cedula int ,
@nombre varchar (25),
@apellidos varchar (25),
@email varchar (45),
@telefono int,
@direccion varchar(45),
@retorno varchar(6) output

as
Begin
if   exists (select cedula
from Cliente
where cedula = @cedula)
begin
Update Cliente set nombre = @nombre ,apellidos = @apellidos, email =@email,telefono = @telefono ,direccion = @direccion where cedula = @cedula;
set @retorno='TRUE';
end
else
begin

set @retorno = 'FALSE';
end;
end

GO

--------------------------------------------------------------------------------
---ELIMINAR Cliente
--------------------------------------------------------------------------------
create procedure pa_eliminarCliente
@cedula int,
@retorno bit output
as
Begin
if   exists (select cedula
from Cliente
where cedula = @cedula)
begin
Delete from Cliente where cedula = @cedula;
set @retorno = 1;
end
else
begin

set @retorno=0;
end;
end

GO

 ------------------------------------------------------------------------------
--PROCEDIMIENTOS ALMACENADOS MODULO EMPLEADO
------------------------------------------------------------------------------
--------------------------------------------------------------------------------
---AGREGAR EMPLEADO
--------------------------------------------------------------------------------
create procedure pa_agregarEmpleado
    --Variable de entrada--
  @idEmpleado int ,
  @nombre varchar (45),
  @apellidos varchar (60),
  @telefono int,
  @puesto varchar(15),
  @clave varchar (20),

  --Variable de salida--
  @retorno varchar(6) output

  as
  Begin
  if  not exists (select idEmpleado
  from Empleado
  where idEmpleado = @idEmpleado)
  begin
   insert into Empleado values(@idEmpleado,@nombre,@apellidos,@telefono,@puesto,@clave);
   set @retorno = 'TRUE';
   end
   else
    begin

    set @retorno = 'FALSE';
   end;
  end

GO

--------------------------------------------------------------------------------
---BUSCAR EMPLEADO
--------------------------------------------------------------------------------
create procedure pa_buscarEmpleado
    @idEmpleado int
  as
  Begin
  if   exists (select idEmpleado
  from Empleado
  where idEmpleado = @idEmpleado)
  begin
   select *  from Empleado where idEmpleado = @idEmpleado;
   end
  end

GO

--------------------------------------------------------------------------------
---MODIFICAR EMPLEADO
--------------------------------------------------------------------------------
 create procedure pa_modificarEmpleado
  @idEmpleado int ,
  @nombre varchar (45),
  @apellidos varchar (60),
  @telefono int,
  @puesto varchar (15),
  @clave varchar (20),
  @retorno varchar(6) output

  as
  Begin
  if   exists (select idEmpleado
  from Empleado
  where idEmpleado = @idEmpleado)
  begin
  Update Empleado set nombre = @nombre ,apellidos = @apellidos, telefono = @telefono ,puesto = @puesto,clave = @clave where idEmpleado = @idEmpleado;
  set @retorno='TRUE';
  end
  else
  begin

  set @retorno = 'FALSE';
  end;
  end

GO

--------------------------------------------------------------------------------
---ELIMINAR EMPLEADO
--------------------------------------------------------------------------------
 create procedure pa_eliminarEmpleado
  @idEmpleado decimal(10),
  @retorno bit output
  as
  Begin
  if   exists (select idEmpleado
  from Empleado
  where idEmpleado = @idEmpleado)
  begin
  Delete from Empleado where idEmpleado = @idEmpleado;
  set @retorno = 1;
  end
  else
  begin

  set @retorno=0;
  end;
  end

GO

------------------------------------------------------------------------------
--PROCEDIMIENTOS ALMACENADOS MODULO PROVEEDOR
  ------------------------------------------------------------------------------
  ------------------------------------------------------------------------------
  ---AGREGAR PROVEEDOR
  ------------------------------------------------------------------------------
  create procedure pa_agregarProveedor
  @cedulaJuridica INT,
  @nombre VARCHAR(25),
  @telefono INT,
  @email VARCHAR(45),
  @tipo VARCHAR(15),

   @retorno varchar(6) output
   as
    Begin
    if  not exists (select cedulaJuridica
    from Proveedor
    where cedulaJuridica = @cedulaJuridica)
    begin
     insert into Proveedor values(@cedulaJuridica,@nombre,@telefono,@email,@tipo);
     set @retorno = 'TRUE';
     end
     else
      begin

      set @retorno = 'FALSE';
     end;
    end

GO

  ------------------------------------------------------------------------------
  ---BUSCAR PROVEEDOR
  ------------------------------------------------------------------------------
  create procedure pa_buscarProveedor
@cedulaJuridica INT
as
Begin
if   exists (select cedulaJuridica
from Proveedor
where cedulaJuridica = @cedulaJuridica)
begin
select *  from Proveedor where cedulaJuridica = @cedulaJuridica;
end
end



GO

 ------------------------------------------------------------------------------
  ---MODIFICAR PROVEEDOR
  ------------------------------------------------------------------------------
  create procedure pa_modificarProveedor
 @cedulaJuridica INT,
 @nombre VARCHAR(25),
 @telefono INT,
 @email VARCHAR(45),
 @tipo VARCHAR(15),
 @retorno varchar(6) output

   as
   Begin
   if   exists (select cedulaJuridica
   from Proveedor
   where cedulaJuridica = @cedulaJuridica)
   begin
   Update Proveedor set nombre = @nombre ,telefono = @telefono, email = @email ,tipo = @tipo where cedulaJuridica = @cedulaJuridica;
   set @retorno='TRUE';
   end
   else
   begin

   set @retorno = 'FALSE';
   end;
   end



GO

  ------------------------------------------------------------------------------
  ---ELIMINAR PROVEEDOR
  ------------------------------------------------------------------------------
  create procedure pa_eliminarProveedor
  @cedulaJuridica INT,
  @retorno bit output
  as
  Begin
  if   exists (select cedulaJuridica
  from Proveedor
  where cedulaJuridica = @cedulaJuridica)
  begin
  Delete from Proveedor where cedulaJuridica = @cedulaJuridica;
  set @retorno = 1;
  end
  else
  begin

  set @retorno=0;
  end;
  end

GO

--------------------------------------------------------------------------------
---PROCEDIMIENTOS ALMACENADOS MODULO BODEGA
--------------------------------------------------------------------------------
--------------------------------------------------------------------------------
---AGREGAR BODEGA
--------------------------------------------------------------------------------
create procedure pa_agregarBodega
  --Variable de entrada--
@idBodega INT,
 @nombre VARCHAR(25),
 @telefono INT,
 @direccion VARCHAR(45),
 @email VARCHAR(45),
--Variable de salida--
@retorno varchar(6) output

as
Begin
if  not exists (select idBodega
from Bodega
where idBodega = @idBodega)
begin
 insert into Bodega values(@idBodega,@nombre,@telefono,@direccion,@email);
 set @retorno = 'TRUE';
 end
 else
  begin

  set @retorno = 'FALSE';
 end;
end

GO

--------------------------------------------------------------------------------
---BUSCAR BODEGA
--------------------------------------------------------------------------------
create procedure pa_buscarBodega
  @idBodega int
as
Begin
if   exists (select idBodega
from Bodega
where idBodega = @idBodega)
begin
 select *  from Bodega where idBodega = @idBodega;
 end
end

GO

--------------------------------------------------------------------------------
---MODIFCAR BODEGA
--------------------------------------------------------------------------------
create procedure pa_modificarBodega
@idBodega INT,
@nombre VARCHAR(25),
@telefono INT,
@direccion VARCHAR(45),
@email VARCHAR(45),
@retorno varchar(6) output

as
Begin
if   exists (select idBodega
from Bodega
where idBodega = @idBodega)
begin
Update Bodega set nombre = @nombre ,telefono = @telefono, direccion =@direccion,email = @email where idBodega = @idBodega;
set @retorno='TRUE';
end
else
begin

set @retorno = 'FALSE';
end;
end

GO

--------------------------------------------------------------------------------
---ELIMINAR BODEGA
--------------------------------------------------------------------------------
create procedure pa_eliminarBodega
@idBodega int,
@retorno bit output
as
Begin
if   exists (select idBodega
from Bodega
where idBodega = @idBodega)
begin
Delete from Bodega where idBodega = @idBodega;
set @retorno = 1;
end
else
begin

set @retorno=0;
end;
end

GO

--------------------------------------------------------------------------------
---PROCEDIMIENTOS ALMACENADOS MODULO PRODUCTOS
--------------------------------------------------------------------------------

--------------------------------------------------------------------------------
---AGREGAR PRODUCTO
--------------------------------------------------------------------------------
create procedure pa_agregarProducto
  --Variable de entrada--
@codigo int,
@nombreProducto varchar (25),
@marca varchar (25),
@descripcion varchar(15),
@tipo varchar(15),
@stock int,
@proveedor int,
@bodega int,
@precio int,

--Variable de salida--
@retorno varchar(6) output

as
Begin
if  not exists (select codigo
from Producto
where codigo = @codigo)
begin
 insert into Producto values(@codigo,@nombreProducto,@marca,@descripcion,@tipo,@stock,@proveedor,@bodega,@precio);
 set @retorno = 'TRUE';
 end
 else
  begin

  set @retorno = 'FALSE';
 end;
end



GO

--------------------------------------------------------------------------------
---BUSCAR PRODUCTO
--------------------------------------------------------------------------------
create procedure pa_buscarProducto
  @codigo int
as
Begin
if   exists (select codigo
from Producto
where codigo = @codigo)
begin
 select *  from Producto where codigo = @codigo;
 end
end



GO
--------------------------------------------------------------------------------
-----MODIFICAR PRODUCTO
--------------------------------------------------------------------------------
create procedure pa_modificarProducto
  --Variable de entrada--
@codigo int,
@nombreProducto varchar (25),
@marca varchar (25),
@descripcion varchar(15),
@tipo varchar(15),
@stock int,
@proveedor int,
@bodega int,
@precio int,
@retorno varchar(6) output

as
Begin
if   exists (select codigo
from Producto
where codigo = @codigo)
begin
Update Producto set nombreProducto = @nombreProducto, marca = @marca, descripcion = @descripcion, tipo = @tipo, stock = @stock, proveedor = @proveedor, bodega = @bodega, precio = @precio where codigo = @codigo;
set @retorno='TRUE';
end
else
begin

set @retorno = 'FALSE';
end;
end



GO

--------------------------------------------------------------------------------
---ELIMINAR PRODUCTO
--------------------------------------------------------------------------------
create procedure pa_eliminarProducto
@codigo int,
@retorno bit output
as
Begin
if   exists (select codigo
from Producto
where codigo = @codigo)
begin
Delete from Producto where codigo = @codigo;
set @retorno = 1;
end
else
begin

set @retorno=0;
end;
end

GO

--------------------------------------------------------------------------------
---PROCEDIMIENTOS ALMACENADOS MODULO PEDIDO
--------------------------------------------------------------------------------
--------------------------------------------------------------------------------
---AGREGAR PEDIDO
--------------------------------------------------------------------------------
CREATE PROCEDURE pa_agregar_pedido
@direccionEnvio varchar(45),
@fecha date,
@empleado int,
@monto float
AS

BEGIN

IF (@direccionEnvio IS NULL OR @fecha IS NULL OR  @empleado IS NULL )
        BEGIN
            RAISERROR('Uno ó mas Parametros son NULL',1,1)
            return 0;
        END
	ELSE
        BEGIN
			insert into Pedido(direccionEnvio,fecha,empleado,total) VALUES (@direccionEnvio,@fecha,@empleado,@monto)
			return 1; 
		END
END

GO

--------------------------------------------------------------------------------
---BUSCAR PEDIDO
--------------------------------------------------------------------------------
CREATE PROCEDURE pa_buscar_Pedido
    @idPedido int
AS
BEGIN
    IF @idPedido IS NULL
        BEGIN
            RAISERROR(N'El Parametro es NULL',1,1)
            return 0;
        END
    ELSE
        BEGIN
        IF EXISTS(
                SELECT idPedido
                FROM dbo.Pedido
                WHERE idPedido = @idPedido
            )
            BEGIN
			 SELECT
				idPedido,
				direccionEnvio,
				fecha,
				empleado,
				total
                FROM dbo.Pedido WHERE idPedido = @idPedido;
                return 1;
        END
        ELSE
            BEGIN
			
                return 0;
            END
    END
END

GO

--------------------------------------------------------------------------------
---ELIMINAR PEDIDO
--------------------------------------------------------------------------------
create procedure pa_eliminarPedido
@idPedido int,
@retorno varchar output

AS
Begin
	if exists (select idPedido from Pedido where idPedido = idPedido)
		BEGIN
		-- PRIMERO SE ELIMINA LAS FOREANAS "EL DETALLE".
			DELETE FROM DetallePedido WHERE pedido = @idPedido;
		-- LUEGO SE ELIMINA LA FACTURA.
			DELETE FROM Pedido WHERE idPedido = @idPedido;
		-- VARIABLE RETORNO PARA CAPTAR EL PROYECTO SI SE EXECUTO CORRECTAMENTE!!!!!!
			set @retorno = '1';
		END
	ELSE
		BEGIN
		-- VARIABLE RETORNO PARA CAPTAR EL PROYECTO SI NO SE EXECUTO CORRECTAMENTE!!!!!!
			set @retorno = '0';
		END
END

GO

--------------------------------------------------------------------------------
---PROCEDIMIENTOS ALMACENADOS MODULO DETALLE PEDIDO
--------------------------------------------------------------------------------
--------------------------------------------------------------------------------
---AGREGAR DETALLE PEDIDO
--------------------------------------------------------------------------------
CREATE PROCEDURE pa_agregar_detPedido
    @cantidad int,
    @monto int,
	@pedido int,
	@producto int,
    @precio int,
	@descripcion varchar(45)
AS
BEGIN
    IF (@cantidad IS NULL OR @monto IS NULL OR @pedido IS NULL OR @producto IS NULL OR @precio IS NULL)
        BEGIN
            RAISERROR(N'Uno ó mas Parametros son NULL',1,1)
            return 0;
        END
    ELSE
        Begin
			insert into DetallePedido (cantidad,monto,pedido,producto,precio,descripcion) VALUES (@cantidad,@monto,@pedido,@producto,@precio,@descripcion)
			return 1 
		END
END

GO

--------------------------------------------------------------------------------
---PROCEDIMIENTOS ALMACENADOS MODULO PEDIDO
--------------------------------------------------------------------------------

--------------------------------------------------------------------------------
---AGREGAR DETALLE FACTURA
--------------------------------------------------------------------------------

create PROCEDURE pa_agregar_detFactura
    @factura int,
    @producto int,
	@descripcion varchar(45),
	@cantidad int,
    @precio int,
	@subTotal int
AS
BEGIN
    IF (@factura IS NULL OR @producto IS NULL OR @descripcion iS NULL OR @cantidad IS NULL OR @precio IS NULL OR @subTotal IS NULL)
        BEGIN
            RAISERROR(N'Uno ó mas Parametros son NULL',1,1)
            return 0;
        END
    ELSE
        Begin
			insert into DetalleFactura (factura,producto,descripcion,cantidad,precio,subtotal) VALUES (@factura,@producto,@descripcion,@cantidad,@precio,@subTotal)
			return 1 
		END
END

GO


--------------------------------------------------------------------------------
---AGREGAR FACTURA
--------------------------------------------------------------------------------

CREATE PROCEDURE pa_agregar_factura
@fecha date,
@impuesto int,
@descuento int,
@empleado int,
@total int,
@cliente int,
@producto int
AS

BEGIN

IF (@fecha IS NULL OR @impuesto IS NULL OR @descuento iS NULL OR @empleado IS NULL OR @total IS NULL OR @cliente is NULL OR @producto IS NULL)
        BEGIN
            RAISERROR('Uno ó mas Parametros son NULL',1,1)
            return 0;
        END
	ELSE
        BEGIN
			insert into Factura (fecha,impuesto,descuento,empleado,total,cliente,producto) VALUES (@fecha,@impuesto,@descuento,@empleado,@total,@cliente,@producto)
			return 1; 
		END
END



GO

--------------------------------------------------------------------------------
---BUSCAR FACTURA
--------------------------------------------------------------------------------

CREATE PROCEDURE pa_buscar_Factura
    @numeroCompra int
AS
BEGIN
    IF @numeroCompra IS NULL
        BEGIN
            RAISERROR(N'El Parametro es NULL',1,1)
            return 0;
        END
    ELSE
        BEGIN
        IF EXISTS(
                SELECT numeroCompra
                FROM dbo.Factura
                WHERE numeroCompra = @numeroCompra
            )
            BEGIN
			 SELECT
				numerocompra,
                fecha, 
                impuesto,
                descuento, 
                empleado, 
                total,
				cliente,
				producto
                FROM dbo.Factura WHERE numeroCompra= @numeroCompra;
                return 1;
        END
        ELSE
            BEGIN
			
                return 0;
            END
    END
END



GO

--------------------------------------------------------------------------------
---BUSCAR DETALLE FACTURA
--------------------------------------------------------------------------------

CREATE PROCEDURE pa_buscar_FacturaDet
    @factura int
AS
BEGIN
    IF @factura IS NULL
        BEGIN
            RAISERROR(N'El Parametro es NULL',1,1)
            return 0;
        END
    ELSE
        BEGIN
        IF EXISTS(
                SELECT idDetalleFactura
                FROM dbo.DetalleFactura
                WHERE factura = @factura
            )
            BEGIN
			 SELECT idDetalleFactura
                FROM dbo.DetalleFactura
                WHERE factura = @factura
                return 1;
        END
        ELSE
            BEGIN
			
                return 0;
            END
    END
END



GO
--------------------------------------------------------------------------------
---BUSCAR ELIMINAR FACTURA
--------------------------------------------------------------------------------

create procedure pa_eliminarFactura

@numeroCompra int,
@retorno varchar output

AS
Begin
	if exists (select numeroCompra from Factura where numeroCompra = numeroCompra)
		BEGIN
		-- PRIMERO SE ELIMINA LAS FOREANAS "EL DETALLE".
			DELETE FROM DetalleFactura WHERE factura = @numeroCompra;
		-- LUEGO SE ELIMINA LA FACTURA.
			DELETE FROM Factura WHERE numeroCompra = @numeroCompra;
		-- VARIABLE RETORNO PARA CAPTAR EL PROYECTO SI SE EXECUTO CORRECTAMENTE!!!!!!
			set @retorno = '1';
		END
	ELSE
		BEGIN
		-- VARIABLE RETORNO PARA CAPTAR EL PROYECTO SI NO SE EXECUTO CORRECTAMENTE!!!!!!
			set @retorno = '0';
		END
END



GO
-------------------------------------------------------
--PROCEDIMIENTO ALMACENADO BACKUP
-------------------------------------------------------

create procedure pa_respaldo2017

as
begin
BACKUP DATABASE [sistemadecomprasv2] 
  TO  DISK = N'C:\xampp\htdocs\BDTienda\Backup\sistemadecomprasv2.bak'
  WITH NOFORMAT, NOINIT,  NAME = N'sistemadecomprasv2-Full Database Backup', SKIP, NOREWIND, NOUNLOAD, COMPRESSION,  
  STATS = 10
  end
  GO

  -------------------------------------------------------
--PROCEDIMIENTO ALMACENADO BACKUP SQL SERVER DE VERSION 2012
-------------------------------------------------------

create procedure pa_respaldo
as
begin
	if (exists (select * from sysdatabases where name = 'sistemadecomprasv2'))
	begin
		Backup database sistemadecomprasv2
		to disk = 'C:\xampp\htdocs\BDTienda\Backup\b.bak'
		with format;
	end
end	
go


  -------------------------------------------------------
--PROCEDIMIENTO ALMACENADO RESCUPERACION
-------------------------------------------------------
create procedure pa_restore_db
as
begin
	restore database sistemadecomprasv2
	from disk = 'C:\xampp\htdocs\BDTienda\Backup\b.bak'
	with Recovery
end
go

--------------------------------------------------------------------------------
--VISTAS--
--------------------------------------------------------------------------------

 --------------------------------------------------------------------------------
--VISTA EMPLEADO--
--------------------------------------------------------------------------------
create view V_EMPLEADO
as
(select * from Empleado)
go


 --------------------------------------------------------------------------------
--VISTA CLIENTE--
--------------------------------------------------------------------------------
create view V_CLIENTE
as
(select * from Cliente)
go

 --------------------------------------------------------------------------------
--VISTA PROVEEDOR --
--------------------------------------------------------------------------------

create view V_PROVEEDOR
as
(select * from Proveedor)
go

 --------------------------------------------------------------------------------
--VISTA PRODUCTO --
--------------------------------------------------------------------------------
create view V_PRODUCTO
as
(select * from Producto)
go
 --------------------------------------------------------------------------------
--VISTA BODEGA --
--------------------------------------------------------------------------------
create view V_BODEGA
as
(select * from Bodega)
go

 --------------------------------------------------------------------------------
--FUNCIONES --
--------------------------------------------------------------------------------

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
