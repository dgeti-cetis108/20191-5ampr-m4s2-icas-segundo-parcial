create database suchidb;
use suchidb;

-- usuarios
create table usuarios (
    id int auto_increment primary key,
    nombre varchar(16) not null unique,
    contrasena varchar(200) not null,
    nombres varchar(50) not null,
    apellidos varchar(50) not null default 'X',
    correo_electronico varchar(200) not null unique,
    recordatorio varchar(200) default null,
    activo enum('0','1') not null default '1'
) engine=innodb, charset=utf8, collate=utf8_general_ci;

-- libros
create table libros (
    id int auto_increment primary key,
    titulo varchar(200) not null,
    isbn varchar(20) default null,
    total_paginas smallint not null,
    editorial_id int not null,
    categoria_id int not null,
    constraint fk_libros_editoriales
        foreign key (editorial_id)
        references editoriales(id)
            on delete restrict
            on update cascade,
    constraint fk_libros_categorias
        foreign key (categoria_id)
        references categorias(id)
            on delete restrict
            on update cascade
) engine=innodb, charset=utf8, collate=utf8_general_ci;

-- libros_tiene_autores
create table libros_tiene_autores (
    libro_id int,
    autor_id int,
    primary key (libro_id, autor_id),
    constraint fk_libros_tiene_autores_libros
        foreign key (libro_id)
        references libros(id)
            on delete restrict
            on update cascade,
    constraint fk_libros_tiene_autores_autores
        foreign key (autor_id)
        references autores(id)
            on delete restrict
            on update cascade
) engine=innodb, charset=utf8, collate=utf8_general_ci;

-- editoriales
create table editoriales (
    id int auto_increment primary key,
    nombre varchar(200) not null,
    sitio_web varchar(200) default null,
    telefono varchar(30) default null,
    correo_electronico varchar(200) not null,
    domicilio text not null
) engine=innodb, charset=utf8, collate=utf8_general_ci;

-- autores
create table autores (
    id int auto_increment primary key,
    nombre varchar(200) not null,
    correo_electronico varchar(200) not null
) engine=innodb, charset=utf8, collate=utf8_general_ci;

-- categorias
create table categorias (
    id int auto_increment primary key,
    nombre varchar(200) not null
) engine=innodb, charset=utf8, collate=utf8_general_ci;

-- prestamos
create table prestamos (
    id int auto_increment primary key,
    fecha_salida timestamp not null default current_timestamp,
    fecha_regreso timestamp default null,
    cliente_id int not null,
    usuario_id int not null,
    constraint fk_prestamos_clientes
        foreign key (cliente_id)
        references clientes(id)
            on delete restrict
            on update cascade,
    constraint fk_prestamos_usuarios
        foreign key (usuario_id)
        references usuarios(id)
            on delete restrict
            on update cascade
) engine=innodb, charset=utf8, collate=utf8_general_ci;

-- prestamos_tiene_libros
create table prestamos_tiene_libros (
    prestamo_id int,
    libro_id int,
    primary key (prestamo_id, libro_id),
    constraint fk_prestamos_tiene_libros_prestamos
        foreign key (prestamo_id)
        references prestamos(id)
            on delete restrict
            on update cascade,
    constraint fk_prestamos_tiene_libros_libros
        foreign key (libro_id)
        references libros(id)
            on delete restrict
            on update cascade
) engine=innodb, charset=utf8, collate=utf8_general_ci;

-- clientes
create table clientes (
    id int auto_increment primary key,
    nombres varchar(50) not null,
    apellidos varchar(50) not null default 'X',
    telefono varchar(30) not null,
    domicilio text not null
) engine=innodb, charset=utf8, collate=utf8_general_ci;