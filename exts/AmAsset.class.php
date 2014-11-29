<?php

/**
 * Clase para atender peticiones de archivos virtuales/compuestos
 */

class AmAsset{

  protected
    $file   = null, // Nombre virtual del archivo compuesto
    $assets = null; // Lista de archivos que lo componen

  // Constructor. Recibe el nombre del archivo y la lista de archivos que lo componen
  public function __construct($file, array $assets){
    $this->file = $file;
    $this->assets = $assets;
  }

  // Obtener le contenido del archivo virtual
  public function getContent(){

    // Concatenar el contenido de los archivos configurados
    $content = "";
    foreach($this->assets as $asset){

      // Si el archivo existe entonces concatenar
      if(is_file($asset)){
        $content .= "\n".file_get_contents($asset);
      // Mostrar error
      }else{}

    }
    // Retornar todo lo contatenado
    return $content;
  }

  // Devuelve el mime-type del archivo basandose en el nombre virtual
  public function getMimeType(){
    return Am::mimeType($this->file);
  }

  // Renderiza el archivo virtual imprimiendo el contenido
  public function render(){
    header("content-type: {$this->getMimeType()}");
    echo $this->getContent();
  }

  // Funcion para atender la llamada de archivos virtuales compuestos
  public static function response($file, array $assets, array $env){
    
    // Instanciar archivo
    $asset = new self($file, $assets);
    
    // Responder
    $asset->render();

    return true;

  }

}

Am::setCallback("response.assets", "AmAsset::response");