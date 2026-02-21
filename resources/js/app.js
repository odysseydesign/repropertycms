// Load axios + CSRF interceptor (from bootstrap.js)
import './bootstrap';

// Your existing feature
import 'livewire-sortable';

// Legacy fallback so old code reading window.App.csrf won't crash
window.App = window.App || {};
if (typeof window.App.csrf === 'undefined') {
  const meta = document.querySelector('meta[name="csrf-token"]');
  window.App.csrf = meta && meta.content ? meta.content : '';
}
