@if(isset($users) && $users->count())
    @foreach($users as $user)
        @include('elements.search.users-list-element', ['user' => $user])
    @endforeach

    {{ $users->links() }}
@else
    <p>{{ __('No users were found') }}</p>
@endif
