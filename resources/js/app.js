import './bootstrap';
import select2Livewire from './select2-livewire.js';

document.addEventListener('alpine:init', () => {
    Alpine.data('select2Livewire', select2Livewire);
});
