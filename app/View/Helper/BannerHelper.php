<?php

App::uses('Helper', 'View');
App::uses('Time', 'View');

/**
 * Classe com funcoes auxiliares para exibicao dos dados para Banners.
 *
 * @property TimeHelper Time
 */
class BannerHelper extends Helper
{
    public $helpers = array('Time');

    /**
     * Array de locais disponiveis.
     */
    public static $locais = array(
        'principal' => 'Principal',
    );

    /**
     * Formata a apresentacao do campo "validade" considerando os campos "data_inicio" e "data_fim".
     * Pode retornar um valor padrao se as datas estiverem vazias.
     *
     * @param string $data_inicio
     * @param string $data_fim
     * @param string|null $default
     * @return null|string
     */
    public function validade($data_inicio, $data_fim, $default = null)
    {
        $data_inicio_string = $this->Time->format($data_inicio, '%A, %d de %B, %Y');
        $data_fim_string    = $this->Time->format($data_fim,    '%A, %d de %B, %Y');

        if (empty($data_inicio) && empty($data_fim)) {
            return $default;
        }

        if ($data_inicio == $data_fim) {
            // retorna apenas a data de inicio
            return 'Apenas em ' . $data_inicio_string;
        }

        if (!empty($data_inicio) && empty($data_fim)) {
            // retorna apenas a data de inicio
            return 'A partir de ' . $data_inicio_string;
        }

        if (empty($data_inicio) && !empty($data_fim)) {
            // retorna apenas a data fim
            return 'Até ' . $data_fim_string;
        }

        // retorna as datas completas
        return $data_inicio_string . ' até ' . $data_fim_string;
    }

    /**
     * Traduz o id do local para um nome conhecido.
     *
     * @param string $local
     * @return null|string
     */
    public function local($local)
    {
        if(array_key_exists($local, self::$locais)) {
            return self::$locais[$local];
        }

        return null;
    }

    /**
     * Retorna um array com os locais disponiveis para ser utilizado em um campo do tipo select.
     *
     * @return array
     */
    public function listLocais()
    {
        return array('' => '---Escolha o local---') + self::$locais;
    }
}
