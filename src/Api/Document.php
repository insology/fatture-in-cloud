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
            'indirizzo_via' => 'nullable|string', 
            'indirizzo_cap' => 'nullable|string', 
            'indirizzo_citta' => 'nullable|string', 
            'indirizzo_provincia' => 'nullable|string',
            'indirizzo_extra' => 'nullable|string', 
            'paese' => 'nullable|string', 
            'paese_iso' => 'nullable|string', 
            'lingua' => 'nullable|string', 
            'cf' => 'nullable|string', 
            'piva' => 'nullable|string', 
            'autocompila_anagrafica' => 'nullable|boolean', 
            'salva_anagrafica' => 'nullable|boolean', 
            'numero' => 'nullable|string', 
            'data' => 'nullable|date', 
            'valuta' => 'nullable|string',
            'valuta_cambio' => 'nullable|integer', 
            'prezzi_ivati' => 'nullable|boolean', 
            'rivalsa' => 'nullable|float', 
            'cassa' => 'nullable|float', 
            'rit_acconto' => 'nullable|float', 
            'imponibile_ritenuta' => 'nullable|float', 
            'rit_altra' => 'nullable|float',
            'marca_bollo' => 'nullable|float', 
            'oggetto_visibile' => 'nullable|string', 
            'oggetto_interno' => 'nullable|string', 
            'centro_ricavo' => 'nullable|string', 
            'centro_costo' => 'nullable|string', 
            'note' => 'nullable|string', 
            'nascondi_scadenza' => 'nullable|string', 
            'ddt' => 'nullable|string',
            'ftacc' => 'nullable|string', 
            'id_template' => 'nullable|string', 
            'ddt_id_template' => 'nullable|string', 
            'ftacc_id_template' => 'nullable|string', 
            'mostra_info_pagamento' => 'nullable|string', 
            'metodo_pagamento' => 'nullable|string',
            'metodo_titoloN' => 'nullable|string', 
            'metodo_descN' => 'nullable|string', 
            'mostra_totali' => 'nullable|string', 
            'mostra_bottone_paypal' => 'nullable|date', 
            'mostra_bottone_bonifico' => 'nullable|date', 
            'mostra_bottone_notifica' => 'nullable|date', 
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
            'ddt_numero' => 'nullable|string', 
            'ddt_data' => 'nullable|string', 
            'ddt_colli' => 'nullable|string',
            'ddt_peso' => 'nullable|string', 
            'ddt_causale' => 'nullable|string', 
            'ddt_luogo' => 'nullable|string', 
            'ddt_trasportatore' => 'nullable|string', 
            'ddt_annotazioni' => 'nullable|string', 
            'PA' => 'nullable|boolean', 
            'PA_tipo_cliente' => 'nullable|string', 
            'PA_tipo' => 'nullable|string', 
            'PA_numero' => 'nullable|string', 
            'PA_data' => 'nullable|string',
            'PA_cup' => 'nullable|string', 
            'PA_cig' => 'nullable|string', 
            'PA_codice' => 'nullable|string', 
            'PA_pec' => 'nullable|string', 
            'PA_esigibilita' => 'nullable|string', 
            'PA_modalita_pagamento' => 'nullable|string', 
            'PA_istituto_credito' => 'nullable|string', 
            'PA_iban' => 'nullable|string', 
            'PA_beneficiario' => 'nullable|string',
            'split_payment' => 'nullable|boolean', 
            'extra_anagrafica' => 'nullable|string',
        ];
    }
}