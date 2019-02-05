<?php

namespace App\Presenters;

use App\Transformers\OrdersProgramTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OrdersProgramPresenter.
 *
 * @package namespace App\Presenters;
 */
class OrdersProgramPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OrdersProgramTransformer();
    }
}
