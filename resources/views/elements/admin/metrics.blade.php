
<div class="metrics-container">

    <div class="row">
        <div class="col-md-3">
            <div class="afrifan_card">
                <div>
                    NOUVEAUX UTILISATEURS
                </div>
                <div>
                {{\App\Providers\DashboardServiceProvider::getLast24HoursRegisteredUsersCount()}}
                </div>
                <div>
                    <span>
                        <svg width="9px" height="10px" viewBox="0 0 9 10" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                stroke-linecap="round" stroke-linejoin="round">
                                <g id="1---Tableau-de-bord" transform="translate(-311.000000, -291.000000)"
                                    stroke="#28A0F0">
                                    <g id="Group-2" transform="translate(284.000000, 194.000000)">
                                        <g id="bar-chart-2" transform="translate(28.000000, 98.000000)">
                                            <line x1="6.8" y1="8" x2="6.8" y2="3.2" id="Path"></line>
                                            <line x1="3.6" y1="8" x2="3.6" y2="0" id="Path"></line>
                                            <line x1="0.4" y1="8" x2="0.4" y2="4.8" id="Path"></line>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>

                        {{\App\Providers\DashboardServiceProvider::getLast24HoursPostsCount()}}
                    </span>

                    <span>
                       publications aujourd'hui
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="afrifan_card">
                <div>
                    NOMBRE DE PUBLICATION
                </div>
                <div>
                {{\App\Providers\DashboardServiceProvider::getPostsCount()}}
                </div>
                <div>
                    <span>

                        <svg width="11px" height="10px" viewBox="0 0 11 10" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                stroke-linecap="round" stroke-linejoin="round">
                                <g id="1---Tableau-de-bord" transform="translate(-659.000000, -292.000000)"
                                    stroke="#28A0F0">
                                    <g id="Group-3" transform="translate(632.000000, 194.000000)">
                                        <g id="heart" transform="translate(28.000000, 99.000000)">
                                            <path
                                                d="M8.4169697,0.677894737 C7.97935337,0.243364828 7.38569492,-0.000768682608 6.76666667,-0.000768682608 C6.14763841,-0.000768682608 5.55397996,0.243364828 5.11636364,0.677894737 L4.66666667,1.12421053 L4.2169697,0.677894737 C3.3055325,-0.226689525 1.82780085,-0.226689514 0.916363661,0.677894761 C0.00492647432,1.58247904 0.00492646331,3.04909992 0.916363636,3.95368421 L1.36606061,4.4 L4.66666667,7.67578947 L7.96727273,4.4 L8.4169697,3.95368421 C8.8547915,3.51935823 9.10077451,2.93016338 9.10077451,2.31578947 C9.10077451,1.70141557 8.8547915,1.11222072 8.4169697,0.677894737 Z"
                                                id="Path"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>

                        {{\App\Providers\DashboardServiceProvider::getReactionsCount()}}
                    </span>

                    <span>
                        Réactions
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="afrifan_card">
                <div>
                    GAINS
                </div>
                <div>

                {{\App\Providers\DashboardServiceProvider::getTotalEarned()}} {{\App\Providers\SettingsServiceProvider::getWebsiteCurrencySymbol()}}

                </div>
                <div>
                    <span>

                        <svg width="9px" height="10px" viewBox="0 0 9 10" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                stroke-linecap="round" stroke-linejoin="round">
                                <g id="1---Tableau-de-bord" transform="translate(-1008.000000, -292.000000)"
                                    stroke="#28A0F0">
                                    <g id="Group-4" transform="translate(980.000000, 194.000000)">
                                        <g id="repeat" transform="translate(29.000000, 99.000000)">
                                            <polyline id="Path"
                                                points="5.12418301 0 6.58823529 1.45454545 5.12418301 2.90909091">
                                            </polyline>
                                            <path
                                                d="M0,3.63636364 L0,2.90909091 C0,2.10576764 0.655478536,1.45454545 1.46405229,1.45454545 L6.58823529,1.45454545"
                                                id="Path"></path>
                                            <polyline id="Path"
                                                points="1.46405229 8 0 6.54545455 1.46405229 5.09090909"></polyline>
                                            <path
                                                d="M6.58823529,4.36363636 L6.58823529,5.09090909 C6.58823529,5.89423236 5.93275676,6.54545455 5.12418301,6.54545455 L0,6.54545455"
                                                id="Path"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>

                        {{\App\Providers\DashboardServiceProvider::getTotalTransactionsCount()}}
                    </span>

                    <span>
                        Transactions
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="afrifan_card">
                <div>
                    ABONNEMENTS EN COURS
                </div>
                <div>
                {{\App\Providers\DashboardServiceProvider::getActiveSubscriptionsCount()}}
                </div>
                <div>
                    <span>

                        <svg width="5px" height="4px" viewBox="0 0 5 4" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                stroke-linecap="round" stroke-linejoin="round">
                                <g id="1---Tableau-de-bord" transform="translate(-1357.000000, -295.000000)"
                                    stroke="#28A0F0">
                                    <g id="Group-5" transform="translate(1328.000000, 194.000000)">
                                        <g id="shopping-bag" transform="translate(28.000000, 99.000000)">
                                            <path
                                                d="M5.05555556,3.2 C5.05555556,4.0836556 4.35910961,4.8 3.5,4.8 C2.64089039,4.8 1.94444444,4.0836556 1.94444444,3.2"
                                                id="Path"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>

                        {{\App\Providers\DashboardServiceProvider::getTotalSubscriptionsRevenue()}} {{\App\Providers\SettingsServiceProvider::getWebsiteCurrencySymbol()}}
                    </span>

                    <span>
                        de revenues
                    </span>
                </div>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="afrifan_card_2">
                @include('elements.admin.trend_card', [
                'name' => 'newUsersTrend',
                'chart' => [
                'size' => 100,
                'color_start' => 'rgba(255, 105, 220)',
                'color_stop' => 'rgba(207, 60, 172, 0.5)',
                'border_color' => 'rgba(203, 12, 159, 0.7)',
                'point_radius' => 10,
                'total' => true
                ],
                'route' => 'admin.metrics.new.users.trend',
                'size' => 'col-12 col-lg-12 mb-4',
                'title' => __('Registered users'),
                'form' => [
                'trans' => [ucfirst(trim(str_replace('1 ','',trans_choice('months', 1,['number'=>1])))),
                ucfirst(trim(str_replace('2 ','',trans_choice('months', 2,['number'=>2]))))],
                'function' => 'count',
                'unit' => 'month',
                'ranges' => [3, 6, 12],
                'range' => 12
                ]
                ])
            </div>
        </div>
        <div class="col-md-5">
            <div class="afrifan_card_2">
                @include('elements.admin.partition_card', [
                'name' => 'rolesPerUser',
                'chart' => [
                'size' => 180,
                'color' => '50, 160, 240',
                'total' => true
                ],
                'route' => 'admin.metrics.new.users.partition',
                'size' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6',
                'title' => __('Users roles'),
                'form' => [
                'function' => 'count',
                ]
                ])
            </div>
        </div>
    </div>
</div>
