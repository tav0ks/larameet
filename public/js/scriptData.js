let formData = document.getElementById('formData');
let startDate = document.getElementById('start_date')
let endDate = document.getElementById('end_date')

let datas = carregarData()

formData.addEventListener('submit', adicionarData)

function salvarData(){
    let jsonData = JSON.stringify(datas)
    localStorage.setItem("tarefas", jsonData)
}

function carregarData(){
    let jsonData = localStorage.getItem('datas')
    if (jsonData === null){
        return []
    }

    return JSON.parse(jsonData)
}

function adicionarData(event){
    event.preventDefault()

    let start_date = startDate.value
    let end_date = endDate.value

    // addicionar formatador e validador

    let novaData = {
            'start_date': start_date,
            'end_date': end_date
    }

    datas.push(novaData)

    //adicionar mostrar
    limparData()
    //adicionar salvar

    salvarData()
}

function limparData(){
    formData.reset()
}