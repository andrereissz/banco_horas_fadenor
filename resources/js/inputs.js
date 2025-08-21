// utils
export const onlyDigits = (str) => str.replace(/\D+/g, '');
export const onlyAlnum = (str) => str.replace(/[^a-zA-Z0-9]+/g, '');

// ======== Digits ========
export function bindDigits(input) {
  const onInput = () => input.value = onlyDigits(input.value);
  const onKeyDown = (e) => {
    const allow = ['Backspace','Delete','ArrowLeft','ArrowRight','Home','End','Tab'];
    if (allow.includes(e.key)) return;
    if (/^\d$/.test(e.key)) return;
    e.preventDefault();
  };
  input.removeEventListener('input', input.__digitsInput);
  input.removeEventListener('keydown', input.__digitsKeydown);
  input.addEventListener('input', onInput);
  input.addEventListener('keydown', onKeyDown);
  input.__digitsInput = onInput;
  input.__digitsKeydown = onKeyDown;
}

// ======== Alnum ========
export function bindAlnum(input) {
  const onInput = () => input.value = onlyAlnum(input.value);
  input.removeEventListener('input', input.__alnumInput);
  input.addEventListener('input', onInput);
  input.__alnumInput = onInput;
}

// ======== Phone ========
export const formatPhone = (value) => {
  const v = onlyDigits(value).slice(0, 11);
  if (!v) return ''; // <-- Se não tem nada, retorna vazio
  if (v.length <= 2) return `(${v}`;
  if (v.length <= 6) return `(${v.slice(0, 2)}) ${v.slice(2)}`;
  if (v.length <= 10) return `(${v.slice(0, 2)}) ${v.slice(2, 6)}-${v.slice(6)}`;
  return `(${v.slice(0, 2)}) ${v.slice(2, 7)}-${v.slice(7)}`;
};

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


// ======== CPF ========
export const formatCpf = (value) => {
  const v = onlyDigits(value).slice(0, 11);
  if (v.length <= 3) return v;
  if (v.length <= 6) return v.replace(/(\d{3})(\d{0,3})/, '$1.$2');
  if (v.length <= 9) return v.replace(/(\d{3})(\d{3})(\d{0,3})/, '$1.$2.$3');
  return v.replace(/(\d{3})(\d{3})(\d{3})(\d{0,2})/, '$1.$2.$3-$4');
};

export function bindCpf(input) {
  const onInput = () => {
    const pos = input.selectionStart || 0;
    const old = input.value;
    input.value = formatCpf(old);
    const diff = input.value.length - old.length;
    input.setSelectionRange(Math.max(0, pos + diff), Math.max(0, pos + diff));
  };
  const onKeyDown = (e) => {
    const allow = ['Backspace','Delete','ArrowLeft','ArrowRight','Home','End','Tab'];
    if (allow.includes(e.key)) return;
    if (/^\d$/.test(e.key)) return;
    e.preventDefault();
  };
  input.removeEventListener('input', input.__cpfInput);
  input.removeEventListener('keydown', input.__cpfKeydown);
  input.addEventListener('input', onInput);
  input.addEventListener('keydown', onKeyDown);
  input.__cpfInput = onInput;
  input.__cpfKeydown = onKeyDown;
  input.value = formatCpf(input.value || '');
}

// ======== CEP ========
export const formatCep = (value) => {
  const v = onlyDigits(value).slice(0, 8);
  if (v.length <= 5) return v;
  return v.replace(/(\d{5})(\d{0,3})/, '$1-$2');
};

export function bindCep(input) {
  const onInput = () => {
    const pos = input.selectionStart || 0;
    const old = input.value;
    input.value = formatCep(old);
    const diff = input.value.length - old.length;
    input.setSelectionRange(Math.max(0, pos + diff), Math.max(0, pos + diff));
  };
  const onKeyDown = (e) => {
    const allow = ['Backspace','Delete','ArrowLeft','ArrowRight','Home','End','Tab'];
    if (allow.includes(e.key)) return;
    if (/^\d$/.test(e.key)) return;
    e.preventDefault();
  };
  input.removeEventListener('input', input.__cepInput);
  input.removeEventListener('keydown', input.__cepKeydown);
  input.addEventListener('input', onInput);
  input.addEventListener('keydown', onKeyDown);
  input.__cepInput = onInput;
  input.__cepKeydown = onKeyDown;
  input.value = formatCep(input.value || '');
}

// ======== Init ========
export function initInputs(root = document) {
  root.querySelectorAll('input[data-digits]').forEach(bindDigits);
  root.querySelectorAll('input[data-alnum]').forEach(bindAlnum);
  root.querySelectorAll('input[data-phone]').forEach(bindPhone);
  root.querySelectorAll('input[data-cpf]').forEach(bindCpf);
  root.querySelectorAll('input[data-cep]').forEach(bindCep);
}

// ======== Auto init ========
document.addEventListener('DOMContentLoaded', () => {
  initInputs(document);
});
