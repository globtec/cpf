<?php

/**
 * The Cpf class
 *
 * @author José Carlos <josecarlos@globtec.com.br>
 */
class Cpf
{
    /**
     * @var string
     */
    private $value;

    /**
     * @param mixed $cpf
     */
    public function __construct($cpf = null)
    {
        $this->set($cpf);
    }

    /**
     * Get only the numeric part of the CPF
     *
     * @param mixed $cpf
     * @return null|string
     */
    private function filter($cpf)
    {
        $cpf = preg_replace('/[^\d]/', '', $cpf);

        if (! is_numeric($cpf)) {
            return null;
        }

        return str_pad($cpf, 11, 0, STR_PAD_LEFT);
    }

    /**
     * Set value of the CPF
     *
     * @param mixed $cpf
     * @return void
     */
    public function set($cpf)
    {
        $this->value = $this->filter($cpf);
    }

    /**
     * Get value of the CPF
     *
     * @return string
     */
    public function get()
    {
        return $this->valid() ? $this->value : null;
    }

    /**
     * Format the CPF
     *
     * @return string
     */
    public function format()
    {
        if (null === ($cpf = $this->get())) {
            return null;
        }

        $pattern     = '/([\d]{3})([\d]{3})([\d]{3})([\d]{2})/';
        $replacement = '$1.$2.$3-$4';

        return preg_replace($pattern, $replacement, $cpf);
    }

    /**
     * Validate the CPF
     *
     * @return boolean
     */
    public function valid()
    {
        if (null === ($cpf = $this->value)) {
            return false;
        }

        $cpf = str_split($cpf);

        if (count(array_unique($cpf)) == 1) {
            return false;
        }

        for ($i = 9; $i < 11; $i++) {
            for ($sum = 0, $j = 0; $j < $i; $j++) {
                $sum += $cpf[$j] * ($i - $j + 1); 
            }

            $mod = $sum % 11;

            if (($mod < 2 && 0 == $cpf[$i]) || (11 - $mod) == $cpf[$i]) {
                continue;
            }

            return false;
        }

        return true;
    }
}