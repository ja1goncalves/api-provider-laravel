<?php

namespace App\Presenters;

use App\Transformers\FlightTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class FlightPresenter.
 *
 * @package namespace App\Presenters;
 */
class FlightPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new FlightTransformer();
    }
}
