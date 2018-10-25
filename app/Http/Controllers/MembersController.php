<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMember;
use App\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use GuzzleHttp;

class MembersController extends Controller
{

    private const REQUEST_CLIENT_ID = '3ORggLNhOq';
    private const REQUEST_ENDPOINT = 'https://data.sportlink.com/';

    /**
     * @return View
     * @throws GuzzleHttp\Exception\GuzzleException
     */
    public function create(): View
    {
        $response = (new GuzzleHttp\Client())->request(
            'GET',
            static::REQUEST_ENDPOINT.'aanmeldenaspirantlid-form?client_id='.static::REQUEST_CLIENT_ID
        );

        if (200 !== $response->getStatusCode() &&
            false === empty($response->getBody())
        ) {
            exit;
        }

        return view('members.create', [
            'form' => json_decode($response->getBody(), true)['gegevens'],
            'required' => (new Member())->getMembersCreateRequiredFields(),
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
                if ('opmerkingen' === $key) {
                    $value = 'AVG, expliciet akkoord gegeven op: '.Carbon::now()->toDateTimeString('yyyy-MM-dd HH:mm:ss');
                }
                $url .= "&{$key}={$value}";
            }
            (new GuzzleHttp\Client())->send(
                new \GuzzleHttp\Psr7\Request(
                    'GET',
                    static::REQUEST_ENDPOINT.'aanmeldenaspirantlid?client_id='.static::REQUEST_CLIENT_ID.$url
            ));
        }
        return redirect()->route('createMemberForm')->with('success', 'Wij hebben uw aanvraag ontvangen, wij zullen u zo spoedig mogelijk benaderen om uw aanmelding definitief te maken.');
    }

}
