-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2021 at 09:37 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daw2_20_comparaprecios`
--
CREATE DATABASE IF NOT EXISTS `daw2_20_comparaprecios` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `daw2_20_comparaprecios`;

-- --------------------------------------------------------

--
-- Table structure for table `articulos`
--

CREATE TABLE `articulos` (
  `id` int(12) UNSIGNED NOT NULL,
  `nombre` text NOT NULL COMMENT 'Nombre o denominación para el artículo.',
  `descripcion` text DEFAULT NULL COMMENT 'Descripción breve del artículo o NULL si no es necesaria.',
  `categoria_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Categoria de clasificación del artículo o CERO si no existe o aún no está indicada (como si fuera NULL).',
  `imagen_id` varchar(25) DEFAULT NULL COMMENT 'Nombre identificativo (fichero interno) con la imagen principal o "de presentación" del artículo, o NULL si no hay.',
  `visible` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de artículo visible a los usuarios o invisible (se está manteniendo o está desactivado por otras causas): 0=Invisible, 1=Visible.',
  `cerrado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de artículo cancelado, eliminado o suspendido: 0=No (activo), 1=Eliminado por solicitud de baja, 2=Suspendido, 3=Cancelado por Inadecuado, ...',
  `comun` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de artículo común a cualquier tienda que lo relacione o particular de una tienda, creado o marcado así por un moderador/administrador: 0=Particular, 1=Comun. Habrá un proceso que pueda convertir un artículo particular en común.',
  `crea_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario que ha creado el registro o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `crea_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de creación del registro o NULL si no se conoce por algún motivo.',
  `modi_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario que ha modificado el registro por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `modi_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la última modificación del registro o NULL si no se conoce por algún motivo.',
  `notas_admin` text DEFAULT NULL COMMENT 'Notas adicionales que solo ven/modifican los moderadores/administradores sobre los datos del regsitro o NULL si no hay.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `articulos_etiquetas`
--

CREATE TABLE `articulos_etiquetas` (
  `id` int(12) UNSIGNED NOT NULL,
  `articulo_id` int(12) UNSIGNED NOT NULL COMMENT 'Artículo relacionado.',
  `etiqueta_id` int(12) UNSIGNED NOT NULL COMMENT 'Etiqueta relacionada.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `articulos_tienda`
--

CREATE TABLE `articulos_tienda` (
  `id` int(12) UNSIGNED NOT NULL,
  `articulo_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Artículo relacionado o CERO (como si fuera NULL) si no existe o aún no está indicado, aunque no debería ser así.',
  `tienda_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Tienda a la que pertenece el artículo relacionado o CERO (como si fuera NULL) si no existe o aún no está indicada, aunque no debería ser así.',
  `imagen_id` varchar(25) DEFAULT NULL COMMENT 'Nombre identificativo (fichero interno) con la imagen opcional del artículo, o NULL si no hay, mostrándose en este caso la imagen principal que pueda tener el artículo.',
  `url_articulo` text DEFAULT NULL COMMENT 'Dirección web externa (opcional) que enlaza con la página "oficial" de la tienda+artículo o NULL si no hay o no se conoce.',
  `precio` float NOT NULL DEFAULT 0 COMMENT 'Precio actual del artículo en la tienda.',
  `sumaValores` int(9) NOT NULL DEFAULT 0 COMMENT 'Suma acumulada de las valoraciones para el artículo en la tienda.',
  `totalVotos` int(9) NOT NULL DEFAULT 0 COMMENT 'Contador de votos (valoraciones) emitidas para el artículo en la tienda.',
  `visible` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de artículo visible a los usuarios o invisible (se está manteniendo o está desactivado por otras causas): 0=Invisible, 1=Visible.',
  `cerrado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de artículo cancelado, eliminado o suspendido: 0=No (activo), 1=Eliminado por solicitud de baja, 2=Suspendido, 3=Cancelado por Inadecuado, ...',
  `num_denuncias` int(9) NOT NULL DEFAULT 0 COMMENT 'Contador de denuncias del artículo en la tienda o CERO si no ha tenido.',
  `fecha_denuncia1` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.',
  `notas_denuncia` text DEFAULT NULL COMMENT 'Notas o texto visible con el motivo de la primera denuncia del artículo o NULL si no hay -se muestra este campo según el estado de "bloqueado"-.',
  `bloqueado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de artículo bloqueado: 0=No, 1=Si(bloqueado por denuncias), 2=Si(bloqueado por moderador o administrador), ...',
  `fecha_bloqueo` datetime DEFAULT NULL COMMENT 'Fecha y Hora del bloqueo del artículo. Debería estar a NULL si no está bloqueado o si se desbloquea.',
  `notas_bloqueo` text DEFAULT NULL COMMENT 'Notas visibles sobre el motivo del bloqueo del artículo o NULL si no hay -se muestra por defecto según indique "bloqueado"-.',
  `cerrado_comentar` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de artículo cerrado para agregar comentarios: 0=No, 1=Si.',
  `crea_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario que ha creado el registro o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `crea_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de creación del registro o NULL si no se conoce por algún motivo.',
  `modi_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario que ha modificado el registro por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `modi_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la última modificación del registro o NULL si no se conoce por algún motivo.',
  `notas_admin` text DEFAULT NULL COMMENT 'Notas adicionales que solo ven/modifican los moderadores/administradores sobre los datos del regsitro o NULL si no hay.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `avisos_usuarios`
--

CREATE TABLE `avisos_usuarios` (
  `id` int(12) UNSIGNED NOT NULL,
  `fecha_aviso` datetime NOT NULL COMMENT 'Fecha y Hora de creación del aviso.',
  `clase_aviso` char(1) NOT NULL DEFAULT 'M' COMMENT 'Código de clase de aviso (fijado desde programación): A=Aviso, N=Notificación, D=Denuncia, C=Consulta, B=Bloqueo, M=Mensaje Genérico,...',
  `texto` text DEFAULT NULL COMMENT 'Texto con el mensaje de aviso.',
  `destino_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario relacionado, destinatario del aviso, o CERO si es para administración y aún no está aceptado/gestionado.',
  `origen_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario relacionado, origen del aviso, o CERO si es del sistema o de un administrador sin identificar.',
  `tienda_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Tienda relacionada con el aviso, o CERO si no tiene que ver.',
  `articulo_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Artículo relacionado con el aviso o CERO si no tiene que ver.',
  `comentario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Comentario relacionado con el aviso o NULL si no tiene que ver.',
  `fecha_lectura` datetime DEFAULT NULL COMMENT 'Fecha y Hora de lectura del aviso o NULL si no se ha leido o se ha desmarcado como tal.',
  `fecha_aceptado` datetime DEFAULT NULL COMMENT 'Fecha y Hora de aceptación del aviso o NULL si no se ha aceptado para su gestión por un moderador o administrador. No se usa en otros usuarios.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(12) UNSIGNED NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `descripcion` text DEFAULT NULL COMMENT 'Texto adicional que describe la categoria.',
  `icono` varchar(25) DEFAULT NULL COMMENT 'Nombre del icono relacionado de entre los disponibles en la aplicación (carpeta iconos posibles).',
  `categoria_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Categoria relacionada, para poder realizar la jerarquía de categorías. Nodo padre de la jerarquía de categoría, o CERO si es nodo raiz (como si fuera NULL).'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clasificadores`
--

CREATE TABLE `clasificadores` (
  `id` int(12) UNSIGNED NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `descripcion` text DEFAULT NULL COMMENT 'Texto adicional que describe el clasificador o NULL si no es necesario.',
  `icono` varchar(25) DEFAULT NULL COMMENT 'Nombre del icono relacionado de entre los disponibles en la aplicación (carpeta iconos posibles).'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(12) UNSIGNED NOT NULL,
  `tienda_id` int(12) UNSIGNED NOT NULL COMMENT 'Tienda relacionada con el comentario, siempre habrá alguna.',
  `articulo_id` int(12) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Artículo relacionado con el comentario o CERO si el comentario es sólo de tienda.',
  `valoracion` int(2) NOT NULL DEFAULT 0 COMMENT 'Valoración dada a la tienda o al artículo en el comentario. El valor mínimo y máximo se pueden fijar por programación o configurado en la aplicación.',
  `texto` text NOT NULL COMMENT 'El texto del comentario. Poner un límite por programación o configurado en la aplicación.',
  `comentario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Comentario relacionado, si se permiten encadenar respuestas. Nodo padre de la jerarquia de comentarios o CERO si es nodo raiz.',
  `cerrado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de cierre de respuestas al comentario: 0=No, 1=Si(No se puede responder al comentario)',
  `num_denuncias` int(9) NOT NULL DEFAULT 0 COMMENT 'Contador de denuncias del comentario o CERO si no ha tenido.',
  `fecha_denuncia1` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.',
  `notas_denuncia` text DEFAULT NULL COMMENT 'Notas o texto visible con el motivo de la primera denuncia del comentario o NULL si no hay -se muestra este campo según el estado de "bloqueado"-.',
  `bloqueado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de comentario bloqueado: 0=No, 1=Si(bloqueado por denuncias), 2=Si(bloqueado por administrador), ...',
  `fecha_bloqueo` datetime DEFAULT NULL COMMENT 'Fecha y Hora del bloqueo del comentario. Debería estar a NULL si no está bloqueado o si se desbloquea.',
  `notas_bloqueo` text DEFAULT NULL COMMENT 'Notas visibles sobre el motivo del bloqueo del comentario o NULL si no hay -se muestra por defecto según indique "bloqueado"-.',
  `crea_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario que ha creado el registro o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `crea_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de creación del registro o NULL si no se conoce por algún motivo.',
  `modi_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario que ha modificado el registro por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `modi_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la última modificación del registro o NULL si no se conoce por algún motivo.',
  `notas_admin` text DEFAULT NULL COMMENT 'Notas adicionales que solo ven/modifican los moderadores/administradores sobre los datos del regsitro o NULL si no hay.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `configuraciones`
--

CREATE TABLE `configuraciones` (
  `clave` varchar(50) NOT NULL,
  `valor` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `copias_seg`
--

CREATE TABLE `copias_seg` (
  `id` int(11) NOT NULL COMMENT 'Clave para identificar las copias de seguridad, autoincrementada',
  `fecha` date DEFAULT NULL COMMENT 'fecha de realización de la copia de seguridad',
  `ruta` varchar(1000) DEFAULT NULL COMMENT 'ruta en la que se guarda la copia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `etiquetas`
--

CREATE TABLE `etiquetas` (
  `id` int(12) UNSIGNED NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `descripcion` text DEFAULT NULL COMMENT 'Texto adicional que describe la etiqueta o NULL si no es necesario.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `historico_precios`
--

CREATE TABLE `historico_precios` (
  `id` int(12) UNSIGNED NOT NULL,
  `articulo_id` int(12) UNSIGNED NOT NULL COMMENT 'Artículo relacionado.',
  `tienda_id` int(12) UNSIGNED NOT NULL COMMENT 'Tienda relacionada.',
  `fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de captura del precio del artículo en la tienda.',
  `precio` float NOT NULL DEFAULT 0 COMMENT 'Precio capturado en la fecha/hora indicada.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `moderadores`
--

CREATE TABLE `moderadores` (
  `id` int(12) UNSIGNED NOT NULL,
  `usuario_id` int(12) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Usuario relacionado con estos datos principales, creado para acceder a la aplicación y al que hace referencia, o CERO (como si fuera NULL) si aún no existe porque se está creando y no se ha relacionado.',
  `nif_cif` varchar(12) NOT NULL COMMENT 'Identificador de la entidad.',
  `nombre` varchar(100) DEFAULT NULL COMMENT 'Nombre si la entidad es de tipo persona.',
  `apellidos` varchar(150) DEFAULT NULL COMMENT 'Apellidos si la entidad es de tipo persona.',
  `razon_social` varchar(250) DEFAULT NULL COMMENT 'Razon social de la entidad si es de tipo empresa, o NULL si con el "nombre y apellidos" como persona es suficiente.',
  `direccion` text DEFAULT NULL COMMENT 'Direccion de la entidad o NULL si no quiere informar o no se conoce.',
  `region_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Región de localización de la entidad o CERO si no lo quiere informar (como si fuera NULL), aunque es recomendable.',
  `telefono_contacto` varchar(25) DEFAULT NULL COMMENT 'Telefono de contacto directo con la entidad o NULL si no se sabe o no hay.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ofertas`
--

CREATE TABLE `ofertas` (
  `id` int(12) UNSIGNED NOT NULL,
  `articulo_id` int(12) UNSIGNED NOT NULL COMMENT 'Artículo relacionado.',
  `tienda_id` int(12) UNSIGNED NOT NULL COMMENT 'Tienda relacionada.',
  `texto` text NOT NULL COMMENT 'El texto o descripción de la oferta.',
  `fecha_desde` datetime DEFAULT NULL COMMENT 'Fecha y Hora de inicio de la oferta o NULL si no se conoce (mostrar como *próximamente* en función de la fecha de creación del registro).',
  `fecha_hasta` datetime DEFAULT NULL COMMENT 'Fecha y Hora de finalización de la oferta o NULL si no se conoce (no caduca automáticamente).',
  `precio_oferta` float NOT NULL DEFAULT 0 COMMENT 'Precio del artículo durante el intervalo de tiempo de la oferta.',
  `precio_original` float NOT NULL DEFAULT 0 COMMENT 'Precio del artículo copiado antes de comenzar el intervalo de tiempo de la oferta.',
  `crea_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario que ha creado el registro o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `crea_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de creación del registro o NULL si no se conoce por algún motivo.',
  `modi_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario que ha modificado el registro por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `modi_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la última modificación del registro o NULL si no se conoce por algún motivo.',
  `notas_admin` text DEFAULT NULL COMMENT 'Notas adicionales que solo ven/modifican los moderadores/administradores sobre los datos del regsitro o NULL si no hay.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `regiones`
--

CREATE TABLE `regiones` (
  `id` int(12) UNSIGNED NOT NULL,
  `clase_region` char(1) NOT NULL COMMENT 'Código de clase de la región (fijado desde programación): C=Continente, P=Pais, E=Estado, P=Provincia, ...',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre de la zona que la identifica.',
  `region_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Región relacionada. Nodo padre de la jerarquia o CERO si es nodo raiz.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `regiones_moderador`
--

CREATE TABLE `regiones_moderador` (
  `id` int(12) UNSIGNED NOT NULL,
  `moderador_id` int(12) UNSIGNED NOT NULL COMMENT 'Moderador relacionado con una Región para su moderación.',
  `region_id` int(12) UNSIGNED NOT NULL COMMENT 'Región relacionada con el Moderador para que pueda gestionarla.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `registros_aplicacion`
--

CREATE TABLE `registros_aplicacion` (
  `id` int(12) UNSIGNED NOT NULL,
  `fecha_registro` datetime NOT NULL COMMENT 'Fecha y Hora del registro de acceso.',
  `clase_log` char(1) NOT NULL DEFAULT 'M' COMMENT 'Código de clase de log (fijado desde programación): E=Error(error), A=Aviso(warning), S=Seguimiento(trace), I=Información(info), D=Depuración(debug), ...',
  `modulo` varchar(50) DEFAULT 'app' COMMENT 'Modulo o Sección de la aplicación que ha generado el mensaje de registro.',
  `texto` text DEFAULT NULL COMMENT 'Texto con el mensaje de registro.',
  `ip` varchar(40) DEFAULT NULL COMMENT 'Dirección IP desde donde accede el usuario (vale para IPv4 e IPv6.',
  `browser` text DEFAULT NULL COMMENT 'Texto con información del navegador utilizado en el acceso.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `seguimientos_usuario`
--

CREATE TABLE `seguimientos_usuario` (
  `id` int(12) UNSIGNED NOT NULL,
  `usuario_id` int(12) UNSIGNED NOT NULL COMMENT 'Usuario relacionado, seguidor de la tienda, o el artículo o la oferta indicada. Al menos uno de los IDs no debe ser CERO.',
  `tienda_id` int(12) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Tienda relacionada con el seguimiento, o CERO si no se sigue a una tienda.',
  `articulo_id` int(12) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Artículo relacionado con el seguimiento o CERO si no se sigue a un artículo.',
  `oferta_id` int(12) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Oferta relacionada con el seguimiento o CERO si no se sigue a una oferta.',
  `fecha_alta` datetime NOT NULL COMMENT 'Fecha y Hora de activación del seguimiento por parte del usuario.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(12) UNSIGNED NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `descripcion` text DEFAULT NULL COMMENT 'Texto adicional que describe la categoria.',
  `icono` varchar(25) DEFAULT NULL COMMENT 'Nombre del icono relacionado de entre los disponibles en la aplicación (carpeta iconos posibles).',
  `categoria_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Categoria relacionada, para poder realizar la jerarquía de categorías. Nodo padre de la jerarquía de categoría, o CERO si es nodo raiz (como si fuera NULL).'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tiendas`
--

CREATE TABLE `tiendas` (
  `id` int(12) UNSIGNED NOT NULL,
  `nombre_tienda` text NOT NULL COMMENT 'Nombre o denominación para la tienda.',
  `descripcion_tienda` text DEFAULT NULL COMMENT 'Descripción breve de la tienda o NULL si no es necesaria.',
  `lugar_tienda` text DEFAULT NULL COMMENT 'Descripción adicional del lugar donde esta la tienda o NULL si no se conoce, aunque no debería estar vacío este dato.',
  `url_tienda` text DEFAULT NULL COMMENT 'Dirección web externa (opcional) que enlaza con la página "oficial" de la tienda o NULL si no hay o no se conoce.',
  `direccion_tienda` text DEFAULT NULL COMMENT 'Direccion de la entidad o NULL si no quiere informar o no se conoce.',
  `region_id_tienda` int(12) UNSIGNED DEFAULT 0 COMMENT 'Región de localización de la tienda o CERO (como si fuera NULL) si no se sabe, o aún no está indicada, aunque es recomendable.',
  `telefono_tienda` varchar(25) DEFAULT NULL COMMENT 'Telefono de la tienda o NULL si no se sabe o no hay.',
  `clasificacion_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Clasificación de la tienda o CERO si no existe o aún no está indicada (como si fuera NULL).',
  `imagen_id` varchar(25) DEFAULT NULL COMMENT 'Nombre identificativo (fichero interno) con la imagen principal o "de presentación" de la tienda, o NULL si no hay.',
  `sumaValores` int(9) NOT NULL DEFAULT 0 COMMENT 'Suma acumulada de las valoraciones para la tienda.',
  `totalVotos` int(9) NOT NULL DEFAULT 0 COMMENT 'Contador de votos (valoraciones) emitidas para la tienda.',
  `visible` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de tienda visible a los usuarios o invisible (se está manteniendo o está desactivada por otras causas): 0=Invisible, 1=Visible.',
  `cerrada` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de tienda cancelada, eliminada o suspendida: 0=No (activa), 1=Eliminada por solicitud de baja, 2=Suspendida, 3=Cancelada por Inadecuada, ...',
  `num_denuncias` int(9) NOT NULL DEFAULT 0 COMMENT 'Contador de denuncias de la tienda o CERO si no ha tenido.',
  `fecha_denuncia1` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.',
  `notas_denuncia` text DEFAULT NULL COMMENT 'Notas o texto visible con el motivo de la primera denuncia de la tienda o NULL si no hay -se muestra este campo según el estado de "bloqueada"-.',
  `bloqueada` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de tienda bloqueada: 0=No, 1=Si(bloqueada por denuncias), 2=Si(bloqueada por moderador o administrador), ...',
  `fecha_bloqueo` datetime DEFAULT NULL COMMENT 'Fecha y Hora del bloqueo de la tienda. Debería estar a NULL si no está bloqueada o si se desbloquea.',
  `notas_bloqueo` text DEFAULT NULL COMMENT 'Notas visibles sobre el motivo del bloqueo de la tienda o NULL si no hay -se muestra por defecto según indique "bloqueada"-.',
  `cerrado_comentar` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de tienda cerrada para agregar comentarios: 0=No, 1=Si.',
  `usuario_id` int(12) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Usuario relacionado con estos datos principales, propietario de la tienda o CERO (como si fuera NULL) si no tiene usuario vinculado o no se conoce, no existe, o aún no está indicado.',
  `nif_cif` varchar(12) NOT NULL COMMENT 'Identificador de la entidad.',
  `nombre` varchar(100) DEFAULT NULL COMMENT 'Nombre si la entidad es de tipo persona.',
  `apellidos` varchar(150) DEFAULT NULL COMMENT 'Apellidos si la entidad es de tipo persona.',
  `razon_social` varchar(250) DEFAULT NULL COMMENT 'Razon social de la entidad si es de tipo empresa, o NULL si con el "nombre y apellidos" como persona es suficiente.',
  `direccion` text DEFAULT NULL COMMENT 'Direccion de la entidad o NULL si no quiere informar o no se conoce.',
  `region_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Región de localización de la entidad o CERO si no lo quiere informar (como si fuera NULL), aunque es recomendable.',
  `telefono_contacto` varchar(25) DEFAULT NULL COMMENT 'Telefono de contacto directo con la entidad o NULL si no se sabe o no hay.',
  `crea_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario que ha creado el registro o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `crea_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de creación del registro o NULL si no se conoce por algún motivo.',
  `modi_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario que ha modificado el registro por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `modi_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la última modificación del registro o NULL si no se conoce por algún motivo.',
  `notas_admin` text DEFAULT NULL COMMENT 'Notas adicionales que solo ven/modifican los moderadores/administradores sobre los datos del regsitro o NULL si no hay.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tiendas_etiquetas`
--

CREATE TABLE `tiendas_etiquetas` (
  `id` int(12) UNSIGNED NOT NULL,
  `tienda_id` int(12) UNSIGNED NOT NULL COMMENT 'Tienda relacionada.',
  `etiqueta_id` int(12) UNSIGNED NOT NULL COMMENT 'Etiqueta relacionada.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(12) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL COMMENT 'Correo Electronico y "login" principal del usuario. Debe ser único.',
  `password` varchar(60) NOT NULL,
  `nick` varchar(25) NOT NULL COMMENT 'Identificador del usuario y posible "login" secundario. Debe ser único.',
  `nombre` varchar(100) DEFAULT NULL COMMENT 'Nombre de la persona.',
  `apellidos` varchar(150) DEFAULT NULL COMMENT 'Apellidos de la persona.',
  `direccion` text DEFAULT NULL COMMENT 'Direccion de la persona o NULL si no quiere informar o no se conoce.',
  `region_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Región de localización de la persona o CERO si no lo quiere informar (como si fuera NULL), aunque es recomendable, y necesario para comentar.',
  `telefono_contacto` varchar(25) DEFAULT NULL COMMENT 'Telefono de contacto directo con la persona o NULL si no lo quiere informar, no se sabe o no hay.',
  `fecha_nacimiento` date DEFAULT NULL COMMENT 'Fecha de nacimiento de la persona o NULL si no lo quiere informar.',
  `fecha_registro` datetime DEFAULT NULL COMMENT 'Fecha y Hora de registro del usuario o NULL si no se conoce por algún motivo (que no debería ser así).',
  `confirmado` tinyint(1) NOT NULL COMMENT 'Indicador de que el usuario ha confirmado su registro o no.',
  `fecha_acceso` datetime DEFAULT NULL COMMENT 'Fecha y Hora del ultimo acceso del usuario. Debería estar a NULL si no ha accedido nunca.',
  `num_accesos` int(9) NOT NULL DEFAULT 0 COMMENT 'Contador de accesos fallidos del usuario o CERO si no ha tenido o se ha reiniciado por un acceso valido o por un administrador.',
  `bloqueado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de usuario bloqueado: 0=No, 1=Si(bloqueado por accesos), 2=Si(bloqueado por administrador), ...',
  `fecha_bloqueo` datetime DEFAULT NULL COMMENT 'Fecha y Hora del bloqueo del usuario. Debería estar a NULL si no está bloqueado o si se desbloquea.',
  `notas_bloqueo` text DEFAULT NULL COMMENT 'Notas visibles sobre el motivo del bloqueo del usuario o NULL si no hay -se muestra por defecto según indique "bloqueado"-.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articulos_etiquetas`
--
ALTER TABLE `articulos_etiquetas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articulos_tienda`
--
ALTER TABLE `articulos_tienda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avisos_usuarios`
--
ALTER TABLE `avisos_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clasificadores`
--
ALTER TABLE `clasificadores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD PRIMARY KEY (`clave`);

--
-- Indexes for table `copias_seg`
--
ALTER TABLE `copias_seg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historico_precios`
--
ALTER TABLE `historico_precios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moderadores`
--
ALTER TABLE `moderadores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regiones`
--
ALTER TABLE `regiones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regiones_moderador`
--
ALTER TABLE `regiones_moderador`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registros_aplicacion`
--
ALTER TABLE `registros_aplicacion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seguimientos_usuario`
--
ALTER TABLE `seguimientos_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiendas`
--
ALTER TABLE `tiendas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiendas_etiquetas`
--
ALTER TABLE `tiendas_etiquetas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `nick_UNIQUE` (`nick`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articulos_etiquetas`
--
ALTER TABLE `articulos_etiquetas`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articulos_tienda`
--
ALTER TABLE `articulos_tienda`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `avisos_usuarios`
--
ALTER TABLE `avisos_usuarios`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clasificadores`
--
ALTER TABLE `clasificadores`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `copias_seg`
--
ALTER TABLE `copias_seg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave para identificar las copias de seguridad, autoincrementada';

--
-- AUTO_INCREMENT for table `etiquetas`
--
ALTER TABLE `etiquetas`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `historico_precios`
--
ALTER TABLE `historico_precios`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `moderadores`
--
ALTER TABLE `moderadores`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regiones`
--
ALTER TABLE `regiones`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regiones_moderador`
--
ALTER TABLE `regiones_moderador`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registros_aplicacion`
--
ALTER TABLE `registros_aplicacion`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seguimientos_usuario`
--
ALTER TABLE `seguimientos_usuario`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tiendas`
--
ALTER TABLE `tiendas`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tiendas_etiquetas`
--
ALTER TABLE `tiendas_etiquetas`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
