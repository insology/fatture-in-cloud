<?php

namespace InsologyStudio\FattureInCloud\Api;
use InsologyStudio\FattureInCloud\Factory\PersonalDataFactory;
use Illuminate\Support\Facades\Validator;

class PersonalData extends Api implements PersonalDataFactory
{   
    private $subject;

    public function __construct($subject)
    {   
        parent::__construct();
        $this->subject = $subject;
    }
    
   /**
     * List clients
     * @param array $data
     * @return array
     */
    public function list(array $data = []): array
    {   
        $validator = Validator::make($data, [
            'filtro' => 'string',
            'id' => 'integer',
            'nome' => 'string',
            'cf' => 'string',
            'piva' => 'string',
            'pagina' => 'integer'
        ]);

        if ($validator->fails()) {
            return $validator->messages()->toArray();
        }

        return $this->post("{$this->subject}/lista", $data);
    }

    public function create($data): array
    {
        $validator = Validator::make($data, $this->rules());

        if ($validator->fails()) {
            return $validator->messages()->toArray();
        }

        return $this->post("{$this->subject}/nuovo", $data);
        
    }

    public function update($data): array
    {
        $validator = Validator::make($data, array_merge(['id' => 'required|integer'], $this->rules()));

        if ($validator->fails()) {
            return $validator->messages()->toArray();
        }

        return $this->post("{$this->subject}/modifica", $data);
        
    }

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

    private function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'referente' => 'nullable|string|max:255',
            'indirizzo_via' => 'nullable|string|max:255',
            'indirizzo_cap' => 'nullable|string|max:255',
            'indirizzo_citta' => 'nullable|string|max:255',
            'indirizzo_provincia' => 'nullable|string|max:255',
            'indirizzo_extra' => 'nullable|string|max:255',
            'paese' => 'nullable|string|max:255',
            'mail' => 'nullable|email|max:255',
            'tel' => 'nullable|string|max:255',
            'fax' => 'nullable|string|max:255',
            'piva' => 'nullable|string|max:255',
            'cf' => 'nullable|string|max:255',
            'termini_pagamento' => 'nullable|string|max:255',
            'pagamento_fine_mese' => 'nullable|string|max:255',
            'cod_iva_default' => 'nullable|string|max:255',
            'extra' => 'nullable|string|max:255',
            'PA' => 'nullable|string|max:255',
            'PA_codice' => 'nullable|string|max:255',
        ];
    }
}