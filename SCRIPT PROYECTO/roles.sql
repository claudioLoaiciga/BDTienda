use sistemadecomprasv2
CREATE LOGIN [admin] WITH PASSWORD='12345678', DEFAULT_DATABASE=[sistemadecomprasv2], CHECK_EXPIRATION=OFF, CHECK_POLICY=OFF
go

CREATE USER [admin] FOR LOGIN [admin] WITH DEFAULT_SCHEMA=[sistemadecomprasv2]
--anadimos un roll
ALTER SERVER ROLE [sysadmin] ADD MEMBER[admin]
go


--este no podra acceder a la base de datos
CREATE LOGIN [usuario1] WITH PASSWORD='12345678', DEFAULT_DATABASE=[MASTER], CHECK_EXPIRATION=OFF, CHECK_POLICY=OFF
go

CREATE USER [usuario1] FOR LOGIN [usuario1] WITH DEFAULT_SCHEMA=[sistemadecomprasv2]
-- anadimos el roll
ALTER SERVER ROLE [securityadmin] ADD MEMBER[usuario1]

-----permisos a una tabla
use sistemadecomprasv2
grant select on pedido to [usuario];
grant select on factura to [usuario];
grant select on producto to [usuario];