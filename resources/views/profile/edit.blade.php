@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4 ml-5"></h2>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="bg-white p-4 shadow rounded">
            @includeIf('profile.partials.update-profile-information-form')
        </div>

        <div class="bg-white p-4 shadow rounded">
            @includeIf('profile.partials.update-password-form')
        </div>

        <div class="bg-white p-4 shadow rounded">
            @includeIf('profile.partials.delete-user-form')
        </div>

    </div>
@endsection
