<p>Ola, {{ $solicitacao->nome }}</p>

<p>Muito obrigado pela sua solicitação para a vaga de {{ $solicitacao->vaga }}</p>

@if($solicitacao->aprovacao === 'aprovada')
    <p>Ficamos muito felizes em comunicar que você foi aprovado para colaborar com a Casa da Paz</p>
@else
    <p>Infelizmente a vaga para qual foi inscrito(a) já foi preenchida</p>

    <p>Mas não desanime, logo mais teremos mais oportunidades, fique atento!</p>
@endif

@if(isset($solicitacao->resposta))
    <p>{{ $solicitacao->resposta }}</p>
@endif

<p>Atenciosamente, Casa da Paz</p>
