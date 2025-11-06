// ==== helpers ====
const $  = (sel, root = document) => root.querySelector(sel);
const $$ = (sel, root = document) => [...root.querySelectorAll(sel)];

function wireIataUppercase() {
  $$("#form-search [name=origin], #form-search [name=dest]").forEach(inp => {
    inp.addEventListener("input", () => {
      inp.value = inp.value.toUpperCase().replace(/[^A-Z]/g,'').slice(0,3);
    });
  });
}

function wireMinDate() {
  const d = new Date();
  const pad = n => (n<10?'0':'')+n;
  const today = `${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())}`;
  const date = $("#form-search [name=date]");
  if (date) date.min = today;
}

function wirePassengerForm() {
  const container = $("#pax-list");
  const btnAdd = $("#btn-add-pax");
  const tpl = $("#pax-item-template");
  if (!container || !btnAdd || !tpl) return;

  const reindex = () => {
    $$(".pax-item", container).forEach((row, i) => {
      row.dataset.idx = i;
      $$("input,select", row).forEach(el => {
        const key = el.getAttribute("data-key");
        el.name = `passengers[${i}][${key}]`;
      });
      const del = $(".btn-del", row);
      if (del) del.classList.toggle("d-none", $$(".pax-item", container).length === 1);
    });
  };

  btnAdd.addEventListener("click", (e) => {
    e.preventDefault();
    const clone = tpl.content.firstElementChild.cloneNode(true);
    container.appendChild(clone);
    reindex();
  });

  container.addEventListener("click", (e) => {
    if (e.target.classList.contains("btn-del")) {
      e.preventDefault();
      const row = e.target.closest(".pax-item");
      if ($$(".pax-item", container).length > 1) {
        row.remove();
        reindex();
      }
    }
  });

  reindex();
}

document.addEventListener("DOMContentLoaded", () => {
  wireIataUppercase();
  wireMinDate();
  wirePassengerForm();
});
