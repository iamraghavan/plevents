<div id="g_id_onload"
     data-client_id="379483365701-5uvdh4b1g88mdsu16ng3u29j1ru7i6es.apps.googleusercontent.com"
     data-login_uri="http://localhost/plevents/public/auth/google/callback"
     data-auto_prompt="true">
</div>

<script src="https://accounts.google.com/gsi/client" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/jwt-decode@2.2.0/build/jwt-decode.min.js"></script>

<script>
    // Initialize Google Sign-In
    function initializeGoogleSignIn() {
        google.accounts.id.initialize({
            client_id: '379483365701-5uvdh4b1g88mdsu16ng3u29j1ru7i6es.apps.googleusercontent.com',
            callback: handleCredentialResponse,
            auto_select: true
        });
        google.accounts.id.prompt(); // Show the One Tap prompt
    }

    function handleCredentialResponse(response) {
        const credential = response.credential;
        const payload = JSON.parse(atob(credential.split('.')[1]));

        // Extract user details
        const googleUid = payload.sub;
        const firstName = payload.given_name;
        const lastName = payload.family_name;
        const email = payload.email;
        const profilePicture = payload.picture;

        // Send the extracted details to the backend
        fetch('{{ route('google.callback') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                google_uid: googleUid,
                first_name: firstName,
                last_name: lastName,
                email: email,
                profile_picture: profilePicture
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log('User logged in successfully:', data);
            // Redirect to a specific route or handle the response as needed
        })
        .catch(error => {
            console.error('Error logging in:', error);
        });
    }

    // Defer the initialization of Google Sign-In until the script is fully loaded
    window.onload = function() {
        initializeGoogleSignIn();
    };
</script>
