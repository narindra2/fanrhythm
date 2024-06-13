<div class="aff_edit_info_form">
    <p>
        {{__("Cet outil vous permettra d’analyser vos ventes afin d’optimiser vos revenus")}}
    </p>
    <div>
        <canvas id="myChart"></canvas>
    </div>
    <div class="aff_ref_link" style="padding: 0px 0px 0px 0px;">
        <div
            style="cursor: pointer;border: 0px solid var(--text-dark) ;height: 39px ; background: var(--bg-card); border-radius: 8px; height: 55px; display: flex; align-items: center; padding: 0px 42% 0px 34%">
            <input type="text" name="datetimes" />
            <span id="icon-calendar">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-calendar" viewBox="0 0 16 16">
                    <path
                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                </svg>
            </span>
        </div>
    </div>
    <div id='table-info'></div>
</div>