DROP DATABASE bdventasingweb;
CREATE DATABASE bdventasingweb;
use bdventasingweb;

CREATE TABLE Usuario 
(
    usua_codigo int AUTO_INCREMENT PRIMARY key,
    usua_nombre varchar(32) NOT null UNIQUE,
    usua_clave varchar(32) not null, 
    usua_rol varchar(1) not null CHECK (usua_rol IN ('A', 'C')),
    usua_status varchar(1) not null CHECK (usua_status IN ('A', 'I')),
    foto varchar(32)
);

CREATE TABLE Producto 
(
    prod_codigo int AUTO_INCREMENT PRIMARY key,
    prod_nombre varchar(50) NOT null,
    prod_precioVenta int not null,
    prod_cantidadStock int not null,
    prod_unidadMedida varchar(50) not null,
    Prod_descripcion text not null
);
CREATE TABLE Cliente 
(
    codigo int AUTO_INCREMENT PRIMARY key,
    identificacion varchar(20) NOT null,
    tipoIdentificacion varchar(15) NOT null,
    nombre varchar(50) NOT null,
    apellido varchar(50) NOT null,
    celular varchar(20) NOT null,
    direccion varchar(50) NOT null,
    Usua_codigo_fk int not null,
    FOREIGN key (Usua_codigo_fk) REFERENCES Usuario (usua_codigo)
);
CREATE TABLE Administrador 
(
    codigo int AUTO_INCREMENT PRIMARY key,
    identificacion varchar(20) NOT null,
    tipoIdentificacion varchar(15) NOT null,
    nombre varchar(50) NOT null,
    apellido varchar(50) NOT null,
    celular varchar(20) NOT null,
    direccion varchar(50) NOT null,
    Usua_codigo_fk int not null,
    FOREIGN key (Usua_codigo_fk) REFERENCES Usuario (usua_codigo)
);
CREATE TABLE Venta 
(
    vent_codigo int AUTO_INCREMENT PRIMARY key,
    vent_fecha date NOT null,
    vent_total int NOT null,
    vent_cantidadTotal int NOT null,
    clie_codigo_fk int not null,
    vend_codigo_fk int not null,    
    FOREIGN key (clie_codigo_fk) REFERENCES Cliente (codigo),
    FOREIGN key (vend_codigo_fk) REFERENCES Administrador (codigo)
);
CREATE TABLE Detalle_Venta 
(
    Deve_codigo int AUTO_INCREMENT PRIMARY key,
    Deve_subtotal int NOT null,
    Deve_cantidadPorProducto int NOT null,
    vent_codigo_fk int not null,
    prod_codigo_fk int not null,    
    FOREIGN key (vent_codigo_fk) REFERENCES Venta (vent_codigo),
    FOREIGN key (prod_codigo_fk) REFERENCES Producto (prod_codigo)
);
insert into Usuario () values (null,'Clie','123','C','A','images/user.webp')
    ,(null,'Clie1','123','C','A','images/ganador.png')
    ,(null,'Clie2','123','C','A','images/mujer.png')
    ,(null,'Admi','123','A','A','images/programador.png')
    ,(null,'Admi1','123','A','A','images/hombre.png')
    ,(null,'Admi2','123','A','A','images/solicitante.png');
insert into Cliente () values (null,'79597736','c.c.','Clie','Castiblanco','3103195110','Calle 40B Sur 77-13',1)
    ,(null,'79597737','c.c.','Clie1','Castiblanco1','3103195111','Calle 40B Sur 77-13',2)
    ,(null,'79597736','c.c.','Clie3','Castiblanco3','3103195112','Calle 40B Sur 77-13',3);
insert into Administrador () values (null,'79597736','c.c.','Admi','Castiblanco','3103195110','Calle 40B Sur 77-13',4)
    ,(null,'79597737','c.c.','Admi1','Castiblanco1','3103195111','Calle 40B Sur 77-13',5)
    ,(null,'79597736','c.c.','Admi3','Castiblanco3','3103195112','Calle 40B Sur 77-13',6);
insert into Producto () values (null,'papa',1000,10,'Kg','papa criolla')
    ,(null,'arrpz',1000,10,'lb','arroz')
    ,(null,'yuca',2000,10,'Kg','yuca criolla');
insert into Venta () values (null,'2023/10/10',10000,23,1,1)
    ,(null,'2023/10/11',15000,10,1,1)
    ,(null,'2023/10/11',23000,5,2,2);
insert into Detalle_Venta () values (null,1000,5,1,1)
    ,(null,2000,4,1,2)
    ,(null,5000,3,1,3);

