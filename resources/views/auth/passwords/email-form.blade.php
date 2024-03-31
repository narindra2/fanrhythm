<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="form-group ">
        <div class="">
            <input placeholder="{{ __('E-Mail') }}" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
   

    <button type="submit" class="btn btn-primary afri_btn w-100">
         {{ __('Envoyer le lien') }}
    </button>

</form>


<p class="avez_vous avez_vous_2">
    {{__("Login Vous n’avez-pas encore un compte")}}
    <a href="{{route('register')}}" class="text-primary">{{__('Login Créer un compte')}}</a>
</p>
