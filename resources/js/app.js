import './bootstrap';
import Alpine from 'alpinejs';
import { initHeroScrollEngine, initScrollCanvas } from './scroll-engine';

window.Alpine = Alpine;

Alpine.store('heroScroll', { progress: 0, loaded: 0, isReady: false });
Alpine.store('aboutScroll', { progress: 0, loaded: 0, isReady: false });
Alpine.store('bespokeScroll', { progress: 0, loaded: 0, isReady: false });

Alpine.store('notifications', {
    items: [],
    add(message, type = 'info', duration = 4500) {
        const id = Date.now() + Math.random().toString(36).substring(2, 7);
        this.items.push({ id, message, type });
        if (duration > 0) {
            setTimeout(() => {
                this.remove(id);
            }, duration);
        }
    },
    remove(id) {
        this.items = this.items.filter(item => item.id !== id);
    }
});

Alpine.store('modal', {
    isOpen: false,
    title: '',
    message: '',
    type: 'alert',
    confirmLabel: 'Confirm',
    cancelLabel: 'Cancel',
    actionCallback: null,
    open(options = {}) {
        this.title = options.title || 'Notice';
        this.message = options.message || '';
        this.type = options.type || 'alert';
        this.confirmLabel = options.confirmLabel || 'Confirm';
        this.cancelLabel = options.cancelLabel || 'Cancel';
        this.actionCallback = typeof options.onConfirm === 'function' ? options.onConfirm : null;
        this.isOpen = true;
    },
    close() {
        this.isOpen = false;
        this.actionCallback = null;
    },
    confirm() {
        if (this.actionCallback) {
            this.actionCallback();
        }
        this.close();
    }
});

window.notify = (message, type = 'info', duration = 4500) => {
    Alpine.store('notifications').add(message, type, duration);
};

window.customAlert = (message, title = 'Notice') => {
    Alpine.store('modal').open({
        title,
        message,
        type: 'alert',
        confirmLabel: 'Acknowledge'
    });
};

window.customConfirm = (message, onConfirm, title = 'Confirmation Required') => {
    Alpine.store('modal').open({
        title,
        message,
        type: 'confirm',
        confirmLabel: 'Proceed',
        cancelLabel: 'Cancel',
        onConfirm
    });
};

Alpine.start();

function startScrollEngines() {
    const containers = document.querySelectorAll('[data-scroll-container]');
    if (containers.length > 0) {
        containers.forEach(el => initScrollCanvas(el));
    } else {
        initHeroScrollEngine();
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', startScrollEngines);
} else {
    startScrollEngines();
}
