<div class="side-menu sidebar-inverse">
   
        <a class="navbar-brand" href="{{ route('voyager.dashboard') }}">
        <img src="{{asset('img/logo.webp')}}" alt="" style="width:auto;height: 53px">
    </a>


    <div>
        <ul id="afrifan_dashboard_nav">
        <li class="{{ Request::is('admin') ? 'active' : '' }}">
                <a href="/admin">

                    <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Color-logo---no-background" transform="translate(-155.000000, -186.000000)"
                                stroke="#000000" stroke-width="2">
                                <g id="grid" transform="translate(156.000000, 187.000000)">
                                    <rect id="Rectangle" x="0" y="0" width="5.44444444" height="5.44444444"></rect>
                                    <rect id="Rectangle" x="8.55555556" y="0" width="5.44444444" height="5.44444444">
                                    </rect>
                                    <rect id="Rectangle" x="8.55555556" y="8.55555556" width="5.44444444"
                                        height="5.44444444"></rect>
                                    <rect id="Rectangle" x="0" y="8.55555556" width="5.44444444" height="5.44444444">
                                    </rect>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Tableau de bord

                </a>
            </li>
            <li class="{{ Request::is('admin/users') ? 'active' : '' }}">
                <a href="/admin/users">

                    <svg width="16px" height="13px" viewBox="0 0 16 13" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Color-logo---no-background" transform="translate(-11.000000, -172.000000)"
                                stroke="#000000" stroke-width="2">
                                <g id="users" transform="translate(12.000000, 173.000000)">
                                    <path
                                        d="M10.1818182,11 L10.1818182,9.77777778 C10.1818182,8.42774839 9.04217936,7.33333333 7.63636364,7.33333333 L2.54545455,7.33333333 C1.13963882,7.33333333 0,8.42774839 0,9.77777778 L0,11"
                                        id="Path"></path>
                                    <ellipse id="Oval" cx="5.09090909" cy="2.44444444" rx="2.54545455" ry="2.44444444">
                                    </ellipse>
                                    <path
                                        d="M14,11 L14,9.77777778 C13.9991347,8.66379418 13.2140901,7.69127345 12.0909091,7.41277778"
                                        id="Path"></path>
                                    <path
                                        d="M9.54545455,0.0794444444 C10.671764,0.356381537 11.4595366,1.33099459 11.4595366,2.4475 C11.4595366,3.56400541 10.671764,4.53861846 9.54545455,4.81555556"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Utilisateurs

                </a>
            </li>
            <li class="{{ Request::is('admin/user-verifies') ? 'active' : '' }}">
                <a href="/admin/user-verifies">

                    <svg width="16px" height="15px" viewBox="0 0 16 15" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Color-logo---no-background" transform="translate(-10.000000, -213.000000)"
                                stroke="#000000" stroke-width="2">
                                <g id="check-square" transform="translate(11.000000, 214.000000)">
                                    <polyline id="Path"
                                        points="4.42105263 5.77777778 6.63157895 7.94444444 14 0.722222222"></polyline>
                                    <path
                                        d="M13.2631579,6.5 L13.2631579,11.5555556 C13.2631579,12.3533002 12.603367,13 11.7894737,13 L1.47368421,13 C0.659790895,13 0,12.3533002 0,11.5555556 L0,1.44444444 C0,0.646699806 0.659790895,0 1.47368421,0 L9.57894737,0"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                    @php
                        $countPendingUserToverify  = App\Model\UserVerify::where('status' , '=', App\Model\UserVerify::REQUESTED_STATUS)->count();
                    @endphp
                    Vérifications 
                    @if ($countPendingUserToverify)
                        &nbsp; <span class="badge badge-primary">{{ $countPendingUserToverify}}</span>
                    @endif

                </a>
            </li>
            <li class="{{ Request::is('admin/wallets') ? 'active' : '' }}">
            <a href="/admin/wallets">

                    <svg width="16px" height="12px" viewBox="0 0 16 12" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Color-logo---no-background" transform="translate(-9.000000, -256.000000)"
                                stroke="#000000" stroke-width="2">
                                <g id="credit-card" transform="translate(10.000000, 257.000000)">
                                    <rect id="Rectangle" x="0" y="0" width="14" height="10" rx="2"></rect>
                                    <line x1="0" y1="3.75" x2="14" y2="3.75" id="Path"></line>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Soldes

                </a>
            </li>
            <li class="{{ Request::is('admin/user-messages') ? 'active' : '' }}">

            <a href="/admin/user-messages">

                    <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Color-logo---no-background" transform="translate(-10.000000, -295.000000)"
                                stroke="#000000" stroke-width="2">
                                <g id="message-square" transform="translate(11.000000, 296.000000)">
                                    <path
                                        d="M14,9.33333333 C14,10.1924429 13.3035541,10.8888889 12.4444444,10.8888889 L3.11111111,10.8888889 L0,14 L0,1.55555556 C0,0.696445945 0.696445945,0 1.55555556,0 L12.4444444,0 C13.3035541,0 14,0.696445945 14,1.55555556 L14,9.33333333 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Messages

                </a>
            </li>
            <li class="{{ Request::is('admin/reactions') ? 'active' : '' }}">
                <a href="/admin/reactions">

                    <svg width="16px" height="15px" viewBox="0 0 16 15" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Color-logo---no-background" transform="translate(-11.000000, -337.000000)"
                                stroke="#000000" stroke-width="2">
                                <g id="book-open" transform="translate(12.000000, 338.000000)">
                                    <path
                                        d="M0,0 L4.2,0 C5.7463973,0 7,1.29339961 7,2.88888889 L7,13 C7,11.803383 6.05979797,10.8333333 4.9,10.8333333 L0,10.8333333 L0,0 Z"
                                        id="Path"></path>
                                    <path
                                        d="M14,0 L9.8,0 C8.2536027,0 7,1.29339961 7,2.88888889 L7,13 C7,11.803383 7.94020203,10.8333333 9.1,10.8333333 L14,10.8333333 L14,0 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Activités

                </a>
            </li>
            <li class="{{ Request::is('admin/user-list-members') ? 'active' : '' }}">
                <a href="/admin/user-list-members">

                    <svg width="16px" height="18px" viewBox="0 0 16 18" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Color-logo---no-background" transform="translate(-11.000000, -373.000000)"
                                stroke="#000000" stroke-width="2">
                                <g id="user" transform="translate(12.000000, 374.000000)">
                                    <path
                                        d="M14,16 L14,14.2222222 C14,12.2585431 12.4329966,10.6666667 10.5,10.6666667 L3.5,10.6666667 C1.56700338,10.6666667 0,12.2585431 0,14.2222222 L0,16"
                                        id="Path"></path>
                                    <ellipse id="Oval" cx="7" cy="3.55555556" rx="3.5" ry="3.55555556"></ellipse>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Membres

                </a>
            </li>
            <li class="{{ Request::is('admin/user-reports') ? 'active' : '' }}">
            <a href="/admin/user-reports">

                    <svg width="16px" height="18px" viewBox="0 0 16 18" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Color-logo---no-background" transform="translate(-9.000000, -417.000000)"
                                stroke="#000000" stroke-width="2">
                                <g id="flag" transform="translate(10.000000, 418.000000)">
                                    <path
                                        d="M0.823529412,10.4 C0.823529412,10.4 1.64705882,9.6 4.11764706,9.6 C6.58823529,9.6 8.23529412,11.2 10.7058824,11.2 C13.1764706,11.2 14,10.4 14,10.4 L14,0.8 C14,0.8 13.1764706,1.6 10.7058824,1.6 C8.23529412,1.6 6.58823529,0 4.11764706,0 C1.64705882,0 0.823529412,0.8 0.823529412,0.8 L0.823529412,10.4 Z"
                                        id="Path"></path>
                                    <line x1="0.823529412" y1="16" x2="0.823529412" y2="10.4" id="Path"></line>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Signalements

                </a>
            </li>
            <li class="{{ Request::is('admin/user-posts') ? 'active' : '' }}">
            <a href="/admin/user-posts">

                    <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Color-logo---no-background" transform="translate(-9.000000, -459.000000)"
                                stroke="#000000" stroke-width="2">
                                <g id="image" transform="translate(10.000000, 460.000000)">
                                    <rect id="Rectangle" x="0" y="0" width="14" height="14" rx="2"></rect>
                                    <circle id="Oval" cx="4.27777778" cy="4.27777778" r="1.16666667"></circle>
                                    <polyline id="Path" points="14 9.33333333 10.1111111 5.44444444 1.55555556 14">
                                    </polyline>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Publications

                </a>
            </li>
            <li class="{{ Request::is('admin/post-comments') ? 'active' : '' }}">
                <a href="/admin/post-comments">

                    <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Color-logo---no-background" transform="translate(-10.000000, -498.000000)"
                                stroke="#000000" stroke-width="2">
                                <g id="message-circle" transform="translate(11.000000, 499.000000)">
                                    <path
                                        d="M14.0000222,6.61111111 C14.0026765,7.63767497 13.7628313,8.65035467 13.3,9.56666667 C12.180746,11.8061438 9.89248362,13.2212535 7.38888889,13.2222222 C6.36232503,13.2248988 5.34964533,12.9850536 4.43333333,12.5222222 L0,14 L1.47777778,9.56666667 C1.01494644,8.65035467 0.775101248,7.63767497 0.777777778,6.61111111 C0.778746545,4.10751638 2.19385617,1.81925401 4.43333333,0.7 C5.34964533,0.237168665 6.36232503,-0.00267652949 7.38888889,-2.21574128e-05 L7.77777778,-2.21574128e-05 C11.1345184,0.185188648 13.8148114,2.86548156 14.0000222,6.22222222 L14.0000222,6.61111111 L14.0000222,6.61111111 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Commentaires

                </a>
            </li>
            <li class="{{ Request::is('admin/user-bookmarks') ? 'active' : '' }}">
            <a href="/admin/user-bookmarks">

                    <svg width="16px" height="14px" viewBox="0 0 16 14" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Color-logo---no-background" transform="translate(-11.000000, -540.000000)"
                                stroke="#000000" stroke-width="2">
                                <g id="heart" transform="translate(12.000000, 541.000000)">
                                    <path
                                        d="M12.6254545,1.01684211 C11.9690301,0.365047243 11.0785424,-0.00115302391 10.15,-0.00115302391 C9.22145762,-0.00115302391 8.33096994,0.365047243 7.67454545,1.01684211 L7,1.68631579 L6.32545455,1.01684211 C4.95829875,-0.340034288 2.74170127,-0.340034271 1.37454549,1.01684214 C0.00738971148,2.37371856 0.00738969497,4.57364988 1.37454545,5.93052632 L2.04909091,6.6 L7,11.5136842 L11.9509091,6.6 L12.6254545,5.93052632 C13.2821872,5.27903735 13.6511618,4.39524507 13.6511618,3.47368421 C13.6511618,2.55212335 13.2821872,1.66833107 12.6254545,1.01684211 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Favoris

                </a>
            </li>
            <li class="{{ Request::is('admin/subscriptions') ? 'active' : '' }}">
            <a href="/admin/subscriptions">

                    <svg width="16px" height="18px" viewBox="0 0 16 18" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Color-logo---no-background" transform="translate(-11.000000, -580.000000)"
                                stroke="#000000" stroke-width="2">
                                <g id="shopping-bag" transform="translate(12.000000, 581.000000)">
                                    <path
                                        d="M2.33333333,0 L0,3.2 L0,14.4 C0,15.2836556 0.696445945,16 1.55555556,16 L12.4444444,16 C13.3035541,16 14,15.2836556 14,14.4 L14,3.2 L11.6666667,0 L2.33333333,0 Z"
                                        id="Path"></path>
                                    <line x1="0" y1="3.2" x2="14" y2="3.2" id="Path"></line>
                                    <path
                                        d="M10.1111111,6.4 C10.1111111,8.1673112 8.71821922,9.6 7,9.6 C5.28178078,9.6 3.88888889,8.1673112 3.88888889,6.4"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Abonnements

                </a>
            </li>
            <li class="{{ Request::is('admin/transactions') ? 'active' : '' }}">

            <a href="/admin/transactions">

                    <svg width="16px" height="19px" viewBox="0 0 16 19" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Color-logo---no-background" transform="translate(-11.000000, -619.000000)"
                                stroke="#000000" stroke-width="2">
                                <g id="repeat" transform="translate(12.000000, 620.000000)">
                                    <polyline id="Path" points="10.8888889 0 14 3.09090909 10.8888889 6.18181818">
                                    </polyline>
                                    <path
                                        d="M0,7.72727273 L0,6.18181818 C0,4.47475623 1.39289189,3.09090909 3.11111111,3.09090909 L14,3.09090909"
                                        id="Path"></path>
                                    <polyline id="Path" points="3.11111111 17 0 13.9090909 3.11111111 10.8181818">
                                    </polyline>
                                    <path
                                        d="M14,9.27272727 L14,10.8181818 C14,12.5252438 12.6071081,13.9090909 10.8888889,13.9090909 L0,13.9090909"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Transactions

                </a>
            </li>
            <li class="d-none">
                <a href="/admin/payment-requests">

                    <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Color-logo---no-background" transform="translate(-9.000000, -661.000000)"
                                stroke="#000000" stroke-width="2">
                                <g id="send" transform="translate(10.000000, 662.000000)">
                                    <line x1="14" y1="0" x2="6.3" y2="7.7" id="Path"></line>
                                    <polygon id="Path" points="14 0 9.1 14 6.3 7.7 0 4.9"></polygon>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Paiements

                </a>
            </li>
            <li class="{{ Request::is('admin/withdrawals') ? 'active' : '' }}">

            <a href="/admin/withdrawals">

                    <svg width="16px" height="20px" viewBox="0 0 16 20" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Color-logo---no-background" transform="translate(-11.000000, -700.000000)"
                                stroke="#000000" stroke-width="2">
                                <g id="file" transform="translate(12.000000, 701.000000)">
                                    <path
                                        d="M7.875,0 L1.75,0 C0.783501688,0 0,0.80588745 0,1.8 L0,16.2 C0,17.1941125 0.783501688,18 1.75,18 L12.25,18 C13.2164983,18 14,17.1941125 14,16.2 L14,6.3 L7.875,0 Z"
                                        id="Path"></path>
                                    <polyline id="Path" points="7.875 0 7.875 6.3 14 6.3"></polyline>
                                </g>
                            </g>
                        </g>
                    </svg>
                    @php
                        $counWithdrawalRequested  = App\Model\Withdrawal::where('status' , '=', App\Model\Withdrawal::REQUESTED_STATUS)->count();
                    @endphp
                    Retraits 
                    @if ($counWithdrawalRequested)
                        &nbsp; <span class="badge badge-primary">{{ $counWithdrawalRequested}}</span>
                    @endif

                </a>
            </li>
           
            <li class="{{ Request::is('admin/contact-messages') ? 'active' : '' }}">
            <a href="/admin/contact-messages">

                    <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Color-logo---no-background" transform="translate(-12.000000, -785.000000)"
                                stroke="#000000" stroke-width="2">
                                <g id="help-circle" transform="translate(13.000000, 786.000000)">
                                    <circle id="Oval" cx="7" cy="7" r="7"></circle>
                                    <path
                                        d="M4.963,4.9 C5.30280581,3.93403111 6.28976853,3.35398443 7.29902342,3.52709847 C8.3082783,3.70021252 9.04552555,4.57600705 9.04400236,5.6 C9.04400236,7 6.944,7.7 6.944,7.7"
                                        id="Path"></path>
                                    <line x1="7" y1="10.5" x2="7.007" y2="10.5" id="Path"></line>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Supports

                </a>
            </li>
            <li class="{{ Request::is('admin/settings') ? 'active' : '' }}">
                <a href="/admin/settings">

                    <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Color-logo---no-background" transform="translate(-12.000000, -825.000000)"
                                stroke="#000000" stroke-width="2">
                                <g id="settings" transform="translate(13.000000, 826.000000)">
                                    <circle id="Oval" cx="7" cy="7" r="1.90909091"></circle>
                                    <path
                                        d="M11.7090909,8.90909091 C11.5357795,9.30178459 11.6189399,9.76042662 11.9190909,10.0672727 L11.9572727,10.1054545 C12.1962617,10.3441778 12.3305467,10.6681155 12.3305467,11.0059091 C12.3305467,11.3437027 12.1962617,11.6676404 11.9572727,11.9063636 C11.7185495,12.1453526 11.3946118,12.2796376 11.0568182,12.2796376 C10.7190246,12.2796376 10.3950869,12.1453526 10.1563636,11.9063636 L10.1181818,11.8681818 C9.81133571,11.5680308 9.35269368,11.4848704 8.96,11.6581818 C8.57533689,11.8230435 8.32530549,12.2005909 8.32363636,12.6190909 L8.32363636,12.7272727 C8.32363636,13.4301806 7.75381695,14 7.05090909,14 C6.34800123,14 5.77818182,13.4301806 5.77818182,12.7272727 L5.77818182,12.67 C5.76809966,12.2389723 5.49555476,11.8579142 5.09090909,11.7090909 C4.69821541,11.5357795 4.23957338,11.6189399 3.93272727,11.9190909 L3.89454545,11.9572727 C3.65582222,12.1962617 3.3318845,12.3305467 2.99409091,12.3305467 C2.65629732,12.3305467 2.3323596,12.1962617 2.09363636,11.9572727 C1.8546474,11.7185495 1.72036244,11.3946118 1.72036244,11.0568182 C1.72036244,10.7190246 1.8546474,10.3950869 2.09363636,10.1563636 L2.13181818,10.1181818 C2.43196919,9.81133571 2.51512956,9.35269368 2.34181818,8.96 C2.17695655,8.57533689 1.79940913,8.32530549 1.38090909,8.32363636 L1.27272727,8.32363636 C0.569819409,8.32363636 0,7.75381695 0,7.05090909 C0,6.34800123 0.569819409,5.77818182 1.27272727,5.77818182 L1.33,5.77818182 C1.76102766,5.76809966 2.1420858,5.49555476 2.29090909,5.09090909 C2.46422047,4.69821541 2.3810601,4.23957338 2.08090909,3.93272727 L2.04272727,3.89454545 C1.80373831,3.65582222 1.66945335,3.3318845 1.66945335,2.99409091 C1.66945335,2.65629732 1.80373831,2.3323596 2.04272727,2.09363636 C2.28145051,1.8546474 2.60538823,1.72036244 2.94318182,1.72036244 C3.28097541,1.72036244 3.60491313,1.8546474 3.84363636,2.09363636 L3.88181818,2.13181818 C4.18866429,2.43196919 4.64730632,2.51512956 5.04,2.34181818 L5.09090909,2.34181818 C5.47557221,2.17695655 5.72560361,1.79940913 5.72727273,1.38090909 L5.72727273,1.27272727 C5.72727273,0.569819409 6.29709214,0 7,0 C7.70290786,0 8.27272727,0.569819409 8.27272727,1.27272727 L8.27272727,1.33 C8.27439639,1.74850004 8.52442779,2.12604746 8.90909091,2.29090909 C9.30178459,2.46422047 9.76042662,2.3810601 10.0672727,2.08090909 L10.1054545,2.04272727 C10.3441778,1.80373831 10.6681155,1.66945335 11.0059091,1.66945335 C11.3437027,1.66945335 11.6676404,1.80373831 11.9063636,2.04272727 C12.1453526,2.28145051 12.2796376,2.60538823 12.2796376,2.94318182 C12.2796376,3.28097541 12.1453526,3.60491313 11.9063636,3.84363636 L11.8681818,3.88181818 C11.5680308,4.18866429 11.4848704,4.64730632 11.6581818,5.04 L11.6581818,5.09090909 C11.8230435,5.47557221 12.2005909,5.72560361 12.6190909,5.72727273 L12.7272727,5.72727273 C13.4301806,5.72727273 14,6.29709214 14,7 C14,7.70290786 13.4301806,8.27272727 12.7272727,8.27272727 L12.67,8.27272727 C12.2515,8.27439639 11.8739525,8.52442779 11.7090909,8.90909091 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Configurations

                </a>
            </li>

            
            <li class="{{ Request::is('/admin/attachments-modeartion') ? 'active' : '' }}">
                <a href="/admin/attachment-modeartion">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12" y2="8"></line>
                    </svg>
                    Moderations
                </a>
                <ul style="margin-left:12px">
                    <li>
                        <a href="/admin/attachment-modeartion">
                            Posts 
                        </a>
                    </li>
                    <li>
                        <a href="/admin/attachment-modeartion-presentaion-video">
                             Presenation video
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="{{ Request::is('admin/media') ? 'active' : '' }}">
                <a href="/admin/media">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
                    Photos & videos
                </a>
            </li>


        </ul>
    </div>



</div>

<style>
    #afrifan_dashboard_navbar > div > ul > li.class-full-of-rum{
        display: none;
    }

    
</style>
