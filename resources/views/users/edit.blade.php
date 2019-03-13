@extends('statamic::layout')

@section('content')

    <user-publish-form
        action="{{ cp_route('users.update', $user->id()) }}"
        method="patch"
        :initial-fieldset="{{ json_encode($user->blueprint()->toPublishArray()) }}"
        :initial-values="{{ json_encode($values) }}"
        :initial-meta="{{ json_encode($meta) }}"
        inline-template
    >
        <div>
            <div class="flex mb-3">
                <h1 class="flex-1">
                    <a href="{{ cp_route('users.index')}}">{{ __('Users') }}</a>
                    @svg('chevron-right')
                    {{ $user->email() }}
                </h1>

                @can('editPassword', $user)
                    <change-password
                        save-url="{{ cp_route('users.password.update', $user->id()) }}"
                    ></change-password>
                @endcan

                <a href="" class="btn btn-primary ml-2" @click.prevent="save">{{ __('Save') }}</a>
            </div>

            <publish-container
                v-if="fieldset"
                name="base"
                :fieldset="fieldset"
                :values="values"
                :meta="meta"
                :errors="errors"
                @updated="values = $event"
            >
                <div slot-scope="{ }">
                    <publish-sections></publish-sections>
                </div>
            </publish-container>
        </div>
    </user-publish-form>

@endsection





