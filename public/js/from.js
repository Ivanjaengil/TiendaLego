// public/js/from.js
(function () {
  document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('paypal-redirect-form');
    const btn  = document.getElementById('paypal-submit-btn');
    const hint = document.getElementById('paypal-hint');

    if (!form || !btn) return;

    let submitted = false;

    const showHint = (msg) => {
      if (!hint) return;
      hint.hidden = false;
      hint.textContent = msg;
    };

    // Evita doble envío y da feedback visual
    form.addEventListener('submit', (e) => {
      if (submitted) {
        e.preventDefault();
        return;
      }
      submitted = true;
      btn.disabled = true;
      btn.setAttribute('aria-busy', 'true');
      btn.classList.add('is-loading');
      showHint('Redirigiendo a PayPal…');
    });

    // Si el usuario vuelve con el botón "Atrás" (bfcache), reactivar el botón
    window.addEventListener('pageshow', (event) => {
      if (event.persisted) {
        submitted = false;
        btn.disabled = false;
        btn.removeAttribute('aria-busy');
        btn.classList.remove('is-loading');
        if (hint) hint.hidden = true;
      }
    });

    // Aviso simple si no hay conexión antes de intentar enviar
    btn.addEventListener('click', (e) => {
      if (!navigator.onLine) {
        e.preventDefault();
        showHint('Sin conexión. Conéctate a Internet para continuar.');
      }
    });
  });
})();
