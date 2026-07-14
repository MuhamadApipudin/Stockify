import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Catatan: Flowbite sudah dimatikan lewat import di app.js.
// Namun komponen UI seperti sidebar collapse membutuhkan JS.
// Supaya fitur sidebar CRUD tetap bisa dibuka, kita aktifkan kembali Flowbite.
import 'flowbite';


