<style>
    @media screen and (max-width: 769px) {
        div.aff_nav_mobile_top {
            display: none;
        }

        body {
            padding-top: 0px;
        }

        #aff_content>div.aff_gauche>p {
            display: none;
        }

        .aff_profil_tab div a {
            font-size: 0;
        }

        #aff_content>div.aff_gauche>div.aff_profil_tab>div:nth-child(1)>a {
            background-image: url('/img/live-icon.png');
            background-repeat: no-repeat;
            background-size: 24px;
            background-position: center;
        }

        #aff_content>div.aff_gauche>div.aff_profil_tab>div:nth-child(2)>a {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>');
            background-repeat: no-repeat;
            background-size: 20px;
            background-position: center;
        }


        #aff_content>div.aff_gauche>div.aff_profil_tab>div:nth-child(3)>a {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>');
            background-repeat: no-repeat;
            background-size: 20px;
            background-position: center;
        }


        #aff_content>div.aff_gauche>div.aff_profil_tab>div:nth-child(4)>a {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>');
            background-repeat: no-repeat;
            background-size: 20px;
            background-position: center;
        }


        #aff_content>div.aff_gauche>div.aff_profil_tab>div:nth-child(5)>a {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>');
            background-repeat: no-repeat;
            background-size: 20px;
            background-position: center;
        }

        #aff_content>div.aff_gauche>div.aff_profil_tab>div>a.active{
            filter: invert(1);
            background-color: #9e5c07;
        }
    }

</style>
