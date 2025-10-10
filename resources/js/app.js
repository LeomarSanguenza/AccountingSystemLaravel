import $ from 'jquery'; // Captures the default export (the jQuery function)
import 'select2';
import Alpine from 'alpinejs'

// Now, $ is the jQuery object within this file's scope
window.$ = $;
window.jQuery = $;

window.Alpine = Alpine
Alpine.start()


// You can now safely use Select2 with the imported $