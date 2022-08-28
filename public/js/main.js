let formNovaTarefa = document.getElementById('novaTarefa');
let inputTarefa = document.getElementById('tarefa');
let inputPrazo = document.getElementById('prazo');
let inputId = document.getElementById('id');
let inputButton = document.getElementById('adicionarTarefa');
let tituloTarefa = document.getElementById('tituloTarefa');
let divMensagemErro = document.getElementById('mensagemErro');
let tabelaTarefas = document.getElementById('tabelaTarefas');
let tamanhoTarefas;

let tarefas = {
  id,
  tarefa,
  prazo
};

tarefas = carregarTarefas();
mostrarTarefas();

formNovaTarefa.addEventListener('submit', adicionarTarefa);

function salvarTarefas() {
  let jsonTarefas = JSON.stringify(tarefas);
  console.log(jsonTarefas);
  localStorage.setItem("tarefas", jsonTarefas);
}

function carregarTarefas() {
  let jsonTarefas = localStorage.getItem('tarefas');
  if (jsonTarefas === null) {
    return [];
  }
  tamanhoTarefas = tarefas.length;
  return JSON.parse(jsonTarefas);

}

function adicionarTarefa(event) {
  event.preventDefault();
  limparErro();
  let id = tamanhoTarefas;
  let tarefa = inputTarefa.value;
  let prazo = inputPrazo.value;

  if (!validarNovaTarefa(tarefa, prazo)) {
    return;
  }

  let novaTarefa = {
    id: id,
    'tarefa': tarefa,
    'prazo': prazo
  };


  tarefas.push(novaTarefa);

  mostrarTarefas();
  limparFormulario();
  salvarTarefas();
}

function updateTarefa(event) {
  event.preventDefault();
  let id = event.id;
  let tarefa = event.tarefa;
  let prazo = event.prazo;

  let upTarefa = {
    id: id,
    'tarefa': tarefa,
    'prazo': prazo
  };


}

//cleanForm
function limparFormulario() {
  formNovaTarefa.reset();
}


function validarNovaTarefa(tarefa, prazo) {
  if (tarefa.length === 0) {
    mostrarErro('A tarefa está em branco!');
    return false;
  }
  if (prazo.length === 0) {
    mostrarErro('O prazo está em branco!')
    return false;
  }
  return true;
}

function mostrarErro(mensagem) {
  divMensagemErro.innerHTML = mensagem;
  divMensagemErro.classList.remove('d-none');
  setTimeout(limparErro, 3000);
}

function limparErro() {
  divMensagemErro.classList.add('d-none');
}

function mostrarTarefas() {
  while (tabelaTarefas.childNodes.length > 0) {
    tabelaTarefas.removeChild(tabelaTarefas.childNodes[0]);
  }

  for (let i = 0; i < tarefas.length; i++) {
    let item = tarefas[i];
    let prazoIso = item.prazo;
    let vetorPrazo = prazoIso.split('-');
    vetorPrazo.reverse();
    let prazo = vetorPrazo.join('/');

    let tr = document.createElement('tr');
    let tdTarefa = document.createElement('td');
    tdTarefa.textContent = item.tarefa;
    let tdPrazo = document.createElement('td');
    tdPrazo.textContent = prazo;

    //botoes
    let tdAcoes = document.createElement('td');
    //deletar
    let btnRemover = document.createElement('button');
    btnRemover.textContent = 'Remover';
    btnRemover.classList.add('btn', 'btn-danger');
    btnRemover.addEventListener('click', function () {
      tarefas.splice(i, 1);
      mostrarTarefas();
      salvarTarefas();
    });

    let btnEdit = document.createElement('button');
    btnEdit.textContent = 'Editar';
    btnEdit.classList.add('btn', 'btn-primary');
    btnEdit.addEventListener('click', function () {
      let tarefa = inputTarefa.value;
      let data = inputPrazo.value;
      if (!validarNovaTarefa(tarefa, prazo)) {
        return;
      }

      tarefas[i].tarefa= tarefa ;
      tarefas[i].prazo = data;

      mostrarTarefas();
      salvarTarefas();
    });

    tdAcoes.appendChild(btnRemover);
    tdAcoes.appendChild(btnEdit);
    tr.appendChild(tdTarefa);
    tr.appendChild(tdPrazo);
    tr.appendChild(tdAcoes);

    tabelaTarefas.appendChild(tr);
  }
}