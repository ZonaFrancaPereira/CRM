<?php

/*
 * Copyright (C) 2021 julio
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/*
  if(file_exists("../../configuracion.php")){


  include_once "../../configuracion.php";


  if(defined('BD_HOST')){

  return;

  }


  }
 */

// CONEXIÓN BASE DE DATOS
CONST BD_HOST = "127.0.0.1";
CONST BD_PUERTO = "3306";
CONST BD_NOMBRE = "tm";
CONST BD_USUARIO = "root";
CONST BD_CONTRA = "";
CONST DEBUG = false;
CONST MOSTRARWARNINGS = false;

if (!MOSTRARWARNINGS) {
    error_reporting(0);
}


// CONEXIÓN BASE DE DATOS

/* HOSTINGER
CONST BD_HOST = "195.35.61.58";
CONST BD_PUERTO = "3306";
CONST BD_NOMBRE = "u446101023_prueba";
CONST BD_USUARIO = "u446101023_prueba";
CONST BD_CONTRA = "CUen%%ZFip2019";
CONST DEBUG = false;
CONST MOSTRARWARNINGS = false;

if (!MOSTRARWARNINGS) {
    error_reporting(0);
}
*/