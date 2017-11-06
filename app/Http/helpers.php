<?php

/*
 * Esta funcão será utilizada para formatar a data do
 * formato brasileiro para o americano, sendo assim possivel
 * fazer a busca no banco de dados. O dataStart terá uma peculiaridade,
 * sempre que não for definida a data, por padrão será setada para 31 dias
 * antes da data atual.
 */
function dataStart($data_start){

    $date_start = $data_start ? $data_start : (new \DateTime())->modify('-1 month');
    $date_start = $date_start instanceof \DateTime ? $date_start->format('Y-m-d') : \DateTime::createFromFormat('d/m/Y', $data_start)->format('Y-m-d');

    return $date_start;

}


/*
 * Esta funcão será utilizada para formatar a data do
 * formato brasileiro para o americano, sendo assim possivel
 * fazer a busca no banco de dados.
 */
function dataEnd($data_end){

    $date_end = $data_end ? $data_end : new \DateTime();
    $date_end = $date_end instanceof \DateTime ? $date_end->format('Y-m-d') : \DateTime::createFromFormat('d/m/Y', $data_end)->format('Y-m-d');

    return $date_end;

}

function formataDataBr($value){

    return \DateTime::createFromFormat('Y-m-d', $value)->format('d/m/Y');

}

function formataDataUsa($value){

    return \DateTime::createFromFormat('d/m/Y', $value)->format('Y-m-d');

}

function valorBr($value){;

    $value = $value ? $value : '0';

    $valorBr = number_format($value,2,',','.');

    return  $valorBr;

}

function valorUsa($value){

    $value = $value ? $value : '0';

    $valorUsa = str_replace('.', '', $value);
    $valorUsa = str_replace(',', '.', $valorUsa);

    return $valorUsa;

}

function valorChart($value){;

    $value = $value ? $value : '0';

    $valorChart = number_format($value,2,'.','');

    return  $valorChart;

}
