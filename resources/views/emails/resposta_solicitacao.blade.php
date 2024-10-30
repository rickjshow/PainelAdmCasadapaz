<p>{!! $textosEmail['ola'] !!} {{ $solicitacao->nome }}</p>
<p>{!! $textosEmail['agradecimento'] !!} {{ $solicitacao->vaga }}</p>

@if($solicitacao->aprovacao === 'aprovada')
    <p>{!! $textosEmail['aprovacao'] !!} {{ $endereco->endereco_sede }}</p>
@else
    <p>{!! $textosEmail['recusa'] !!}</p>
@endif

@if(isset($mensagem))
    <p>{{ $mensagem }}</p>
@endif

<p>{!! $textosEmail['despedida'] !!}</p>
