<?php
// Incluir la librería PHP QR Code (asegúrate de que la ruta sea correcta)
include('vendor/phpqrcode/qrlib.php');

class PhpQrCode
{
    private $url;
    private $file;

    public function __construct($url, $file = null)
    {
        $this->url = $url;
        $this->file = $file;

    }

    

}


