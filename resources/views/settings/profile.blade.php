@extends('settings.index')

@section('title', 'Settings (Profile)')

@section('content.right')
    <h2>Profile</h2>

    <dl class="settings__definition-list">
        <dt>Username</dt>
        <dd>{{ Auth::user()->name }}</dd>

        <dt>Email</dt>
        <dd>{{ Auth::user()->email }}</dd>

        <dt>Avatar</dt>
        <dd><img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim( Auth::user()->email ))) }}?d=identicon" /></dd>
    </dl>
@endsection
