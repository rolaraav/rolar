/* Smartresponder - скрипт для проверки введенных данных (начало) */
function SR_IsListSelected(el) {
  for (var i = 0; i < el.length; i ++)
    if (el[i].selected ||
      el[i].checked)
      return i;
  return -1;
}
function SR_trim(f) {
  return f.toString().replace(/^[ ]+/, '').replace(/[ ]+$/, '');
}
function SR_submit(f) {
  f["field_email"].value = SR_trim(f["field_email"].value);
  f["field_name_first"].value = SR_trim(f["field_name_first"].value);
  if ((SR_focus = f["field_email"]) && f["field_email"].value.replace(/^[ ]+/, '').replace(/[ ]+$/, '').length < 1 || (SR_focus = f["field_name_first"]) && f["field_name_first"].value.replace(/^[ ]+/, '').replace(/[ ]+$/, '').length < 1) { alert("Укажите значения всех обязательных для заполнения полей (помечены звездочкой)"); SR_focus.focus(); return false; }
  if (!f["field_email"].value.match(/^[\+A-Za-z0-9][\+A-Za-z0-9\._-]*[\+A-Za-z0-9_]*@([A-Za-z0-9]+([A-Za-z0-9-]*[A-Za-z0-9]+)*\.)+[A-Za-z]+$/)) { alert("Некорректный синтаксис email-адреса!"); f["field_email"].focus(); return false; } 
  if (!f["field_name_first"].value.match(/^[А-Яа-яA-Za-z]*$/)) { alert("Значение поля \"Ваше имя\" не удовлетворяет описанию: \\Буквы русского и английского алфавитов"); f["field_name_first"].focus(); return false; }
  return true;
}
/* Smartresponder - скрипт для проверки введенных данных (конец) */