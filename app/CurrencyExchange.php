<?php

namespace App;

class CurrencyExchange
{
    protected $rate;

    public function __construct($currency = 'EUR')
    {
        $this->rate = $this->getRate('EUR');
    }

    /**
     * Converts currency in Forint to EUR
     *
     * @param int $forint
     * @return float|int
     */
    public function exchange(int $forint)
    {
        if ($forint == 0) {
            return 0;
        }

        return round($forint / $this->rate, 2);
    }


    /**
     * Gets the current HUF - EUR rate
     *
     * @return int
     */
    private function getRate($currency)
    {
        $client = new \SoapClient("http://www.mnb.hu/arfolyamok.asmx?wsdl");
        $result = $client->GetCurrentExchangeRates()->GetCurrentExchangeRatesResult;

        xml_parse_into_struct(xml_parser_create(), $result, $values);

        foreach ($values as $item) {
            if (data_get($item, 'attributes.CURR')== $currency) {
                return floatval($item['value']);
            }
        }

        return 0;
    }
}
