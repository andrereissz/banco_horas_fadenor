// resources/js/forms/inputs.js

// Utils
export const onlyDigits  = v => v.replace(/\D/g, '');
export const onlyAlnum   = v => v.replace(/[^0-9A-Za-zÀ-ÖØ-öø-ÿ]/g, '');
export const formatPhone = (value) => {
  const v = onlyDigits(value).slice(0, 11);
  if (v.length <= 2)  return v;
  if (v.length <= 6)  return `(${v.slice(0,2)}) ${v.slice(2)}`;
  if (v.length <= 10) return `(${v.slice(0,2)}) ${v.slice(2,6)}-${v.slice(6)}`;
  return `(${v.slice(0,2)}) ${v.slice(2,7)}-${v.slice(7)}`;
};
export const formatCpf = (value) => {
  const v = onlyDigits(value).slice(0, 11);
  if (v.length <= 3)  return v;
  if (v.length <= 6)  return v.replace(/(\d{3})(\d+)/, '$1.$2');
  if (v.length <= 9)  return v.replace(/(\d{3})(\d{3})(\d+)/, '$1.$2.$3');
  return v.replace(/(\d{3})(\d{3})(\d{3})(\d{0,2})/, '$1.$2.$3-$4');
};

// Bindings
export function bindDigits(input) {
  const onInput = () => {
    const pos = input.selectionStart || 0;
    input.value = onlyDigits(input.value);
    input.setSelectionRange(pos, pos);
  };
  const onKeyDown = (e) => {
    const allow = ['Backspace','Delete','ArrowLeft','ArrowRight','Home','End','Tab'];
    if (allow.includes(e.key)) return;
    if (!/^\d$/.test(e.key)) e.preventDefault();
  };
  input.removeEventListener('input', input.__digitsInput);
  input.removeEventListener('keydown', input.__digitsKeydown);
  input.addEventListener('input', onInput);
  input.addEventListener('keydown', onKeyDown);
  input.__digitsInput = onInput;
  input.__digitsKeydown = onKeyDown;
  input.value = onlyDigits(input.value || '');
}

export function bindAlnum(input) {
  const onInput = () => {
    const pos = input.selectionStart || 0;
    input.value = onlyAlnum(input.value);
    input.setSelectionRange(pos, pos);
  };
  input.removeEventListener('input', input.__alnumInput);
  input.addEventListener('input', onInput);
  input.__alnumInput = onInput;
  input.value = onlyAlnum(input.value || '');
}

export function bindPhone(input) {
  const onInput = () => {
    const pos = input.selectionStart || 0;
    const old = input.value;
    input.value = formatPhone(old);
    const diff = input.value.length - old.length;
    input.setSelectionRange(Math.max(0, pos + diff), Math.max(0, pos + diff));
  };
  const onKeyDown = (e) => {
    const allow = ['Backspace','Delete','ArrowLeft','ArrowRight','Home','End','Tab'];
    if (allow.includes(e.key)) return;
    if (/^\d$/.test(e.key)) return;
    e.preventDefault();
  };
  input.removeEventListener('input', input.__phoneInput);
  input.removeEventListener('keydown', input.__phoneKeydown);
  input.addEventListener('input', onInput);
  input.addEventListener('keydown', onKeyDown);
  input.__phoneInput = onInput;
  input.__phoneKeydown = onKeyDown;
  input.value = formatPhone(input.value || '');
}

// Inicializador
export function initInputs(root = document) {
  root.querySelectorAll('input[data-digits]').forEach(bindDigits);
  root.querySelectorAll('input[data-alnum]').forEach(bindAlnum);
  root.querySelectorAll('input[data-phone]').forEach(bindPhone);
}

// Auto-boot + Livewire
document.addEventListener('DOMContentLoaded', () => initInputs());
document.addEventListener('livewire:load', () => {
  if (window.Livewire?.hook) {
    Livewire.hook('message.processed', (component, el) => initInputs(el || document));
  }
});
