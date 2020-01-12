<?php
namespace App\Helper;

use Illuminate\Support\Facades\Auth;
use setasign\Fpdi\Fpdi;
//require('alphapdf.php');

class Helper{
    function generatePdf($file, $examinername, $watermark=1){
        $pdf = new PDF($watermark);
        $pdf->_file=$file;
        $pdf->_examinername=$examinername;
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        if($pdf->numPages>1) {
            for($i=2;$i<=$pdf->numPages;$i++) {
                $pdf->_tplIdx = $pdf->importPage($i);
                $pdf->AddPage();
            }
        }
        $distination_path = time().'_'.$examinername.'_'.$file;
        $filename=public_path('img/mailpdf/'.$distination_path);
        $pdf->Output($filename, 'F');

        return $distination_path;
    }
}


class PDF_Rotate extends Fpdi {

    var $angle = 0;

    function Rotate($angle, $x = -1, $y = -1) {
        if ($x == -1)
            $x = $this->x;
        if ($y == -1)
            $y = $this->y;
        if ($this->angle != 0)
            $this->_out('Q');
        $this->angle = $angle;
        if ($angle != 0) {
            $angle*=M_PI / 180;
            $c = cos($angle);
            $s = sin($angle);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
        }
    }

    function _endpage() {
        if ($this->angle != 0) {
            $this->angle = 0;
            $this->_out('Q');
        }
        parent::_endpage();
    }

}

//transparency class
class AlphaPDF extends PDF_Rotate
{
	var $extgstates = array();

	// alpha: real value from 0 (transparent) to 1 (opaque)
	// bm:    blend mode, one of the following:
	//          Normal, Multiply, Screen, Overlay, Darken, Lighten, ColorDodge, ColorBurn,
	//          HardLight, SoftLight, Difference, Exclusion, Hue, Saturation, Color, Luminosity
	function SetAlpha($alpha, $bm='Normal')
	{
		// set alpha for stroking (CA) and non-stroking (ca) operations
		$gs = $this->AddExtGState(array('ca'=>$alpha, 'CA'=>$alpha, 'BM'=>'/'.$bm));
		$this->SetExtGState($gs);
	}

	function AddExtGState($parms)
	{
		$n = count($this->extgstates)+1;
		$this->extgstates[$n]['parms'] = $parms;
		return $n;
	}

	function SetExtGState($gs)
	{
		$this->_out(sprintf('/GS%d gs', $gs));
	}

	function _enddoc()
	{
		if(!empty($this->extgstates) && $this->PDFVersion<'1.4')
			$this->PDFVersion='1.4';
		parent::_enddoc();
	}

	function _putextgstates()
	{
		for ($i = 1; $i <= count($this->extgstates); $i++)
		{
			$this->_newobj();
			$this->extgstates[$i]['n'] = $this->n;
			$this->_out('<</Type /ExtGState');
			$parms = $this->extgstates[$i]['parms'];
			$this->_out(sprintf('/ca %.3F', $parms['ca']));
			$this->_out(sprintf('/CA %.3F', $parms['CA']));
			$this->_out('/BM '.$parms['BM']);
			$this->_out('>>');
			$this->_out('endobj');
		}
	}

	function _putresourcedict()
	{
		parent::_putresourcedict();
		$this->_out('/ExtGState <<');
		foreach($this->extgstates as $k=>$extgstate)
			$this->_out('/GS'.$k.' '.$extgstate['n'].' 0 R');
		$this->_out('>>');
	}

	function _putresources()
	{
		$this->_putextgstates();
		parent::_putresources();
	}
}


//this class is the actuall one that draws water mark
class PDF extends AlphaPDF {

    var $_file;
    var $_examinername;
    var $_tplIdx;
	var $_watermark;

	function __construct($watermark){
		parent::__construct();
		$this->_watermark = $watermark;
	}

    function Header() {
		
        global $fullPathToFile;
		//importing first and then watermark puts the mark in the foreground. needed becauseof image pages.
		if ($this->_watermark){
			//put the "untersagt" water mark under the text
			$this->SetFont('Arial', '', 25);
			$this->SetTextColor(255, 192, 203);
			$this->SetAlpha(0.5);
			$this->RotatedText(10, 270, 'Die Verbreitung dieses Dokuments ist streng Untersagt!', 45);
		}
		
		//import the original page
		if (is_null($this->_tplIdx)) {
			// THIS IS WHERE YOU GET THE NUMBER OF PAGES
			$this->numPages = $this->setSourceFile(public_path('img/pdf/'.$this->_file));
			$this->_tplIdx = $this->importPage(1);
        }
		
		$this->SetAlpha(1);
		$this->useTemplate($this->_tplIdx, 0, 0, 200);
			
		if ($this->_watermark){	
		//put the user's name as water mark above the text
			$this->SetFont('Arial', '', 70);
			$this->SetTextColor(255, 192, 203);
			$this->SetAlpha(0.5);
			$this->RotatedText(20, 190, $this->_examinername, 45);
		}
    }

    function RotatedText($x, $y, $txt, $angle) {
        //Text rotated around its origin
        $this->Rotate($angle, $x, $y);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
    }


	
}


