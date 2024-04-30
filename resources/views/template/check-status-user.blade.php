{{-- @section('scripts') --}}
    @if (auth()->check())
        <script>
            $(document).ready(function () {
            function setUserNotActifButOnline() {
                $.ajax({
                    type: 'POST',
                    data: {
                        user_id : "{{ auth()->id() }}",
                    },
                    url: "{{ url('/set-user-online-but-not-actif') }}",
                    success: function (result) {
                        
                    },
                    error: function (result) {
                    
                    }
                });
                
            }
            /** If user is not actif in a page this will be send on serve he is  stay on a page */
            setInterval(() => {
                    console.log("i m not-actif");
                    setUserNotActifButOnline();
            }, 2*60*1000); // 2 minutes
            });
        </script>
    @endif
{{-- @endsection --}}
