<h1>Olá, {{ $nome }}</h1>

<p>Obrigado por sua solicitação sobre a vaga {{ $vaga }}.</p>

@if($aprovacao === 'aprovada')
    <p>Estamos muito felizes em te dizer que a sua solicitação foi aprovada!</p>
    <p>Para darmos continuidade, precisamos que você compareça à casa da paz pessoalmente com os seus documentos pessoais,</p>
    <p>que se encontra no endereço: Rua Mimosa, 3172, Jd. Panorama</p>
    <p>Esperamos por você!</p>
@else
    <p>Ficamos muito felizes pela sua vontade de colaborar com a casa da paz, mas infelizmente a vaga ja foi preenchida,</p>
    <p>mas fique atento, logo mais teremos mais vagas disponíveis!</p>
@endif

@if($mensagem)
    <p>Observação extra: {{ $mensagem }}</p>
@endif

<p>Atenciosamente,<br>Equipe</p>
