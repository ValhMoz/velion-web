<?php

require_once '../models/InvoiceModel.php';
require '../assets/fpdf186/invoice.php';

class InvoiceController extends PDF_Invoice
{
    private $invoiceModel;

    public function __construct()
    {
        $this->invoiceModel = new InvoiceModel();
    }

    public function obtenerFacturas()
    {
        return $this->invoiceModel->obtenerDatosFacturas();
    }

    public function obtenerFacturasUsuario($DNI)
    {
        return $this->invoiceModel->obtenerDatosFacturasUsuario($DNI);
    }

    // Función para generar la factura PDF
    function generarFacturaPDF($factura_id)
    {
        $factura = $this->invoiceModel->obtenerDatosFactura($factura_id);

        // Verificar si se encontró la factura
        if ($factura) {
            $pdf = new PDF_Invoice('P', 'mm', 'A4');
            $pdf->AddPage();
            $pdf->addSociete(
                iconv('UTF-8', 'windows-1252', 'Clínica Fisioterapia Aquiles'),
                "CIF: X-12345678\n".
                "Av. Virgen de los Dolores, 17\n" .
                iconv('UTF-8', 'windows-1252', "Córdoba, Córdoba, 14004\n").
                iconv('UTF-8', 'windows-1252', "Tel.: 957 413 031 • 661 125 257")
            );
            $pdf->fact_dev("Factura:", $factura_id);
            // $pdf->temporaire("Devis temporaire");
            $pdf->addDate($factura[0]['fecha_emision']);
            $pdf->addClient($factura[0]['paciente_id']);
            $pdf->addPageNumber("1");
            $pdf->addClientAdresse($factura);
            $pdf->addReglement("Tarjeta");
            $pdf->addEstado("Pagada");
            $pdf->addNumTVA("FR888777666");
            // $pdf->addReference("Devis ... du ....");
            $cols = array(
                "REF"    => 23,
                iconv('UTF-8', 'windows-1252', "DESCRIPCIÓN")  => 78,
                "CANTIDAD"     => 22,
                "PRECIO UNITARIO" => 37,
                "PRECIO TOTAL" => 30,
            );
            $pdf->addCols($cols);
            $cols = array(
                "REF"    => "L",
                iconv('UTF-8', 'windows-1252', "DESCRIPCIÓN")  => "L",
                "CANTIDAD"     => "C",
                "PRECIO UNITARIO" => "R",
                "PRECIO TOTAL" => "R",
            );
            $pdf->addLineFormat($cols);
            $pdf->addLineFormat($cols);

            $y    = 109;
            $line = array(
                "REF"    => "REF1",
                iconv('UTF-8', 'windows-1252', "DESCRIPCIÓN")  => "Bono 10 sesiones",
                "CANTIDAD"     => "1",
                "PRECIO UNITARIO"      => "600.00". EURO,
                "PRECIO TOTAL" => "600.00". EURO,
            );
            $size = $pdf->addLine($y, $line);
            // $y   += $size + 2;

            // $line = array(
            //     "REF"    => "REF2",
            //     iconv('UTF-8', 'windows-1252', "DESCRIPCIÓN")  => "Câble RS232",
            //     "CANTIDAD"     => "1",
            //     "PRECIO UNITARIO"      => "10.00",
            //     "PRECIO TOTAL" => "60.00",
            //     "TVA"          => "1"
            // );
            // $size = $pdf->addLine($y, $line);
            // $y   += $size + 2;

            // $pdf->addCadreTVAs();

            // invoice = array( "px_unit" => value,
            //                  "qte"     => qte,
            //                  "tva"     => code_tva );
            // tab_tva = array( "1"       => 19.6,
            //                  "2"       => 5.5, ... );
            // params  = array( "RemiseGlobale" => [0|1],
            //                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
            //                      "remise"         => value,     // {montant de la remise}
            //                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
            //                  "FraisPort"     => [0|1],
            //                      "portTTC"        => value,     // montant des frais de ports TTC
            //                                                     // par defaut la TVA = 19.6 %
            //                      "portHT"         => value,     // montant des frais de ports HT
            //                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
            //                  "AccompteExige" => [0|1],
            //                      "accompte"         => value    // montant de l'acompte (TTC)
            //                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
            //                  "Remarque" => "texte"              // texte
            // $tot_prods = array(
            //     array("px_unit" => 600, "qte" => 1, "tva" => 1),
            //     array("px_unit" =>  10, "qte" => 1, "tva" => 1)
            // );
            // $tab_tva = array(
            //     "1"       => 19.6,
            //     "2"       => 5.5
            // );
            // $params  = array(
            //     "RemiseGlobale" => 1,
            //     "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
            //     "remise"         => 0,       // {montant de la remise}
            //     "remise_percent" => 10,      // {pourcentage de remise sur ce montant de TVA}
            //     "FraisPort"     => 1,
            //     "portTTC"        => 10,      // montant des frais de ports TTC
            //     // par defaut la TVA = 19.6 %
            //     "portHT"         => 0,       // montant des frais de ports HT
            //     "portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
            //     "AccompteExige" => 1,
            //     "accompte"         => 0,     // montant de l'acompte (TTC)
            //     "accompte_percent" => 15,    // pourcentage d'acompte (TTC)
            //     "Remarque" => "Avec un acompte, svp..."
            // );

            // $pdf->addTVAs($params, $tab_tva, $tot_prods);
            $pdf->addCadreTotal();
            $pdf->Output("", "", true);
        }
    }


    public function guardarFactura($datos)
    {
        $this->invoiceModel->insert("facturas", $datos);
    }
}
