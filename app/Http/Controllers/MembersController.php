<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMember;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use GuzzleHttp;

class MembersController extends Controller
{

    private $clientId = '3ORggLNhOq';
    private $apiEndpoint = 'https://data.sportlink.com/';

    /**
     * @return View
     * @throws GuzzleHttp\Exception\GuzzleException
     */
    public function create(): View
    {
        $response = (new GuzzleHttp\Client())->request('GET', "{$this->apiEndpoint}aanmeldenaspirantlid-form?client_id={$this->clientId}");

        if (200 !== $response->getStatusCode() && false === empty($response->getBody())) {
            exit;
        }

        return view('members.create', [
            'form' => json_decode($response->getBody(), true)['gegevens'],
            'required' => [
                'voornaam',
                'achternaam',
                'geslacht',
                'geboortedatum',
                'huisnummer',
                'postcode',
                'email',
                'captcha',
                'captchaimagestring',
            ]
        ]);
    }

    /**
     * @param StoreMember $request
     * @throws GuzzleHttp\Exception\GuzzleException
     * @return void
     */
    public function store(StoreMember $request)
    {
        if ('production' === App::environment()) {
            $url = '';
            foreach ($request->validated() as $key => $value) {
                $url .= "&{$key}={$value}";
            }
            (new GuzzleHttp\Client())->send(new \GuzzleHttp\Psr7\Request('GET', "{$this->apiEndpoint}aanmeldenaspirantlid?client_id={$this->clientId}{$url}"));
        }
        return redirect()->route('createMemberForm')->with('success', 'Wij hebben uw aanvraag ontvangen, wij zullen u zo spoedig mogelijk benaderen om uw aanmelding definitief te maken.');
    }

}
