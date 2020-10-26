<?php

namespace InsologyStudio\FattureInCloud\Services;
use InsologyStudio\FattureInCloud\Factory\Document;
use Illuminate\Support\Facades\Http;
use InsologyStudio\FattureInCloud\Traits\PayPalRequest as PayPalAPIRequest;
use Illuminate\Support\Facades\Validator;

class DocumentService extends ApiService implements Document
{   
    private $subject;

    public function __construct($subject)
    {   
        parent::__construct();
        $this->subject = $subject ;
        
    }
    /**
     * List invoices
     * @param array $data
     * @return array
     */
    public function list($data = []): array
    {       
        $validator = Validator::make($data, [
            'anno' => 'required_without:data_inizio|date_format:Y', 
            'data_inizio' => 'required_without:anno|date', 
            'data_fine' => 'required_with:data_inizio|date', 
            'cliente' => 'string', 
            'fornitore' => 'string', 
            'id_fornitore' => 'string', 
            'id_cliente' => 'string', 
            'saldato' => 'string',
            'oggetto' => 'string', 
            'ogni_ddt' => 'string', 
            'PA_tipo_cliente' => 'string', 
            'PA' => 'string', 
        ]);

        if ($validator->fails()) {
            return $validator->messages()->toArray();
        }

        return $this->post("{$this->subject}/lista", $data);
    }

    /**
     * Show invoices detail
     * @param array $data
     * @return array
     */
    public function details($data = []): array
    {   
        $validator = Validator::make($data, [
            'id' => 'required|integer', 
        ]);

        if ($validator->fails()) {
            return $validator->messages()->toArray();
        }

        return $this->post("{$this->subject}/dettagli", $data);
    }

    /**
     * Show invoice general settings
     * @param array $data
     * @return array
     */
    public function info($data = []): array
    {   
        $validator = Validator::make($data, [
            'anno' => 'required|date_format:Y', 
        ]);

        if ($validator->fails()) {
            return $validator->messages()->toArray();
        }
        
        return $this->post("{$this->subject}/info", $data);
    }

     /**
     * Show invoice email info
     * @param array $data
     * @return array
     */
    public function infoMail($data = []): array
    {   
        $validator = Validator::make($data, [
            'id' => 'required|integer', 
        ]);

        if ($validator->fails()) {
            return $validator->messages()->toArray();
        }
        return $this->post("{$this->subject}/infomail", $data);
    }

     /**
     * Send invoice to customer
     * @param array $data
     * @return array
     */
    public function sendMail($data = []): array
    {   
         $validator = Validator::make($data, [
            'id' => 'required|integer', 
        ]);

        if ($validator->fails()) {
            return $validator->messages()->toArray();
        }
        return $this->post("{$this->subject}/inviamail", $data);
    }

     /**
     * Create the invoice
     * @param array $data
     * @return array
     */
    public function create($data): array
    {
        $validator = Validator::make($data, $this->rules());

        if ($validator->fails()) {
            return $validator->messages()->toArray();
        }
        return $this->post("{$this->subject}/nuovo", $data);
        
    }

    /**
     * Update the invoice
     * @param array $data
     * @return array
     */
    public function update($data): array
    {
        $validator = Validator::make($data,array_merge(['id_cliente' => 'required|integer'], $this->rules()));


        if ($validator->fails()) {
            return $validator->messages()->toArray();
        }

        return $this->post("{$this->subject}/modifica", $data);
        
    }

    /**
     * Delete the invoice
     * @param array $data
     * @return array
     */
    public function delete($data): array
    {
         $validator = Validator::make($data, [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $validator->messages()->toArray();
        }
        
        return $this->post("{$this->subject}/elimina", $data);
    }

    /**
     * Invoice create/update rules
     * @return array
     */
    private function rules()
    {
        return [
            'id_cliente' => 'required|integer', 
            'id_fornitore' => 'required_without:id_cliente|integer', 
            'nome' => 'required|string', 
            'indirizzo_via' => 'string', 
            'indirizzo_cap' => 'string', 
            'indirizzo_citta' => 'string', 
            'indirizzo_provincia' => 'string',
            'indirizzo_extra' => 'string', 
            'paese' => 'string', 
            'paese_iso' => 'string', 
            'lingua' => 'string', 
            'cf' => 'string', 
            'piva' => 'string', 
            'autocompila_anagrafica' => 'boolean', 
            'salva_anagrafica' => 'boolean', 
            'numero' => 'string', 
            'data' => 'date', 
            'valuta' => 'string',
            'valuta_cambio' => 'integer', 
            'prezzi_ivati' => 'boolean', 
            'rivalsa' => 'float', 
            'cassa' => 'float', 
            'rit_acconto' => 'float', 
            'imponibile_ritenuta' => 'float', 
            'rit_altra' => 'float',
            'marca_bollo' => 'float', 
            'oggetto_visibile' => 'string', 
            'oggetto_interno' => 'string', 
            'centro_ricavo' => 'string', 
            'centro_costo' => 'string', 
            'note' => 'string', 
            'nascondi_scadenza' => 'string', 
            'ddt' => 'string',
            'ftacc' => 'string', 
            'id_template' => 'string', 
            'ddt_id_template' => 'string', 
            'ftacc_id_template' => 'string', 
            'mostra_info_pagamento' => 'string', 
            'metodo_pagamento' => 'string',
            'metodo_titoloN' => 'string', 
            'metodo_descN' => 'string', 
            'mostra_totali' => 'string', 
            'mostra_bottone_paypal' => 'date', 
            'mostra_bottone_bonifico' => 'date', 
            'mostra_bottone_notifica' => 'date', 
            'lista_articoli' => 'required|array', 
            'lista_articoli.*.nome' => 'required|string', 
            'lista_articoli.*.cod_iva' => 'required|integer', 
            'lista_articoli.*.prezzo_netto' => 'required|numeric', 
            'lista_articoli.*.prezzo_lordo' => 'required|numeric', 
            'lista_pagamenti' => 'required|array', 
            'lista_pagamenti.*.data_scadenza' => 'required|date_format:d/m/Y',
            'lista_pagamenti.*.data_saldo' => 'required|date_format:d/m/Y',
            'lista_pagamenti.*.importo' => 'required|numeric',
            'lista_pagamenti.*.metodo' => 'required|string',
            'ddt_numero' => 'string', 
            'ddt_data' => 'string', 
            'ddt_colli' => 'string',
            'ddt_peso' => 'string', 
            'ddt_causale' => 'string', 
            'ddt_luogo' => 'string', 
            'ddt_trasportatore' => 'string', 
            'ddt_annotazioni' => 'string', 
            'PA' => 'boolean', 
            'PA_tipo_cliente' => 'string', 
            'PA_tipo' => 'string', 
            'PA_numero' => 'string', 
            'PA_data' => 'string',
            'PA_cup' => 'string', 
            'PA_cig' => 'string', 
            'PA_codice' => 'string', 
            'PA_pec' => 'string', 
            'PA_esigibilita' => 'string', 
            'PA_modalita_pagamento' => 'string', 
            'PA_istituto_credito' => 'string', 
            'PA_iban' => 'string', 
            'PA_beneficiario' => 'string',
            'split_payment' => 'boolean', 
            'extra_anagrafica' => 'string',
        ];
    }
}