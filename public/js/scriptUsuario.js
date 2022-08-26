let formUsuario = document.getElementById('formUsuario');
let user = document.getElementById('user');
let tabelaPool = document.getElementById('tabelaPool');

let users = carregarUsuario();

formUsuario.addEventListener('submit', adicionarUsuario);

function salvarUsuarios(){
    let jsonUsuario = JSON.stringify(users);
    localStorage.setItem(jsonUsuario);
}

function carregarUsuario(){
    let jsonUsuario = localStorage.getItem('users');
    if(jsonUsuario === null){
        return [];
    }

    return JSON.parse('users');
    
}

function adicionarUsuario(event){
    event.preventDefault();

    let participante = user.value;

    users.push(participante);

    
    //adicionar mostrar
    limparUsuario();
    salvarUsuarios();
    
    console.log(users);
}

function limparUsuario(){
    formUsuario.reset();
}



function mostrarTarefas() {

    while (tabelaPool.childNodes.length > 0) {
      tabelaPool.removeChild(tabelaPool.childNodes[0]);
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
  
      let tdAcoes = document.createElement('td');
      
      let btnRemover = document.createElement('button');
      btnRemover.textContent = 'Remover';
      btnRemover.classList.add('btn', 'btn-danger');
      btnRemover.addEventListener('click', function() {
        tarefas.splice(i, 1);
        mostrarTarefas();
        salvarTarefas();
      });
  
      tdAcoes.appendChild(btnRemover);
  
      tr.appendChild(tdTarefa);
      tr.appendChild(tdPrazo);
      tr.appendChild(tdAcoes);
  
      tabelaPool.appendChild(tr);
    }
  }


// function injetorUsuario(event){
//     event.forEach(element => {
        
//         formUsuario.insertAdjacentHTML = `<tr><th>${element}</th></tr>`
//     });
// }
