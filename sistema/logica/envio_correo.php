<?php

function EnvioCorreos($nombres) {
    $cuerpo = '
    %0D%0DCordial Saludo
    %0D%0D
    %0D%0DRespetado Sr@.: '.$nombres.'
    %0D%0D
    %0D%0DReciba un cordial saludo de MEDPLUS CONTACT CENTER con nuestros mejores deseos de bienestar.
    %0D%0D
    %0D%0DMe permito adjuntar la información referente al beneficio adicional de AMD MODULAR.
    %0D%0D
    %0D%0DEl valor por beneficiario es $8.600 pesos mensuales, éste servicio está diseñado para usuarios que esten afiliados a Medplus Medicina Prepagada, que se encuentren dentro del perimetro urbano de la ciudad de Bogotá y en municipios aledaños como lo son (Cajicá, Chía, Chocontá, Cogua, Cota, Facativá, Funza, Gachancipá, Guasca, Guatavita, Calera, Mosquera, Sibaté, Soacha, Sopó, Suesca, Tabio, Tenjo, Tocancipá y Zipaquirá) y Ciudades como Barranquilla, Bucaramanga, Cali, Medellin, Pereira, Villavicencio, Cartagena, Cúcuta, Ibague, Manizales; para acceder al servicio se puede comunicar en Bogota al 7420101 opción 1 o a la linea nacional 018000184000 opción1.
    %0D%0D
    %0D%0DPara finalizar, le reitero  en nombre de la compañía  nuestra voluntad siempre de servicio, quedando a su entera disposición; para mayor información o si desea adicionar este beneficio a su portafolio de servicios, no dude en comunicarse con nuestra línea de atención 7420101 opción 5.

    ';

    $envioCorreo = 'mailto: &body='.$cuerpo;
    return $envioCorreo;
}
   
?>