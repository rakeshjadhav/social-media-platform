<?php

namespace App\Http\Controllers;

use App\Exceptions\InternalServerErrorException;
use App\Exceptions\UnauthorizedException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Psr\Http\Message\ServerRequestInterface;
use Response;
use \Laravel\Passport\Http\Controllers\AccessTokenController as ATController;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser as JwtParser;
use JetBrains\PhpStorm\ArrayShape;
use App\Services\AuthService;
use Illuminate\Http\Response as HttpResponse;
use Laravel\Passport\Client;

class AccessTokenController extends ATController
{

    public function __construct(private readonly AuthService $authService)
    {
    }

    public function login(Request $request)
    {
        try {
            if ($request) {

                $userOrgDetails = $this->authService->userLoginProcess($request->username);

                $tokenRequestData = [
                    'client_id' => $request->client_id,
                    'client_secret' => $request->client_secret,
                    'scope' => '',
                ];
                if ($request->grantType === 'refresh_token') {
                    $tokenRequestData['grant_type'] = 'refresh_token';
                    $tokenRequestData['refresh_token'] = $request->refresh_token;
                } else {
                    $tokenRequestData['grant_type'] = 'password';
                    $tokenRequestData['username'] = $request->username;
                    $tokenRequestData['password'] = $request->password;
                }

                $tokenRequest = $request->create('/oauth/token', 'POST', $tokenRequestData);
                
                $response = app()->handle($tokenRequest);
                $responseBody = json_decode($response->getContent(), true);
                if (isset($responseBody["error"])) {
                    throw new OAuthServerException('The user credentials were incorrect.', 6, 'invalid_credentials', 401);
                }
                // //add access token to user
                $userOrgDetails = collect($userOrgDetails);

                // $userOrgDetails->put('user_id', $userOrgDetails['id']);
                // $userOrgDetails->put('user_name', $userOrgDetails['name']);

                $userOrgDetails->put('token_type', $responseBody['token_type']);
                $userOrgDetails->put('expires_in', $responseBody['expires_in']);
                $userOrgDetails->put('access_token', $responseBody['access_token']);
                $userOrgDetails->put('refresh_token', $responseBody['refresh_token']);

                return response()->json(['result' => $userOrgDetails]);
            }
        } catch (OAuthServerException $e) { //password not correct..token not granted

            throw new InternalServerErrorException('The user credentials were incorrect.');
        } catch (Exception $e) {
            if ($e->getMessage() == 'The user credentials were incorrect.') {
                throw new UnauthorizedException('Your email address or password is incorrect.');
            }
            throw new InternalServerErrorException('Internal Server error');
        }
    }
}
