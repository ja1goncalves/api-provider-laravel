<?php

namespace App\Presenters;

use App\Transformers\PassengersTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PassengersPresenter.
 *
 * @package namespace App\Presenters;
 */
class PassengersPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PassengersTransformer();
    }
}
