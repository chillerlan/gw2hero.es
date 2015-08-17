@extends('search.results')

@section('content.right')
    <h2>Accounts matching "{{ $searchTerm }}"</h2>
    <ul>
        @foreach($accounts as $account)
            <li><a href={{ action('AccountController@getIndex', $account->getActionData()) }}>
                    {{ $account->getNameHtml() }}
            </a></li>
        @endforeach
    </ul>
@endsection
