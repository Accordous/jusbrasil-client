<?php

namespace Accordous\JusBrasilClient\Services\Endpoints;

use Illuminate\Support\Facades\Config;

class DossierEndpoint extends Endpoint
{
    private const BASE_URI = '/dossier';

    /**
     * @ref https://dossier-api.jusbrasil.com.br/#criando-um-novo-dossier-completo-ou-outros-produtos-post
     * @param array $attributes
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function create(array $attributes)
    {
        return $this->client()->post(self::BASE_URI, $this->validate($attributes));
    }

    /**
     * @ref https://dossier-api.jusbrasil.com.br/#criando-um-novo-dossier-completo-ou-outros-produtos-post
     * @param array $filter
     * @param array|null $exclude
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function lawsuits(array $filter, ?array $exclude = [])
    {
        return $this->client()->post(self::BASE_URI, [
            'filter' => $filter,
            'exclude' => $exclude,
            'kind' => 'LAWSUIT',
            'artifacts' => ['lawsuits'],
            'webhook_url' => Config::get('jusbrasil.webhook') ?? ''
        ]);
    }

    /**
     * @ref https://dossier-api.jusbrasil.com.br/#criando-um-novo-dossier-completo-ou-outros-produtos-get
     * @return mixed
     */
    public function list()
    {
        return $this->client()->get(self::BASE_URI);
    }

    /**
     * @ref https://dossier-api.jusbrasil.com.br/#visualizando-detalhes-de-um-dossier-get
     * @param string $dossier_id
     * @return mixed
     */
    public function detail(string $dossier_id)
    {
        return $this->client()->get(self::BASE_URI, ['dossier_id' => $dossier_id]);
    }

    /**
     * @ref https://dossier-api.jusbrasil.com.br/#cancelando-uma-busca-put
     * @param string $dossier_id
     * @return mixed
     */
    public function cancel(string $dossier_id)
    {
        return $this->client()->put(self::BASE_URI."/{$dossier_id}/cancel");
    }

    protected function rules(): array
    {
        return [
            'filter' => 'required|array',
            'kind' => 'required',
            'exclude' => 'nullable',
            'artifacts' => 'required',
            'from_date' => 'nullable',
            'to_date' => 'nullable',
            'number_of_pages' => 'nullable',
            'webhook_url' => 'required',
            'courts' => 'nullable',
        ];
    }

    protected function messages(): array
    {
        return [
            'filter' => 'Filtro é obrigatório.',
            'kind' => 'Tipo é obrigatório.',
            'artifacts' => 'Artefato é obrigatório.',
        ];
    }
}
