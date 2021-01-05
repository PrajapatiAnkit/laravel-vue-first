/*
    Defines the API route we are using.
*/
var api_url = '';
var app_url = '';
switch( process.env.MIX_APP_ENV ){
    case 'development':
        api_url = 'http://127.0.0.1:8000/api/';
        app_url = 'http://127.0.0.1:8000/';
        break;
    case 'production':
        api_url = 'https://codingbirdsonline.com/work/lara-vue/public/api/';
        app_url = 'https://codingbirdsonline.com/work/lara-vue/public/';
        break;
}

export const BASE_URL = {
    API_URL: api_url,
    APP_URL: app_url,
};
