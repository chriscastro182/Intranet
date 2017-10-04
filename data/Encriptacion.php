<?php

    function encryptAndEncode($text){
      $chris = new chrisAESSeguro();
      return base64_encode($chris->aes256_cbc_encrypt($text));
    }
    function DecodeAndDecrypt($text){
      $chris = new chrisAESSeguro();
      return $chris->aes256_cbc_decrypt(base64_decode($text));
    }

class chrisAESSeguroConParametros{

    function aes128_cbc_encrypt($key, $data, $iv) {
      if(16 !== strlen($key)) $key = hash('MD5', $key, true);
      if(16 !== strlen($iv)) $iv = hash('MD5', $iv, true);
      $padding = 16 - (strlen($data) % 16);
      $data .= str_repeat(chr($padding), $padding);
      return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv);
    }
    function aes256_cbc_encrypt($key, $data, $iv) {
      if(32 !== strlen($key)) $key = hash('SHA256', $key, true);
      if(16 !== strlen($iv)) $iv = hash('MD5', $iv, true);
      $padding = 16 - (strlen($data) % 16);
      $data .= str_repeat(chr($padding), $padding);
      return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv);
    }
    function aes128_cbc_decrypt($key, $data, $iv) {
      if(16 !== strlen($key)) $key = hash('MD5', $key, true);
      if(16 !== strlen($iv)) $iv = hash('MD5', $iv, true);
      $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv);
      $padding = ord($data[strlen($data) - 1]);
      return substr($data, 0, -$padding);
    }
    function aes256_cbc_decrypt($key, $data, $iv) {
      if(32 !== strlen($key)) $key = hash('SHA256', $key, true);
      if(16 !== strlen($iv)) $iv = hash('MD5', $iv, true);
      $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv);
      $padding = ord($data[strlen($data) - 1]);
      return substr($data, 0, -$padding);
    }
}

class chrisAESSeguro{

  private $key = "94DBEFD29E5F26CED59AF6C3A494E9BD";
    private $iv = "6EC04E6E00951BB3";
    function aes128_cbc_encrypt($data) {
      if(16 !== strlen($this->key)) $this->key = hash('MD5', $this->key, true);
      if(16 !== strlen($this->iv)) $this->iv = hash('MD5', $this->iv, true);
      $padding = 16 - (strlen($data) % 16);
      $data .= str_repeat(chr($padding), $padding);
      return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->key, $data, MCRYPT_MODE_CBC, $this->iv);
    }
    function aes256_cbc_encrypt($data) {
      if(32 !== strlen($this->key)) $this->key = hash('SHA256', $this->key, true);
      if(16 !== strlen($this->iv)) $this->iv = hash('MD5', $this->iv, true);
      $padding = 16 - (strlen($data) % 16);
      $data .= str_repeat(chr($padding), $padding);
      return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->key, $data, MCRYPT_MODE_CBC, $this->iv);
    }
    function aes128_cbc_decrypt($data) {
      if(16 !== strlen($this->key)) $this->key = hash('MD5', $this->key, true);
      if(16 !== strlen($this->iv)) $this->iv = hash('MD5', $this->iv, true);
      $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key, $this->data, MCRYPT_MODE_CBC, $this->iv);
      $padding = ord($data[strlen($data) - 1]);
      return substr($data, 0, -$padding);
    }
    function aes256_cbc_decrypt($data) {
      if(32 !== strlen($this->key)) $this->key = hash('SHA256', $this->key, true);
      if(16 !== strlen($this->iv)) $this->iv = hash('MD5', $this->iv, true);
      $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key, $data, MCRYPT_MODE_CBC, $this->iv);
      $padding = ord($data[strlen($data) - 1]);
      return substr($data, 0, -$padding);
    }
}


?>
