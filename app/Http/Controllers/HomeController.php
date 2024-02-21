<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function token()
    {
        $clientId = Config('services.gdrive.client_id');
        $clientSecret = Config('services.gdrive.client_secret');
        $refreshToken = Config('services.gdrive.refresh_token');

        $response = Http::post('https://oauth2.googleapis.com/token', [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'refresh_token' => $refreshToken,
            'grant_type' => 'refresh_token',
        ]);

        $accessToken = json_decode((string)$response->getBody(), true)['access_token'];

        return $accessToken;
    }
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_name' => ['required'],
            'file' => ['required'],
        ]);


        $accessToken = $this->token();

        $name = Str::slug($request->file->getClientOriginalName());
        $mime = $request->file->getClientMimeType();

        dd(Storage::disk('google')->put('uploads', $request->file));


        // dd($request->file->getSize());
        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $accessToken,
        //     'Content-Type' => $mime,
        //     'Content-Length' => $request->file->getSize(),
        // ])->post('https://www.googleapis.com/drive/v3/files', [
        //     'data' => [$request->file],
        //     'mimeType' => $mime,
        //     'uploadType' => 'media',
        //     'parents' => ['1ZDaBv2Z7Lrho2HNf6S6ucLK8WQ7zY5UE'],
        //     'name' => $name
        // ]);

        // dd($response);

        // if ($response->successful()) {
        //     // return redirect()->back()->with('success', 'File uploaded successfully');
        //     return response('File uploaded successfully', 200);
        // }

        // return response('Something went wrong', 400);

        // return redirect()->back()->with('error', 'Something went wrong');
        // dd($accessToken);
    }
}
