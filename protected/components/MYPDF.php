<?php
include_once(APPLICATION_PATH . '/extensions/tcpdf/tcpdf.php');

/**
 * Class MYPDF
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class MYPDF extends TCPDF {
    public function Header() {
        //$this->Cell(0, 15, $this->header_title , 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        //$this->SetY(-10);
        //$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
