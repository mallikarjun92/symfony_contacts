/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

import $ from 'jquery';
window.$ = window.jQuery = $;

//require('bootstrap');

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
//import './css/sb-admin-2.css';
//import './js/sb-admin-2';
//import 'font-awesome/css/font-awesome.css';


// start the Stimulus application
import './bootstrap';


$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    $('#contacts-table').DataTable();
    $('select[name="dataTable_length"]').addClass("custom-select custom-select-sm form-control form-control-sm");
});