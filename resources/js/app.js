import '../css/navbar-ocean-fresh.css';
import '../css/auth.css';
import * as bootstrap from 'bootstrap';
import './search.js';

window.bootstrap = bootstrap;

// ── Game page: live invoice update ──────────────────────────────────────────
function updateInvoice() {
    const idField = document.querySelector('.game-id-field');
    if (idField) {
        document.getElementById('inv-id').textContent = idField.value.trim() || '———';
    }

    const selectedDetail = document.querySelector('input[name="detail_id"]:checked');
    document.getElementById('inv-item').textContent  = selectedDetail ? selectedDetail.dataset.name  : '———';
    document.getElementById('inv-total').textContent = selectedDetail ? selectedDetail.dataset.price : '———';

    const selectedPayment = document.querySelector('input[name="payment_method"]:checked');
    document.getElementById('inv-payment').textContent = selectedPayment ? selectedPayment.dataset.full : '———';
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('input[name="detail_id"]').forEach(el => el.addEventListener('change', updateInvoice));
    document.querySelectorAll('input[name="payment_method"]').forEach(el => el.addEventListener('change', updateInvoice));
    document.querySelectorAll('.game-id-field').forEach(el => el.addEventListener('input', updateInvoice));
});
