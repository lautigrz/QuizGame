<?php
    require_once('vendor/phpqrcode/qrlib.php');
class QRCodeGenerator
{
    public function generateBase64QRCode($data, $size = 10)
    {
        ob_start();
        QRcode::png($data, null, QR_ECLEVEL_L, $size);
        $imageData = ob_get_contents();
        ob_end_clean();
        return 'data:image/png;base64,' . base64_encode($imageData);
    }
}

