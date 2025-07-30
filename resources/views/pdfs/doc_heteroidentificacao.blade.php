@php
    use Illuminate\Support\Carbon;
    $data = Carbon::now();
@endphp
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Documento de Heteroidentificação</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            color: #1a202c;
            margin: 40px;
        }
        .container {
            max-width: 700px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            font-weight: bold;
            font-size: 20px;
        }
        p {
            margin-bottom: 10px;
            text-align: justify;
        }
        .checkbox {
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }
        .checkbox input {
            margin-right: 8px;
            width: 16px;
            height: 16px;
        }
        .center {
            text-align: center;
        }
        .signature-space {
            margin-top: 60px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>AUTODECLARAÇÃO ÉTNICO-RACIAL</h2><br>

        <p>Eu, ___________________________________, inscrito no CPF sob o nº ________________,</p>
        <p>AUTODECLARO, sob as penas da lei, minha raça/etnia sendo:</p><br>

        <div class="checkbox">
            <input type="checkbox" id="etnia_branca" name="etnia_branca" value="1">
            <label for="etnia_branca">Branca</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="etnia_preta" name="etnia_preta" value="1">
            <label for="etnia_preta">Preta</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="etnia_parda" name="etnia_parda" value="1">
            <label for="etnia_parda">Parda</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="etnia_amarela" name="etnia_amarela" value="1">
            <label for="etnia_amarela">Amarela</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="etnia_indigena" name="etnia_indigena" value="1">
            <label for="etnia_indigena">Indígena</label>
        </div>

        <br>

        <p>Esta autodeclaração atende à exigência do art. 39, § 8º, da Lei nº 12.288/2010,
        alterado pela Lei nº 14.553/2023 e da Portaria MTE nº 3.784/2023, que obriga a
        prestação da informação nas inclusões, alterações ou retificações cadastrais dos
        trabalhadores ocorridas a partir de 1º de janeiro de 2024, respeitando o critério de
        autodeclaração do trabalhador, em conformidade com a classificação utilizada pelo
        Instituto Brasileiro de Geografia e Estatística - IBGE.</p>

        <p>Por ser expressão da verdade, firmo e assino a presente para que a mesma produza
        seus efeitos legais e de direito.</p>

        <br><br>
        <p class="center">Montes Claros, 1 de {{ $data->translatedFormat('F \d\e Y') }}</p>

        <div class="signature-space center">
            <br><br><br>
            ____________________________________<br>
            Assinatura
        </div>
    </div>
</body>
</html>
