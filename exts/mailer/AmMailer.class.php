<?php

/**
 * Clase para el envío de E-mails
 */

// Incluir PHPMailer
Am::requireFile(dirname(__FILE__)."/php_mailer/PHPMailerAutoload");

class AmMailer extends PHPMailer{

  // Nombre del SMTP
  protected
    $smtpName = null,
    $template = null,
    $with = array();

  // Constructor
  public function __construct($name = null, $options = array()) {
    parent::__construct();

    if(isset($name)) $this->template("$name.view.php");

    // Asignar configuracion de cada parametros
    if(isset($options["smtp"]))       $this->smtpConf($options["smtp"]);
    if(isset($options["charSet"])){   $this->charSet($options["charSet"]); }
    if(isset($options["template"])){  $this->template($options["template"]); }
    if(isset($options["wordWrap"])){  $this->wordWrap($options["wordWrap"]); }
    if(isset($options["altBody"])){   $this->altBody($options["altBody"]); }
    if(isset($options["subject"])){   $this->subject($options["subject"]); }
    if(isset($options["isHtml"])){    $this->isHTML($options["isHtml"]); }

    // Asignación de remitente del correo
    if(isset($options["from"])){
      if(is_array($options["from"])){
        $from = isset($options["from"]["user"])? $options["from"]["user"] : null;
        $fromName = isset($options["from"]["as"])? $options["from"]["as"] : null;
      }else{
        $from = $fromName = $options["from"];
      }
      $this->from($from, $fromName);
    }

    // Recorrer cada uno de los tipos de destinatarios
    foreach(array(
      "replyTo" => "addReplyTo",
      "address" => "addAddress",
      "cc" => "addCC",
      "bcc" => "addBCC",
    ) as $key => $fn){

      // Si las opciones tienen nombrado elemento
      if(isset($options[$key])){
        // Si no se puede agregar la direccion y el valor es un array
        if(!$this->parseAndAdd($fn, $options[$key]) && is_array($options[$key])){
          // Recorrer el array para agregar cada posicion como una direccion
          foreach($options[$key] as $address){
            $this->parseAndAdd($fn, $address);
          }
        }
      }
    }

  }

  // Para agregar un destinatario con un determinado método
  public function parseAndAdd($addMethod, $addresses){
    // Si es un array y tiene un elemento "user"
    if(isset($addresses["user"])){
      // El parametro es un array con la direccion a enviar y el nombre
      $to = $addresses["user"];
      $toName = isset($addresses["as"])? $addresses["as"] : $to;
      $this->$addMethod($to, $toName);
      return true;
    }else if(is_string($addresses)){
      // El parametro e la direccion de email destino
      $to = $toName = $addresses;
      $this->$addMethod($to, $toName);
      return true;
    }
    return false;
  }

  // Asignacion de la configuracion SMTP
  public function smtpConf(array $smtp){

    // SMTP Configuration
    $this->isSMTP();
    $this->SMTPAuth = true;
    $this->Host = isset($smtp["host"])? $smtp["host"] : null;
    $this->Username = isset($smtp["user"])? $smtp["user"] : null;
    $this->Password = isset($smtp["pass"])? $smtp["pass"] : null;
    $this->SMTPSecure = isset($smtp["secure"])? $smtp["secure"] : null;

    // Asignar puerto si esta definido
    if(isset($config["port"])) $this->Port = $config["port"];
    
    // Asignar remitente 
    $this->from($this->Username, isset($config["ass"])? $config["ass"] : null);

  }

  // Método para asignar remitente
  public function from($email, $as = null){
    $this->From = $email;
    $this->FromName = $as;
    return $this;
  }

  // Metodo para signar template a renderizar para el mensaje
  public function template($template){
    $this->template = $template;
    return $this;
  }

  // Método set para el charSet
  public function charSet($charSet){
    $this->CharSet = $charSet;
    return $this;
  }

  // Método set para el wordWrap
  public function wordWrap($num){
    $this->WordWrap = $num;
    return $this;
  }
  
  // Método set para el subject
  public function subject($text){
    $this->Subject = $text;
    return $this;
  }
  
  // Método set para el altBody
  public function altBody($text){
    $this->AltBody = $text;
    return $this;
  }
  
  // Funcion para asignar el cuerpo del mensaje
  public function body($body){
    $this->Body = $body;
    return $this;
  }
  
  // Metodo para agregar direccion destinataria
  public function addAddress($address, $name = "") {
    parent::addAddress($address, $name);
    return $this;
  }
  
  // Metodo para agregar direccion de respuesta
  public function addReplyTo($address, $name = "") {
    parent::addReplyTo($address, $name);
    return $this;
  }
  
  // Metodo para agregar direccion con copia
  public function addCC($address, $name = "") {
    parent::addCC($address, $name);
    return $this;
  }
  
  // Metodo para agregar direccion con copia oculta
  public function addBCC($address, $name = "") {
    parent::addBCC($address, $name);
    return $this;
  }

  //Funcion para obtener la información del último error
  public function errorInfo(){
    return $this->ErrorInfo;
  }
  
  public function getContent(array $with = array()){

    ob_start();

    // Renderizar vista mediante un callback
    $ret = Am::call("render.template", array(
      $this->template,
      array(),
      $with,
      true
    ));

    // Obtener contenido renderizado
    $content = ob_get_clean();

    // Si se renderizo la vista con exito
    // se retorna el contenido del renderizado
    return $ret? $content : null;

  }

  // Método para enviar el mensaje
  public function send(array $arr = array()){
    
    // Renderizar contenido
    $content = $this->getContent($arr);

    // Se se devolvió un contenido válido se asigna al body
    if(isset($content)){
      $this->body($content);
    }

    // Enviar
    return parent::send();
      
  }

}
