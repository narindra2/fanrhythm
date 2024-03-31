<style>
    body,
    html,
    body.login {
        font-family: 'Poppins', sans-serif;
    }


    .voyager .side-menu.sidebar-inverse {
        background: #fff;
        border-right: 1px solid rgb(142 142 142 / 19%);
    }


    .app-container.expanded .content-container .side-menu,
    .app-container .content-container .side-menu {
        width: 250px;
        padding: 25px;
    }

    .navbar-brand {
        padding: 0px;
        font-weight: 500;
        height: auto;
        margin-bottom: 30px;
        float: none;
        display: block;
    }

    .app-container .content-container .navbar-top,
    .app-container.expanded .content-container .navbar-top,
    .app-container .side-body {
        transition: none;
    }

    #afrifan_dashboard_nav {
        padding: 0px;
        list-style: none;
    }

    #afrifan_dashboard_nav>li>a {
        font-weight: 600;
        font-size: 14px;
        color: #242529;
        letter-spacing: -0.32px;
        display: flex;
        align-items: center;
        margin-bottom: 2px;
        padding: 10px 14px;
        border-radius: 7px;
    }

    #afrifan_dashboard_nav>li.active>a {
        background: rgba(40, 160, 240, 0.12);
        color: #28A0F0;
    }

    #afrifan_dashboard_nav>li.active>a>svg g {
        stroke: #28A0F0;
    }

    #afrifan_dashboard_nav>li>a>svg {
        margin-right: 16px;
    }

    #afrifan_dashboard_navbar {
        padding: 0px 23px;
        border-bottom: 1px solid rgb(142 142 142 / 19%);
        position: fixed;
        top: 0px;
        width: calc(100% - 250px);
        left: 250px;
        height: 62px;
        background: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 1024;
    }

    .app-container.expanded .side-body,
    .app-container .side-body {
        margin-left: 250px;
        margin-right: 0px;
    }

    body>div.app-container>div>div.container-fluid {
        padding: 0px;
    }

    .hamburger {
        padding: 0px;
        width: auto;
    }
    #afrifan_dashboard_navbar>div>a,
    #afrifan_dashboard_navbar>div>a:hover,
    #afrifan_dashboard_navbar>div>a:focus {
        display: flex;
        align-items: center;
        color: inherit;
        cursor: pointer;
        text-decoration: none;
    }

    #afrifan_dashboard_navbar>div>a>img {
        width: 30px;
        height: 30px;
        border: 1px solid #eee;
        border-radius: 100%;
        margin-right: 10px;
    }

    #afrifan_dashboard_navbar>div>a>div {
        padding-right: 10px;
    }

    #afrifan_dashboard_navbar>div>a>div>div:nth-child(1) {
        font-weight: 600;
        font-size: 14px;
        color: #242529;
        letter-spacing: -0.32px;
        line-height: 14px;
        padding-top: 6px;
    }

    #afrifan_dashboard_navbar>div>a>div>div:nth-child(2) {
        font-weight:400;
        font-size: 12px;
        color: #9E9E9E;
        letter-spacing: -0.28px;
    }



    #afrifan_dashboard_navbar>div>ul {
        width: 100%;
        margin-top: 10px;
        border: 1px solid rgb(142 142 142 / 19%);
        box-shadow: none;
        padding: 10px;
    }

    #afrifan_dashboard_navbar>div>ul>li {
        padding: 0px;
        margin: 0px;
    }

    #afrifan_dashboard_navbar>div>ul>li>a>i {
        display: none;
    }

    #afrifan_dashboard_navbar>div>ul>li>a,
    #afrifan_dashboard_navbar>div>ul>li button {
        font-weight:400;
        font-size: 14px;
        letter-spacing: -0.32px;
        padding: 4px 14px;
        background: transparent;
        border: 0px;
        color: #9E9E9E;
    }

    #afrifan_dashboard_navbar>div>ul>li>a:hover,
    :hover#afrifan_dashboard_navbar>div>ul>li button:hover {
        color: #22a7f0;
    }

    .voyager,
    .app-container {
        background-color: #fff;
    }



.afrifan_card{
    background: #FFFFFF;
    border: 1px solid rgba(142,142,142,0.20);
    border-radius: 7px;
    padding: 20px;
}

.afrifan_card > div:nth-child(1){
    opacity: 0.5;
font-weight: 600;
font-size: 11px;
color: #242529;
letter-spacing: -0.25px;
margin-bottom: 10px;
}

.afrifan_card > div:nth-child(2){
    font-weight: 600;
    font-size: 22px;
    color: #242529;
    letter-spacing: -0.51px;
    margin-bottom: 10px;
}

.afrifan_card > div:nth-child(3){
    display: flex;
    align-items:center;
}

.afrifan_card > div:nth-child(3) > span:nth-child(1) {
    background: #D8E8F5;
    border-radius: 4px;
    font-weight: 600;
    font-size: 9px;
    color: #28A0F0;
    letter-spacing: -0.21px;
    display: flex;
    align-items: center;
    padding: 2px 4px;
    margin-right: 10px;
}


.afrifan_card > div:nth-child(3) > span:nth-child(1) > svg{
    margin-right: 4px;
}

.afrifan_card > div:nth-child(3) > span:nth-child(2){
    font-weight:400;
    font-size: 12px;
    color: #28A0F0;
    letter-spacing: -0.28px;
}


.afrifan_card_2{
    background: #FFFFFF;
    border: 1px solid rgba(142,142,142,0.20);
    border-radius: 7px;

}

.afrifan_chart_title {
    padding: 20px;
    height: 70px;
    border-bottom: 1px solid rgba(142,142,142,0.20);
    display: flex;
    justify-content: space-between;
}

.afrifan_canvas {
    padding: 20px 10px 20px 10px;
}

.afrifan_chart_title > div:nth-child(1){
    font-weight: 600;
    font-size: 16px;
    color: #242529;
    letter-spacing: -0.37px;
}

.afrifan_chart_title > div:nth-child(2) select {
    font-weight:400;
    font-size: 12px;
    color: #453937;
    letter-spacing: 0;
    text-align: right;
    border: 0px;
    background: transparent;
    outline: none;
    box-shadow: none;
}


html * {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.afrifan_circle_chart {
    padding: 30px 20px 2px 20px;
}

.afrifan_chart_info {
    font-weight:400;
    font-size: 14px;
    color: #242529;
    letter-spacing: -0.32px;
}

div.afrifan_chart_info > div {
    display: flex;
    align-items: center;
    margin-bottom: 2px;
    justify-content: end;
}

div.afrifan_chart_info span.chart-legend.mr-2.rounded.d-inline-block {
    display: inline-flex;
    width: 20px;
    height: 20px;
    align-items: center;
    margin-right: 10px;
}

div.afrifan_chart_info > div > div{
    display: flex;
    align-items:center;
}

div.afrifan_chart_info > div:nth-child(1){
    display: none;
}
.afrifan_chart_info {
    font-weight:400;
    font-size: 14px;
    color: #242529;
    letter-spacing: -0.32px;
    width: auto;
    margin-left: auto;
    margin-right: auto;
    padding: 20px;
}

.afrifan_chart_info .text-muted {
    display: none;
}

div.afrifan_chart_info > div > div > span:nth-child(2) {
    display: inline-block;
    width: 120px;
    font-size: 12px;
}

.voyager .panel{
    background: #FFFFFF;
    border: 1px solid rgba(142,142,142,0.20);
    border-radius: 7px;
    box-shadow:none;
}

.aff_paddin_dash {
    padding: 0px 23px;
}


.mflit {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 0px solid rgb(142 142 142 / 19%);
    margin: 0px;
}

.mflit > div {
    display: flex;
    align-items: center;
}

a.btn-add-new i,
a#bulk_delete_btn i{
    display: none;
}

a.btn-add-new {
    font-weight: 600;
    font-size: 14px;
    color: #242529;
    letter-spacing: -0.32px;
    display: flex;
    align-items: center;
    margin-bottom: 2px;
    padding: 10px 14px 10px 34px;
    border-radius: 7px;
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="%23000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>');
    background-repeat: no-repeat;
    background-position: 10px;
    background-size: 18px;
    background-color: #fff;
    border: 1px solid rgb(142 142 142 / 19%);
    border-radius: 10px;
}

a#bulk_delete_btn{
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="%23000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>'); 
    
    background-repeat: no-repeat;
    background-position: center;
    background-size: 18px;
   
    background-color: #fff;
    font-size: 0px;
    width: 42px;
    height: 42px;
    border: 1px solid rgb(142 142 142 / 19%);
    display: block;
    margin:0px 0px 0px 10px!important;
    border-radius: 10px;
}

a#bulk_delete_btn:hover,
a#bulk_delete_btn:focus{
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="%23fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>');
    background-color: #F02828;
}

a.btn-add-new:hover,
a.btn-add-new:focus{
    background-image:url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="%2328A0F0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>');
    background-color: rgba(40, 160, 240, 0.12);
    border: 1px solid  rgba(40, 160, 240, 0.12);
    color: #28A0F0;
}


.page-title {
        font-weight: 600;
        font-size: 18px;
        color: #242529;
        letter-spacing: -0.41px;
       
        display: flex;
        align-items: center;
        padding: 0px;
    }

    

.panel-bordered>.panel-body {
    padding: 0px;
    overflow: hidden;
}


.alerts {
    padding: 0px;
    position: relative;
    top: 0px;
}

#search-input {
    padding: 23px;
    border: 0px;
    border-radius: 0px;
    background-color: transparent;
    margin-bottom: 0px;
    display: flex;
    border-bottom: 1px solid rgb(142 142 142 / 19%);
    padding-bottom: 23px;
    justify-content: space-between;
    align-items: center;
}

#search-input > div:nth-child(2) {
    display: flex;
    align-items: center;
    background: #F5F5F5;
    border-radius: 8px;
    padding: 8px 10px;
    width: 220px;
}

#search-input > div:nth-child(2) > input, 
#search-input > div:nth-child(2) > button {
    font-size: 14px;
    color: #8E8E8E;
    background: transparent;
    letter-spacing: -0.32px;
    border: 0px;
    box-shadow: none;
}


#search-input > div:nth-child(2) > button {
    padding: 0px;
}

#search-input > div:nth-child(1) {
    display: flex;
}


#search-input > div:nth-child(2) > button {
    padding: 0px;
    margin: 0px;
    top: 3px;
    position: relative;
    right: -4px;
    margin-right: 12px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #000;
    line-height: 28px;
    font-weight: 600;
    font-size: 14px;
    padding-left: 0px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    right: 8px;
}

#search-input > div:nth-child(1) > div:nth-child(2){
    display: none;
}

.table-responsive {
    border: 0px solid #eaeaea;
    border-radius: 0px;
}

th a {
    color: #777!important;
    font-weight: 600!important;
}

.afrifan_login_admin {
    position: relative;
    z-index: 10;
    width: 100%;
    padding: 0px;
    top: 0px;
    margin-top: 0px;
    background: #28A0F0;
    display: flex;
    align-items: center;
    height: 100vh;
    justify-content: center;
}

 .afrifan_login_admin > div > form{
    width: 320px;
} 

.afrifan_login_admin > div > form > p{
    text-align:center;
    margin-bottom: 30px;
}

.afrifan_login_admin > div > form > input {
    font-weight:400;
    font-size: 14px;
    letter-spacing: -0.32px;
    width: 100%;
    height: 44px;
    background: #fff;
    margin-bottom: 6px;
    border: 0px;
    padding: 14px;
    border-radius: 4px;
}

body > div.afrifan_login_admin > div > form > button {
    font-weight: 600;
    font-size: 14px;
    color: #fff;
    letter-spacing: -0.32px;
    width: 100%;
    height: 42px;
    background: #ffffff2e;
    border: 0px;
    border-radius: 4px;
}

body > div.afrifan_login_admin > div > form > button:hover{
    background: #0303032e
}

body.login .alert-red {
    background: transparent;
    border-left: 0px;
    font-size: 12px;
    padding: 0px;
    text-align: center;
    margin-top: 14px;
}
body.login 
.alert.alert-red {
    max-width: 320px;
}
.afrifan_reglages {
    display: flex;
    justify-content: space-between;
}


.afrifan_reglages > div:nth-child(1) {
    width: 300px;
}

.afrifan_reglages > div:nth-child(1) > ul {
    border: 1px solid rgb(142 142 142 / 19%);
    border-radius: 10px;
    margin-right: 30px;
    width: 100%;
    padding: 0px;
    list-style: none;
}



.afrifan_reglages > div:nth-child(1) > ul > li > a {
    padding: 0px;
    list-style: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-weight: 600;
    font-size: 14px;
    color: #242529;
    letter-spacing: -0.32px;
    display: flex;
    align-items: center;
    margin-bottom: 2px;
    padding: 10px 14px;
    border-bottom: 1px solid rgb(142 142 142 / 19%);
}

.afrifan_reglages > div {
    display: flex;
    width: calc(100% - 300px);
}

.afrifan_reglages > div:nth-child(1) > ul > li.active > a{
    color: #28A0F0;
    text-decoration: none;
}

.afrifan_reglages > div:nth-child(1) > ul > li.active > a g {
     stroke: #28A0F0;
}

.afrifan_reglages > div:nth-child(2){
    border: 1px solid rgb(142 142 142 / 19%);
    border-radius: 10px;
}

.afrifan_reglages > div:nth-child(1) > ul > li:last-child a{
    border:0;
}

.tab-content>div {
    padding: 0px;
    width: 100%;
}

.afrifan_titre_reglages {
    font-weight: 600;
    font-size: 14px;
    color: #242529;
    letter-spacing: -0.32px;
    padding: 20px;
    border-bottom: 1px solid rgb(142 142 142 / 19%);
    width: 100%;
    display: block;
    margin-bottom: 20px;
}

.afrifan_setting_label {
    background: #FFFFFF;
    font-size: 10px;
    color: #8E8E8E;
    letter-spacing: -0.23px;
    text-align: center;
    display: inline-block;
    text-align: left;
    margin-bottom: 0px;
    position: absolute;
    padding: 0px 6px;
    top: 0px;
    left: 28px;
    z-index: 1000;
    position: relative;
}


.afrifan_input_type_ui {
    background: #FFFFFF;
    border: 1px solid #8E8E8E;
    border-radius: 8px;
    min-height: 55px;
    margin-bottom: 10px;
    padding-left: 14px;
    padding-right: 14px;
    display: flex;
    align-items: center;
    position: relative;
}

.afrifan_input_type_ui input[type="text"]{
    font-size: 14px;
    color: #545353;
    letter-spacing: -0.32px;
    width: 100%;
    padding: 0px;
    border: 0px;
    display: block;
    padding: 4px 0px;
    position: relative;
    top: 2px;
    outline: none;
    box-shadow: none;
}

.afrifan_form_padding {
    padding: 0 20px;
    margin-top: -10px;
}

.tab-pane > div:nth-child(2),
.afrifan_input_design{
    display: flex;
    flex-wrap: wrap;
}

.tab-pane > div:nth-child(2) > div,
.afrifan_input_design > div{
    width: 50%;
}

form.form-edit-add .afrifan_input_type_ui{
    margin-left: 20px;
    margin-right: 20px;
}

.tab-pane > div:nth-child(2) > div.afrifan_field_radio_btn,
.tab-pane > div:nth-child(2) > div.afrifan_field_checkbox{
    width: 100%;
}

#payments > div:nth-child(3){
    display: flex;
    flex-wrap: wrap;
}
#payments > div:nth-child(3) > div.afrifan_field_text{
    width: 50%;
}

#payments > div:nth-child(3) > .afrifan_field_checkbox{
    width: 100%;
}


.form-edit-add .afrifan_setting_label {
    top: 10px;
}


div#afd_site_allow_theme_switch ,
div#afd_site_allow_direction_switch,
div#afd_site_light_logo,
div#afd_site_dark_logo,
div#afd_site_favicon,
div#afd_site_default_og_image,
div#afd_site_homepage_redirect,
div#afd_site_default_site_direction,
div#afd_site_allow_language_switch,
div#afd_site_default_user_theme,
div#afd_profiles_max_profile_bio_length {
    display: none;
}

ul.radio {
    padding: 0;
    display: flex;
    padding: 0px;
}

ul.radio li .check {
    left: 0;
}

ul.radio li label{
    padding-left: 30px;
}

.afrifan_field_checkbox {
    display: flex;
    align-items: center;
    margin-bottom: 14px;
    justify-content: space-between;
    padding-top: 8px;
    margin-bottom: 8px;
}

.afrifan_field_checkbox label {
    font-weight: 600;
    font-size: 14px;
    color: #545353;
    letter-spacing: -0.28px;
    top: 0;
    left: 20px;
    padding: 0;
    margin: 0px;
}

.afrifan_field_checkbox .afrifan_input_type_ui {
    background: transparent;
    border: 0;
    border-radius: 0;
    min-height: auto;
    margin-bottom: 0px;
    padding-left: 0;
    padding-right: 0;
    display: 0;
    align-items: center;
    position: relative;
}

div#afd_site_redirect_page_after_register,
div#afd_profiles_default_users_to_follow {
    margin-bottom: 0px;
}

.toggle-group .btn, .toggle-group .btn.btn-default {
    font-size: 0;
}

.toggle.btn {
    min-width: 40px!important;
    min-height: 20px!important;
    border-radius: 10px!important;
    height: 20px!important;
    line-height: 20px!important;
}

.toggle-group .btn, .toggle-group .btn.btn-default {
    font-size: 0;
    width: 18px;
    height: 18px;
    padding: 0px;
    border-radius: 100%;
    top: 1px;
    background: #fff;
}

span.toggle-handle.btn.btn-default{
    opacity: 0;
}

.toggle.btn.btn-default.off span.toggle-handle.btn.btn-default {
    opacity: 1;
    top: -3px;
    left: 10px;
    background: #adb5bd;
    width: 18px;
    height: 18px;
}

.toggle.btn.btn-default.off {
    background-color: #fff;
    border: 1px solid #adb5bd;
}

.afrifan_field_checkbox  .afrifan_form_padding {
    padding: 0 20px;
    margin-top: 0px;
}


ul.radio li {
    border-bottom: 0px dotted #f1f1f1;
    position: relative;
    top: 1px;
}

.afrifan_field_select_dropdown .form-control {
    color: #76838f;
    background-color: #fff;
    background-image: none;
    border: 0px solid #e4eaec;
}

div#general,
div#afd_social-media_telegram_link ,
div#afd_social-media_reddit_url,
div#afd_social-media_whatsapp_url,
div#afd_social-media_tiktok_url,
div#afd_social-login_twitter_client_id,
div#afd_social-login_twitter_secret{
    display: none;
}


div#afd_security_abstract_api_key,
div#afd_security_email_abstract_api_key,
div#afd_websockets_driver {
    width: 100%;
}

div#afd_compliance_enable_age_verification_dialog,
div#afd_compliance_disable_creators_ppv_delete,
div#afd_security_enforce_email_valid_check,
div#afd_security_recaptcha_enabled,
div#afd_security_recaptcha_site_secret_key,
div#afd_emails_smtp_password,
div#afd_websockets_soketi_use_TSL,
div#afd_site_allow_pwa_installs,
div#afd_feed_feed_suggestions_card_per_page {
    margin-bottom: 20px;
}
div#afd_compliance_minimum_posts_deletion_limit {
    margin-bottom: 10px;
}

.afrifan_tab_paiement_settings {
    font-weight: 600;
    font-size: 14px;
   
    letter-spacing: -0.32px;
    margin-left: 20px;
    margin-right: 20px;
    border-bottom: 1px solid rgb(142 142 142 / 19%);
    list-style: none;
    padding-left: 0;
    display: flex;
    padding-bottom: 0px;
    margin-bottom: 20px;
}

.afrifan_tab_paiement_settings li a {
    color: #242529;
    text-decoration: none;
    position: relative;
    top: 1px;
    display: block;
    border-bottom: 2px solid transparent;
    padding-bottom: 10px;
    margin-right: 20px;
}

.afrifan_tab_paiement_settings li.active a {
    color: #28A0F0;
    border-bottom: 2px solid #28A0F0;
}


.btn-primary {
    background-image: linear-gradient(94deg, #2e8dcd 39%, #28A0F0 79%);
    color: #FFFFFF;
}
.afri_btn_2 {
    font-weight: 600;
    font-size: 14px;
    text-transform: none;
    letter-spacing: -0.32px;
    text-align: center;
    border-radius: 24px;
    display: flex;
    padding: 12px 30px;
    align-items: center;
    margin-left: auto;
    margin-top: 20px;
    border: 0px;
}


.voyager.users .actions {
    width: auto;
}

.afrifan_admin_more_drop > button {
    border: 0;
    border-radius: 6px;
    height: 39px;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
}

.afrifan_admin_more_drop .dropdown-menu {
    position: absolute;
    margin-left: -70px;
    top: -36px;
    border: 1px solid rgba(142,142,142,0.20);
    width: auto;
    min-width: auto;
}

.afrifan_admin_more_drop .dropdown-menu a {
    display: block;
    color: inherit;
    padding: 6px 20px;
    font-weight: normal!important;
    font-size: 14px;
}

#dataTable > thead > tr > th {
    opacity: .8;
    font-weight: 600;
    font-size: 11px;
    color: #242529!important;
    letter-spacing: -0.25px;
    text-transform: uppercase;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    padding: 15px 0px;
    background: #fff;
    vertical-align: middle;
}

#dataTable > thead > tr > th  a {
    color: #242529!important;
}

#dataTable > tbody > tr > td {
    text-overflow: ellipsis;
    white-space: nowrap;
    font-weight:400;
    font-size: 14px;
    color: #9E9E9E;
    letter-spacing: -0.32px;
    vertical-align: middle;
    padding: 14px 0px;
    border-top: 0px solid #ddd;
}


.afrifan_admin_more_drop {
    width: 50px;
    display: block;
    margin-left: auto;
}

.voyager.users #dataTable img {
    width: 40px!important;
    height: 40px!important;
    border-radius: 100%!important;
    border: 1px solid #eee;
}

#dataTable > thead > tr > th:nth-child(1), #dataTable > tbody > tr > td:nth-child(1) {
    padding-left: 23px;
    padding-right: 0px;
    width: 50px;
    min-width: 50px;
}


#dataTable > thead > tr > th:nth-child(2), #dataTable > tbody > tr > td:nth-child(2) {
    padding-right: 10px;
}

.afrifan_table_pagination_edit {
    display: flex;
    justify-content: space-between;
    border-top: 1px solid rgb(142 142 142 / 19%);
    padding: 23px;
    font-weight:400;
    font-size: 12px;
    color: #453937;
    letter-spacing: 0;
    text-align: right;
    align-items:center;
}

.afrifan_table_pagination_edit .show-res {
    margin-left: 0;
    margin-top: 0px;
}


.afrifan_table_pagination_edit ul.pagination {
    padding: 0px;
    margin: 0px;
}

body.voyager.users .td-2{
    color: #242529!important;

    font-weight: 600;
}

body.voyager.users .th-5,
body.voyager.users .td-5,
body.voyager.users .th-9,
body.voyager.users .th-10,
body.voyager.users .td-9,
body.voyager.users .td-10{
    display: none;
}

body.voyager.users .td-6,
body.voyager.users td.td-7{
    font-size: 0px!important;
}


body.voyager.users .td-6 .afrifan_find_badge_value-1:after,
body.voyager.users .td-7 .afrifan_find_badge_value-1:after{
    content: 'Oui';
    font-size: 14px!important;
}

body.voyager.users .td-6 .afrifan_find_badge_value-0:after,
body.voyager.users .td-7 .afrifan_find_badge_value-0:after{
    content: 'Non';
    font-size: 14px!important;
}

body.voyager.users .td-6 .afrifan_find_badge_value-1 span,
body.voyager.users .td-7 .afrifan_find_badge_value-1 span,
body.voyager.users .td-6 .afrifan_find_badge_value-0 span,
body.voyager.users .td-7 .afrifan_find_badge_value-0 span {
    background: #F02828;
    width: 8px;
    height: 8px;
    display: inline-block;
    margin-right: 8px;
    border-radius: 100%;
}

body.voyager.users .td-6 .afrifan_find_badge_value-1 span,
body.voyager.users .td-7 .afrifan_find_badge_value-1 span{
    background: #28A0F0;
}

body.voyager.users th.th-2,
body.voyager.users td.td-2  {
    overflow: hidden;
}

body.voyager.users td.td-3 > div,
body.voyager.users td.td-2 > div {
    max-width: 150px;
    display: block;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: inherit;
}

table p {
    margin: 0 0 0px;
}

body.voyager.post-comments td.td-0,
body.voyager.user-verifies td.td-0,
body.voyager.reactions td.td-0 > p,
body.voyager.user-list-members td.td-0{
    color: #242529!important;
    font-weight: 600;
}

body.voyager.post-comments #dataTable > tbody > tr > td:nth-child(1){
    padding-right: 10px;
}

body.voyager.post-comments #dataTable > tbody > tr > td:nth-child(2){
    padding-right: 30px;
}


body.voyager.post-comments  #dataTable > thead > tr > th.th-0,
body.voyager.post-comments  #dataTable > thead > tr > th.th-1,
body.voyager.post-comments  #dataTable > thead > tr > th.th-2,
body.voyager.post-comments  #dataTable > thead > tr > th.th-3{
    padding-right : 30px;
}




body.voyager.post-comments #dataTable > tbody > tr:nth-child(5) > td.td-3 {
    text-overflow: unset;
    white-space: unset;
}

body.voyager.post-comments #dataTable > tbody > tr > td.td-3, body.voyager.post-comments #dataTable > thead > tr > th.th-3 {
    max-width: 400px;
    text-overflow: unset;
    white-space: unset;
    padding-right: 30px;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 1;
    overflow: hidden;
}

.afrifan_admin_more_drop .dropdown-menu a:hover{
    color: #337ab7;
}

.toast-top-right {
    top: auto;
    right: 0;
    bottom: 0;
    width: 100%;
}

#toast-container > div,
#toast-container > div:hover,
#toast-container > div:focus{
    width: 100%;
    bottom: 0px;
    margin: 0px!important;
    font-size: 12px;
    padding: 10px;
    text-align: center;
    font-weight: 500;
    box-shadow: none!important;
    border-radius: 0px!important;
}

#toast-container>.toast-success {
    background-image: none!important;
}

.toast-success {
    background-color: #28A0F0
}

.toast-error {
    background-color: #F02828
}

.toast-info {
    background-color: #28A0F0
}

.toast-warning {
    background-color: #28A0F0
}

.select2-container--default .select2-selection--single {
    border-right: 0px solid #f1f1f1!important;
}

.panel-edit_afrifan {
    padding-top: 6px;
    padding-bottom: 20px;
    border: 1px solid rgb(142 142 142 / 19%);
    border-radius: 10px;
}

.afrifan_footer_button{

}

.afrifan_input_type_ui p {
    margin: 0px;
}


.select2-container--default.select2-container--focus .select2-selection--multiple ,
.select2-container--default .select2-selection--multiple {
    border: 0!important;
}

.afrifan_input_type_ui br,
.afrifan_input_type_ui small{
    display: none;
}
  
.afrifan_input_type_ui .form-control {
    border: 0px solid #e4eaec;
}

body.voyager.user-messages td.td-2,
body.voyager.user-posts td.td-2 {
    display: block;
    max-width: 200px;
    overflow: hidden;
}

div#afd_payments_withdrawal_allow_only_for_verified {
    margin-bottom: 30px;
}

</style>
