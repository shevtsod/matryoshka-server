@extends('layouts.app')

@section('title', $group->name)

@section('html')
<div id="page-groups-show" class="page-content page-content-groups">
    <div class="mdc-layout-grid page-content-item">
        {{-- Controls --}}
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1">
                @button([
                    'classes' => 'mdc-button mdc-button--outlined',
                    'onClick' => 'window.history.back()'
                ])
                    Back
                @endbutton
            </div>

            {{-- Divider --}}
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10-desktop mdc-layout-grid__cell--span-6-tablet
            mdc-layout-grid__cell--span-2-phone"></div>

            @if(Auth::user() && ($group->owner_id == Auth::user()->id || Auth::user()->isAdmin()))
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1">
                    @linkbutton([
                        'id' => 'group-edit',
                        'classes' => 'mdc-button mdc-button--outlined',
                        'href' => '/groups/' . $group->id . '/edit'
                    ])
                        Edit
                    @endlinkbutton
                </div>
            @endif
        </div>
    </div>

    <div class="mdc-layout-grid page-content-item">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                <div class="mdc-card group-card">
                    <div class="card-content text-center" tabindex="0">
                        <h2 class="mdc-typography--headline3">
                            {{ $group->name }}
                        </h2>

                        <h3 class="mdc-typography--headline5">
                            <span>By </span>
                            <a
                                class="block-link creator-link"
                                href="/users/{{ $group->owner->id ?? 'N/A' }}"
                            >
                                <img
                                    class="user-menu-icon"
                                    src="/storage/{{ $group->owner->avatar ?? 'users/default.png' }}"
                                    height="35px"
                                    width="auto"
                                    align="top"
                                />

                                {{ $group->owner->name ?? 'N/A' }}
                            </a>
                        </h3>

                        @if($group->isMember(Auth::user()))
                            <h3 class="mdc-typography--body2">
                                You are a member of this group
                            </h3>
                        @endif

                        <div class="mdc-card__actions">
                            <form method="POST" action="/groups/{{ $group->id }}/toggle_member/{{ Auth::user()->id }}">
                                @csrf
                                <button class="mdc-button mdc-button--raised submit" type="submit">
                                    <span class="mdc-button__label">
                                        @if(!Auth::user()->groups()->find($group->id))
                                            Join group
                                        @else
                                            Leave group
                                        @endif
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mdc-layout-grid page-content-item">
        <h1 class="page-title mdc-typography--headline4 text-center">
            Android Apps ({{ $group->androidApps->count() }})
        </h1>
    </div>

    <div class="mdc-layout-grid page-content-item">
        <div class="mdc-layout-grid__inner">
            @if ($androidApps->isEmpty())
                <h2 class="mdc-typography--headline6 text-center mdc-layout-grid__cell--span-12">
                    There are no apps under this group.
                </h2>
            @endif

            @foreach ($androidApps as $androidApp)
                @component('resources.android_apps.partials.card', [
                    'androidApp' => $androidApp
                ])
                @endcomponent
            @endforeach
        </div>
    </div>

    @if($group->owner_id == Auth::user()->id)
        <div class="mdc-layout-grid page-content-item">
            <h1 class="page-title mdc-typography--headline4 text-center">
                Users ({{ $group->users->count() }})
            </h1>
        </div>

        <div class="mdc-layout-grid page-content-item">
            <div class="mdc-layout-grid__inner">
                @if ($users->isEmpty())
                    <h2 class="mdc-typography--headline6 text-center mdc-layout-grid__cell--span-12">
                        There are no users under this group.
                    </h2>
                @endif

                <ul class="mdc-list mdc-layout-grid__cell--span-12">
                    @foreach ($users as $user)
                        <li class="mdc-list-item" tabindex="0">
                            <a
                                    class="block-link user-link"
                                    href="/users/{{ $user->id }}"
                            >
                                <img
                                    class="mdc-list-item__graphic user-menu-icon"
                                    src="/storage/{{ $user->avatar }}"
                                    height="35px"
                                    width="auto"
                                    align="top"
                                />

                                <span class="mdc-list-item__text">{{ $user->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
@endsection
