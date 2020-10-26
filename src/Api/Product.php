<?php

namespace InsologyStudio\FattureInCloud\Api;
use InsologyStudio\FattureInCloud\Factory\ProductFactory;
use Illuminate\Support\Facades\Validator;

class Product extends Api implements ProductFactory
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
            'cod' => 'string',
            'desc' => 'string',
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
        $validator = Validator::make($data, array_merge(['id' => 'required|integer'], $this->rules));

        if ($validator->fails()) {
            return $validator->messages()->toArray();
        }

        return $this->post("{$this->subject}/modifica", $data);
        
    }

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

    private function rules(): array
    {
        return [
            'cod' => 'string',
            'nome' => 'required|string|max:255',
            'desc' => 'string',
            'prezzo_ivato' => 'boolean',
            'prezzo_netto' => 'numeric',
            'prezzo_lordo' => 'numeric',
            'costo' => 'numeric',
            'cod_iva' => 'numeric',
            'um' => 'string',
            'categoria' => 'string',
            'note' => 'string',
            'magazzino' => 'boolean',
            'giacenza_iniziale' => 'numeric'
        ];
    }
}