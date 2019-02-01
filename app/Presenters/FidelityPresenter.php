<?php

namespace App\Presenters;

use App\Transformers\FidelityTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class FidelityPresenter.
 *
 * @package namespace App\Presenters;
 */
class FidelityPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new FidelityTransformer();
    }
}
