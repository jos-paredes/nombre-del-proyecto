<?php

namespace App\Libraries;

require_once(base_path('vendor/setasign/fpdf/fpdf.php'));

class UTF8FPDF extends \FPDF
{
    protected $customFontsPath;
    
    public function __construct($orientation = 'P', $unit = 'mm', $size = 'A4')
    {
        parent::__construct($orientation, $unit, $size);
        $this->customFontsPath = base_path('public/fonts/');
    }
    
    function Cell($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
    {
        parent::Cell($w, $h, $this->convertText($txt), $border, $ln, $align, $fill, $link);
    }

    function MultiCell($w, $h, $txt, $border = 0, $align = 'J', $fill = false)
    {
        parent::MultiCell($w, $h, $this->convertText($txt), $border, $align, $fill);
    }

    function Write($h, $txt, $link = '')
    {
        parent::Write($h, $this->convertText($txt), $link);
    }
    
    protected function convertText($text)
    {
        return iconv('UTF-8', 'windows-1252', $text);
    }
    
    public function AddCustomFont($family, $style = '', $fontfile = '')
    {
        $fontfile = $this->customFontsPath . $fontfile;
        if(file_exists($fontfile)) {
            $this->AddFont($family, $style, $fontfile);
            return true;
        }
        return false;
    }
    public function RotatedText($x, $y, $txt, $angle)
    {
        // Texto rotado
        $this->_out(sprintf('q %.2F %.2F %.2F %.2F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm %.2F 0 0 %.2F 0 0 cm BT /F%d %.2F Tf (%s) Tj ET Q',
            cos(deg2rad($angle)), sin(deg2rad($angle)), -sin(deg2rad($angle)), cos(deg2rad($angle)), $x, $y,
            -$x, -$y, 1, 1, $this->CurrentFont['i'], $this->FontSizePt, $this->_escape($txt)));
    }
}