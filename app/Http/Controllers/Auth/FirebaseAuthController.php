<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\FirebaseException;

class FirebaseAuthController extends Controller
{
    protected $firebaseAuth;
    protected $firebaseStorage;

    public function __construct()
    {
        $credentialsPath = storage_path('app/firebase_credentials.json'); // Use storage_path for Laravel

        if (!file_exists($credentialsPath)) {
            throw new \Exception('Firebase credentials file does not exist at the specified path.');
        }

        $factory = (new Factory)->withServiceAccount($credentialsPath);

        $this->firebaseAuth = $factory->createAuth();
        $this->firebaseStorage = $factory->createStorage();
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        dd('Reached login method'); // This should stop execution here if the method is being called

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $signInResult = $this->firebaseAuth->signInWithEmailAndPassword($request->email, $request->password);
            $user = $this->firebaseAuth->getUser($signInResult->firebaseUserId());

            session(['user' => $user]);

            return redirect()->route('admin.dashboard');
        } catch (FirebaseException $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}