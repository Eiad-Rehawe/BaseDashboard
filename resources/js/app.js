import './bootstrap';

import Alpine from 'alpinejs';
// import '../../node_modules/laravel-datatables-vite';
// import '../../node_modules/laravel-datatables-vite/js/dataTables.buttons';
window.Alpine = Alpine;

Alpine.start();
import 'datatables.net-bs5';
// import jsZip from 'jszip';
import 'datatables.net-buttons-bs5';
import 'datatables.net-buttons/js/buttons.colVis.min';
import 'datatables.net-buttons/js/dataTables.buttons.min';
import 'datatables.net-buttons/js/buttons.flash.min';
import 'datatables.net-buttons/js/buttons.html5.min';

// This line was the one missing
// window.JSZip = jsZip;