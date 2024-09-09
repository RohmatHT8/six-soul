import './bootstrap';
import 'flowbite';

document.addEventListener('livewire:navigated', () => {
    window.HSStaticMethods.autoInit();
})