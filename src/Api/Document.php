<?php

namespace InsologyStudio\FattureInCloud\Api;
use InsologyStudio\FattureInCloud\Factory\DocumentsFactory;
use InsologyStudio\FattureInCloud\Api\Api;
use Illuminate\Support\Facades\Validator;

class Document extends Api implements DocumentsFactory
{   
    private $subject;

    public function __construct($subject)
    {   
        parent::__construct();
        $this->subject = $subject ;
        
    }
    /**
     * List documents
     * @param array $data
     * @return array
     */
    public function list(array $data): array
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
     * Show document detail
     * @param array $data
     * @return array
     */
    public function details(array $data): array
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
     * Show document general settings
     * @param array $data
     * @return array
     */
    public function info(array $data): array
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
     * Show document email info
     * @param array $data
     * @return array
     */
    public function infoMail(array $data): array
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
     * Send document to customer
     * @param array $data
     * @return array
     */
    public function sendMail(array $data): array
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
     * Create the document
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $validator = Validator::make($data, $this->rules());

        if ($validator->fails()) {
            return $validator->messages()->toArray();
        }
        return $this->post("{$this->subject}/nuovo", $data);
        
    }

    /**
     * Update the document
     * @param array $data
     * @return array
     */
    public function update(array $data): array
    {
        $validator = Validator::make($data,array_merge(['id_cliente' => 'required|integer'], $this->rules()));


        if ($validator->fails()) {
            return $validator->messages()->toArray();
        }

        return $this->post("{$this->subject}/modifica", $data);
        
    }

    /**
     * Delete the document
     * @param array $data
     * @return array
     */
    public function delete(array $data): array
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
     * Document create/update rules
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