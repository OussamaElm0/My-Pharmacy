<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Url;
use Livewire\Component;

class OrderQuantity extends Component
{
    #[Url(as: 'orderBy')]
    public $order ;

    public function handleOrder() {
        switch ($this->order) {
            case '':
                $this->order = 'Desc';
                break;
            case 'Desc':
                $this->order = 'Asc';
                break;
            case 'Asc':
                $this->order = '';
                break;
            default:
                return redirect()->back();
        }

        $previous = url()->previous();

        // Parse the query string to handle existing parameters
        $parsedUrl = parse_url($previous);
        $query = isset($parsedUrl['query']) ? $parsedUrl['query'] : '';
        parse_str($query, $queryParams);

        // Update or remove the orderBy parameter
        if ($this->order) {
            $queryParams['orderBy'] = $this->order;
        } else {
            unset($queryParams['orderBy']);
        }

        // Rebuild the URL with the modified query string and port
        $baseUrl = $parsedUrl['scheme'] . '://'
                . $parsedUrl['host'] . ':' . $parsedUrl['port'] . $parsedUrl['path'];
        $queryString = http_build_query($queryParams);
        $url = $baseUrl . ($queryString ? "?$queryString" : '');

        return redirect()->to($url);
    }


    public function render()
    {
        return view('livewire.order-quantity');
    }
}
