<?php


class Situation
{
    protected $DESCONTINUADO = 'DESCONTINUADO';
    protected $NAO_INICIADO = 'NAO_INICIADO';
    protected $ANDAMENTO = 'ANDAMENTO';
    protected $CONCLUIDO = 'CONCLUIDO';
    protected $RESPONDIDO = 'RESPONDIDO';
    protected $AGUARDANDO_RES = 'AGUARDANDO_RES';

    public function getSituation($data)
    {
        $status = $data['status'];
        $activity = $data['atividade_cod'];
        $startDate = $data['data_inicio'];
        $endDate = $data['data_concluido'];
        $correspondents = $data['correspondentes'];

        if ($status == 'ATIVO') {
            if ($this->verifyActivity($activity, $correspondents)) {

                if (!isset($startDate)) {
                    return $this->NAO_INICIADO;
                } else {
                    if (!isset($endDate)) {
                        return $this->ANDAMENTO;
                    } else {
                        return $this->CONCLUIDO;
                    }
                }
            }
            $correspondentResponse = $correspondents[0]['data_respondido'];
            return isset($correspondentResponse) ? $this->RESPONDIDO : $this->AGUARDANDO_RES;
        }
        return $this->DESCONTINUADO;
    }

    private function verifyActivity($activity, $correspondent)
    {
        $activities = array('MAT_LIC', 'MAT_CON');

        $condition = in_array($activity, $activities) && isset($correspondent);
        return $condition ? false : true;
    }
}
