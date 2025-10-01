// public/js/pago.js
document.addEventListener('DOMContentLoaded', () => {
  // Radios
  const rPaypal = document.getElementById('paypal');
  const rTarjeta = document.getElementById('tarjeta');
  const rTrans  = document.getElementById('transferencia');

  // UI
  const tarjetaForm = document.getElementById('tarjeta-form');
  const transImgs   = document.getElementById('transferencia-images');
  const payBtn      = document.getElementById('pay-now');
  const form        = document.getElementById('payment-form');
  const errBox      = document.getElementById('payment-error');

  // Campos comunes
  const inputNombre   = form.querySelector('input[name="nombre"]');
  const inputEmail    = form.querySelector('input[name="email"]');
  const inputDir      = form.querySelector('input[name="direccion"]');
  const inputCiudad   = form.querySelector('input[name="ciudad"]');
  const inputCp       = form.querySelector('input[name="codigo_postal"]');
  const inputPais     = form.querySelector('input[name="pais"]');

  // Campos tarjeta
  const inputNumTar   = form.querySelector('input[name="numero_tarjeta"]');
  const inputTitular  = form.querySelector('input[name="titular"]');
  const inputCad      = form.querySelector('input[name="caducidad"]');
  const inputCvv      = form.querySelector('input[name="cvv"]');

  // Helpers
  function hideError() {
    if (!errBox) return;
    errBox.classList.remove('show');
    errBox.innerText = '';
    errBox.setAttribute('hidden', '');  // oculta a nivel atributo
    errBox.style.display = 'none';      // y a nivel estilo por si acaso
  }

  function showError(msg) {
    if (!errBox) return;
    errBox.innerText = msg;
    errBox.removeAttribute('hidden');   // quita hidden
    errBox.style.display = 'block';     // fuerza display
    errBox.classList.add('show');       // activa clase visible
    errBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }
  
  function isEmpty(el) {
    return !el || !String(el.value || '').trim();
  }
  function isValidEmail(v) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(String(v).trim());
  }
  function focusFirst(...els) {
    for (const el of els) {
      if (el && isEmpty(el)) {
        el.focus();
        return;
      }
    }
  }

  // Validación de campos comunes
  function validateCommonFields() {
    const faltan =
      isEmpty(inputNombre) ||
      isEmpty(inputEmail)  ||
      isEmpty(inputDir)    ||
      isEmpty(inputCiudad) ||
      isEmpty(inputCp)     ||
      isEmpty(inputPais);

    if (faltan) {
      showError('Faltan datos por rellenar');
      focusFirst(inputNombre, inputEmail, inputDir, inputCiudad, inputCp, inputPais);
      return false;
    }
    if (!isValidEmail(inputEmail.value)) {
      showError('Faltan datos por rellenar');
      inputEmail.focus();
      return false;
    }
    return true;
  }

  // Validación específica para tarjeta
  function validateTarjetaFields() {
    const num = (inputNumTar?.value || '').replace(/\s+/g, '');
    const cad = (inputCad?.value || '').trim();
    const cvv = (inputCvv?.value || '').trim();

    const faltan =
      isEmpty(inputNumTar) ||
      isEmpty(inputTitular) ||
      isEmpty(inputCad) ||
      isEmpty(inputCvv);

    if (faltan) {
      showError('Faltan datos por rellenar');
      focusFirst(inputNumTar, inputTitular, inputCad, inputCvv);
      return false;
    }

    // Número 13-19 dígitos
    if (!/^\d{13,19}$/.test(num)) {
      showError('Faltan datos por rellenar');
      inputNumTar.focus();
      return false;
    }
    // Caducidad MM/AA
    if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(cad)) {
      showError('Faltan datos por rellenar');
      inputCad.focus();
      return false;
    }
    // CVV 3-4 dígitos
    if (!/^\d{3,4}$/.test(cvv)) {
      showError('Faltan datos por rellenar');
      inputCvv.focus();
      return false;
    }
    return true;
  }

  // Mostrar/Ocultar secciones por método
  function updateUI() {
    hideError();

    // Tarjeta
    if (rTarjeta && rTarjeta.checked) tarjetaForm.classList.add('show');
    else tarjetaForm.classList.remove('show');

    // Transferencia (Apple/Google)
    if (rTrans && rTrans.checked) {
      transImgs.style.display = 'block';
      requestAnimationFrame(() => transImgs.classList.add('show'));
    } else {
      transImgs.classList.remove('show');
      setTimeout(() => transImgs.style.display = 'none', 300);
    }
  }

  document.querySelectorAll('input[name="metodo_pago"]').forEach(r => {
    r.addEventListener('change', updateUI);
  });
  updateUI();

  // Click en "Pagar ahora"
  payBtn.addEventListener('click', () => {
    hideError();

    // 1) Validar datos comunes
    if (!validateCommonFields()) return;

    // 2) Validar método
    const sel = document.querySelector('input[name="metodo_pago"]:checked');
    if (!sel) {
      showError('No has seleccionado ninguna opción de pago.');
      return;
    }

    // 3) Por método
    if (sel.value === 'tarjeta') {
      if (!validateTarjetaFields()) return;
      form.submit();
      return;
    }

    if (sel.value === 'paypal') {
      const paypalUrl = payBtn.dataset.paypal;
      if (!paypalUrl) {
        // Usamos el mismo mensaje genérico solicitado
        showError('Faltan datos por rellenar');
        return;
      }
      window.location.href = paypalUrl; // Va a la vista paypal.form
      return;
    }

    if (sel.value === 'transferencia') {
      form.submit();
      return;
    }

    // Fallback
    showError('Faltan datos por rellenar');
  });

  // Botones decorativos Apple/Google (evitar submit)
  document.querySelectorAll('.payment-button').forEach(btn => {
    btn.addEventListener('click', e => e.preventDefault());
  });

  // Formateo número de tarjeta (XXXX XXXX XXXX XXXX ...)
  const numberInput = document.querySelector('.card-number');
  if (numberInput) {
    numberInput.addEventListener('input', () => {
      const digits = numberInput.value.replace(/\D/g, '').slice(0, 19);
      numberInput.value = digits.replace(/(\d{4})(?=\d)/g, '$1 ').trim();
    });
  }

  // Formateo caducidad MM/AA
  const expInput = document.querySelector('input[name="caducidad"]');
  if (expInput) {
    expInput.addEventListener('input', () => {
      let v = expInput.value.replace(/\D/g, '').slice(0, 4);
      if (v.length >= 3) v = v.slice(0, 2) + '/' + v.slice(2);
      expInput.value = v;
    });
  }

  // Ocultar error al escribir
  form.querySelectorAll('input').forEach(i => {
    i.addEventListener('input', hideError);
  });
});
