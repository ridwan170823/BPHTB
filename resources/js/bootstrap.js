import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Pusher = Pusher;

const pusherKey = import.meta.env.VITE_PUSHER_APP_KEY;

if (pusherKey) {
    const scheme = import.meta.env.VITE_PUSHER_SCHEME ?? 'https';
    const cluster = import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1';
    const host = import.meta.env.VITE_PUSHER_HOST ?? `ws-${cluster}.pusher.com`;
    const port = Number(import.meta.env.VITE_PUSHER_PORT ?? (scheme === 'https' ? 443 : 80));

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: pusherKey,
        cluster,
        wsHost: host,
        wsPort: port,
        wssPort: port,
        forceTLS: scheme === 'https',
        enabledTransports: ['ws', 'wss'],
        withCredentials: false,
    });
} else if (!import.meta.env.PROD) {
    console.warn('Pusher broadcasting is not configured.');
}

const escapeSelector = (value) => {
    if (window.CSS && typeof window.CSS.escape === 'function') {
        return window.CSS.escape(value);
    }

    return String(value).replace(/([ !"#$%&'()*+,./:;<=>?@\[\]\\^`{|}~])/g, '\\$1');
};

const startStatuses = {
    pelayanan: 'DIAJUKAN',
    kepalaupt: 'SETUJU_PELAYANAN',
    kasubit: 'SETUJU_KEPALA_UPT',
    kabit: 'SETUJU_KASUBIT',
};

window.addEventListener('DOMContentLoaded', () => {
    if (!window.Echo) {
        return;
    }

    window.Echo.channel('pelayanan.status').listen('PelayananStatusUpdated', (event) => {
        const {
            no_urut_p: nomorUrut,
            status,
            status_label: statusLabel,
            catatan_penolakan: catatan,
        } = event;

        const rowSelector = `#pengajuanTable tbody tr[data-no-urut="${escapeSelector(nomorUrut)}"]`;
        const row = document.querySelector(rowSelector);

        if (!row) {
            return;
        }

        const statusCell = row.querySelector('[data-column="status"]');
        if (statusCell) {
            statusCell.textContent = statusLabel ?? status;
        }

        const routePrefix = row.getAttribute('data-route-prefix');
        const shouldShowStart = routePrefix && startStatuses[routePrefix] === status;

        const startWrapper = row.querySelector('[data-action="start"]');
        const decisionWrapper = row.querySelector('[data-action="decision"]');

        if (startWrapper && decisionWrapper) {
            startWrapper.classList.toggle('hidden', !shouldShowStart);
            decisionWrapper.classList.toggle('hidden', Boolean(shouldShowStart));
        }

        const catatanContainer = row.querySelector('[data-column="catatan"]');
        if (catatanContainer) {
            if (catatan) {
                catatanContainer.textContent = catatan;
                catatanContainer.classList.remove('hidden');
            } else {
                catatanContainer.textContent = '';
                catatanContainer.classList.add('hidden');
            }
        }

        row.classList.add('ring-2', 'ring-indigo-400');
        setTimeout(() => row.classList.remove('ring-2', 'ring-indigo-400'), 2000);
    });
});
